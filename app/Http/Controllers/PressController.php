<?php

namespace App\Http\Controllers;


use App\Models\Blog;
use App\Models\BlogImage;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PressController extends Controller
{
    public function index()
    {
    

        $userType = auth()->user()->user_type;
        $blogs = Blog::with('images')
        ->when($userType != 1, function ($query) {
            // Restrict to logged-in user's blogs if user_type is not 1
            $query->where('user_id', auth()->id());
        })
        ->where('blog_type', 'article')
        ->orderBy('created_at', 'desc')  
        ->get();
        // Fetch all categories from the BlogCategory model
        $categories = BlogCategory::all();

        // Check if blogs are available
        $noBlogs = $blogs->isEmpty();  // Boolean to check if no blogs exist

        // dd($blogs);
        // dd($categories);

        return view('admin.blog.pressDetails', compact('blogs', 'noBlogs','categories'));
    }

    public function store(Request $request)
    {
        // Get categories
        $categories = BlogCategory::all();
    
        // Validate input data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'blog_images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // Validation for multiple images
            'published_by' => 'nullable|string|max:255',
            'written_by' => 'nullable',
            'press_link' => 'nullable|url',
            'category_name' => 'required_without:new_category|string|in:' . implode(',', array_merge($categories->pluck('category')->toArray(), ['other'])),
            'new_category' => 'required_if:category_name,other|nullable|string|max:255',
            'social_links.tiktok' => 'nullable|url',
            'social_links.instagram' => 'nullable|url',
            'social_links.linkedin' => 'nullable|url',
            'social_links.facebook' => 'nullable|url',
            'social_links.twitter' => 'nullable|url',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
    
        $validatedData = $validator->validated();
    
        // Retrieve social links
        $socialLinks = $request->get('social_links', []);
    
        // Handle category creation or selection
        $categoryName = $validatedData['category_name'] === 'other' ? $validatedData['new_category'] : $validatedData['category_name'];
        BlogCategory::firstOrCreate(['category' => $categoryName]);
    
        // Determine blog type
        $currentUrl = $request->url();
        $blogType = str_contains($currentUrl, 'press') ? 'article' : 'blog';
    
        // Get the logged-in user's ID
        $userId = auth()->id();
    
        // Create the blog entry
        $blog = Blog::create([
            'title' => $validatedData['title'],
            'date' => $validatedData['date'],
            'slug' => $validatedData['title'],
            'category' => $categoryName,
            'description' => $request->description,
            'press_link' => $validatedData['press_link'],
            'published_by' => $validatedData['published_by'],
            'written_by' => $validatedData['written_by'],
            'user_id' => $userId,
            'blog_type' => $blogType,
            'social_links' => $socialLinks, // Use the retrieved or default value
        ]);
    
     
        // Handle blog image upload
        if ($request->hasFile('blog_images')) { // Updated to handle multiple images
            foreach ($request->file('blog_images') as $imageFile) {
                $imagename = $imageFile->store('blogimages', 'public'); // Save to storage/app/public/blogimages
                $blog->images()->create(['imagename' => $imagename]); // Create a new image record for each file
            }
        }
    
        return response()->json([
            'success' => true,
            'redirect_url' => route('press.index'),
        ]);
    }
    
    // public function store(Request $request)
    // {
    //     $categories = BlogCategory::all();
    //     // Validate the form fields
    //     $validator = Validator::make($request->all(), [
    //         'title' => 'required|string|max:255',
    //         'date' => 'required|date',
    //         'blog_images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
    //         'published_by' => 'nullable',
    //         'press_link' => 'nullable|url',
    //         'category_name' => 'required_without:new_category|string|in:' . implode(',', array_merge($categories->pluck('category')->toArray(), ['other'])),
    //         'new_category' => 'required_if:category_name,other|nullable|string|max:255',
    //         'social_links.tiktok' => 'nullable|url',
    //         'social_links.instagram' => 'nullable|url',
    //         'social_links.linkedin' => 'nullable|url',
    //         'social_links.facebook' => 'nullable|url',
    //         'social_links.twitter' => 'nullable|url', 
    //     ], [
    //         'category_name.required_without' => 'Please select a category or enter a new category.',
    //         'new_category.required_if' => 'Please specify a new category when "Other" is selected.'
    //     ]);

    //     // Check if validation fails
    //     if ($validator->fails()) {

    //         return response()->json([
    //             'success' => false,
    //             'errors' => $validator->errors()
    //         ], 422);  // 422 Unprocessable Entity
    //     }

    //     // Determine the blog type based on the URL
    //     $currentUrl = $request->url();
    //     $socialLinks = $request->get('social_links', []);
    //     $blogType = str_contains($currentUrl, 'press') ? 'article' : 'blog';

    //     // Get the logged-in user's ID
    //     $userId = auth()->id();
    //     // Proceed with the rest of your code if validation passes
    //     $validatedData = $validator->validated();
    //     $categoryName = $validatedData['category_name'] === 'other' ? $validatedData['new_category'] : $validatedData['category_name'];
    //     BlogCategory::firstOrCreate(['category' => $categoryName]);

    //     $blog = Blog::create([
    //         'title' => $validatedData['title'],
    //         'date' => $validatedData['date'],
    //         'slug' => $validatedData['title'],  // Assuming 'slug' is based on the title
    //         'category' => $categoryName,
    //         'description' => $request->description,
    //         'press_link' => $request->press_link,
    //         'published_by' => $request->published_by,
    //         'user_id' => $userId, // Add the user_id
    //         'blog_type' => $blogType, // Add the blog_type
    //         'social_links' => $socialLinks,
    //     ]);

    //     // Handle the image upload if the file is present
    //     if ($request->hasFile('blog_images')) { // Updated to handle multiple images
    //         foreach ($request->file('blog_images') as $imageFile) {
    //             $imagename = $imageFile->store('blogimages', 'public'); // Save to storage/app/public/blogimages
    //             $blog->images()->create(['imagename' => $imagename]); // Create a new image record for each file
    //         }
    //     }
    

    //     // Return success response for AJAX
    //     return response()->json([
    //         'success' => true,
    //         'redirect_url' => route('press.index')
    //     ]);
    // }
    public function update(Request $request, $id)
    {
        // dd($request->all());
        
        try {
            // Find the blog post by ID
            $blog = Blog::findOrFail($id); // Ensure the blog exists
            
            
            // Validate input data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'date' => 'required|date',
                'description' => 'nullable|string',
                'category_name' => 'required|string',
                'blog_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
                'published_by' => 'nullable', 
                'written_by' => 'nullable', 
                'press_link' => 'nullable|url', // Optional image field
                'social_links.tiktok' => 'nullable|url',
                'social_links.instagram' => 'nullable|url',
                'social_links.linkedin' => 'nullable|url',
                'social_links.facebook' => 'nullable|url',
                'social_links.twitter' => 'nullable|url',
            ]);

            // Map category_name from the frontend to the category column in the database
            $category = $validatedData['category_name']; // Get the category_name from the form
            /* $socialLinks = $validatedData['social_links']; */
            
            // Update blog details
            $blog->update([
                'title' => $validatedData['title'],
                'date' => $validatedData['date'],
                'description' => $validatedData['description'] ?? '', // Store empty string if description is null
                'category' => $category, 
                'published_by'=>$validatedData['published_by'],
                'written_by'=>$validatedData['written_by'],
                'press_link'=>$validatedData['press_link'],
                /* 'social_links' => $socialLinks,  */
                
                // Store the category name in the 'category' column
            ]);
            
            // dd($blog);
            
            
            // Handle the image upload when updating the blog
            if ($request->hasFile('blog_image')) {
                $imageFile = $request->file('blog_image');
                $imagename = $imageFile->store('blogimages', 'public');  // Store the new image in 'public/blogimages'

                // Find the current image associated with this blog post
                $currentImage = $blog->images->first();  // Assuming there is one image per blog post
                
                // Delete the old image from the storage
                if ($currentImage) {
                    // Optionally delete the old image from the storage directory
                    Storage::delete('public/' . $currentImage->imagename);
                    
                    // Update the imagename in the database
                    $currentImage->update([
                        'imagename' => $imagename,  // Save the new image name
                    ]);
                } else {
                    // If no image exists, create a new one
                    $blog->images()->create([
                        'imagename' => $imagename,
                    ]);
                }
            }

            /* // If request is AJAX, respond with JSON success message
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Blog updated successfully!',
                    'redirect_url' => route('blogs.index')
                ]);
            } */

            // Redirect back with a success message
            return redirect()->route('press.index')->with('success', 'Press updated successfully!');
        } catch (\Exception $e) {
            // Log the error and return an error message
            \Log::error('Error updating Press: ' . $e->getMessage());

            // If request is AJAX, respond with JSON error message
            /* if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while updating the blog hgansdf.'
                ], 500);
            } */
            return redirect()->route('press.index')->with('error', 'An error occurred while updating the press.');
        }
    }


    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        // Delete associated images if they exist
        if ($blog->images->isNotEmpty()) {
            foreach ($blog->images as $image) {
                // Check if image_path is set and delete from storage
                if (!empty($image->imagename)) {
                    Storage::disk('public')->delete($image->imagename);
                }
                // Delete the image record from the database
                $image->delete();
            }
        }

        // Delete the blog entry
        $blog->delete();

        return redirect()->route('press.index')->with('success', 'Press deleted successfully!');
    }
}
