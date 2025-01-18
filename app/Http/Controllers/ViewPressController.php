<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use GuzzleHttp\Client;
use Barryvdh\DomPDF\Facade\Pdf as PDF;



class ViewPressController extends Controller
{
     public function index(Request $request)
    {
        // if ($request->ajax()) {
        //     $blogs = Blog::latest()->paginate(2);
        //     return view('partials.blog_items', compact('blogs'))->render();
        // }

        $blogs = Blog::where('blog_type', 'article')
            ->orderBy('created_at', 'desc') ->with('images')->get();

        $blogs->transform(function ($blog) {

            $blog->shareUrl = route('press.show', ['slug' => $blog->slug]);  // Generate the share URL
            $blog->shareTitle = $blog->title;
            $blog->shareDescription = $blog->excerpt ?? substr(strip_tags($blog->description), 0, 150); // Use excerpt or description
            // Check if the blog has images and set the share image URL
            $shareImage = $blog->images->first()
            ? url('storage/' . $blog->images->first()->imagename)  // Generates absolute URL
            : url('storage/default-image.jpg');  // Default image
            $blog->shareImage=$shareImage;
            return $blog;
        });

        // Pass the blogs to the view
        return view('press', compact('blogs'));
    } 

    public function latest()
    {
        $latestBlogs = Blog::with('images')->where('blog_type', 'article')->orderBy('created_at', 'desc')->take(3)->get();
        //dd( $latestBlogs);
        return response()->json($latestBlogs);
    }
    public function latestPressPr()
    {
        // Fetch the latest 4 blog posts
        $latestBlogs = Blog::with('images')
            ->where('blog_type', 'article')->orderBy('created_at', 'desc')->take(3)->get();
        return response()->json($latestBlogs);
    }

    public function show($slug)
    {
        // Retrieve the blog post by slug
        $blog = Blog::where('slug', $slug)->firstOrFail();

        // Fetch the latest blogs excluding the current one, based on slug
        $latestBlogs = Blog::with('images')
        ->where('blog_type', 'article') // Ensure the column name is correct
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();
        $imageUrl = $blog->images->isNotEmpty() ? asset('storage/' . $blog->images->first()->imagename) : asset('default-image.jpg');

        // Get the description
        $description = $blog->description;
        $shareUrl = url()->current(); // Current page URL
        $shareTitle = $blog->title;
        $shareDescription = $blog->excerpt ?? substr(strip_tags($blog->description), 0, 150);
        $shareMessage = "Check out this blog: " . $blog->title;


        // Create a DOMDocument to parse HTML content
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true); // Suppress errors for malformed HTML
        $dom->loadHTML($description);
        libxml_clear_errors();

        // Get all paragraphs
        $paragraphs = $dom->getElementsByTagName('p');

        // Initialize sections
        $section1 = ''; // col-12
        $section2 = ''; // col-6 for the first column
        $section3 = ''; // col-6 for the second column
        $section4 = ''; // col-12

        // Iterate through paragraphs and assign them to sections
        $counter = 0;
        foreach ($paragraphs as $paragraph) {
            if ($counter == 0) {
                // First paragraph goes to section1 (col-12)
                $section1 .= '<div class="col-12"><p>' . $paragraph->nodeValue . '</p></div>';
            } elseif ($counter == 1 || $counter == 2) {
                // Next two paragraphs go to section2 and section3 (col-6 each)
                if ($counter == 1) {
                    $section2 .= '<div class="col-12"><p>' . $paragraph->nodeValue . '</p></div>';
                } else {
                    $section3 .= '<div class="col-12"><p>' . $paragraph->nodeValue . '</p></div>';
                }
            } else {
                // Remaining paragraphs go to section4 (col-12)
                $section4 .= '<div class="col-12"><p>' . $paragraph->nodeValue . '</p></div>';
            }
            $counter++;
        }

        return view('single-press', compact('blog', 'latestBlogs', 'section1', 'section2', 'section3', 'section4', 'shareUrl', 'shareTitle', 'shareDescription', 'imageUrl', 'shareMessage'));
    }


  

}
