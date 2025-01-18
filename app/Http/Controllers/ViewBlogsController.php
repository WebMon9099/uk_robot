<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use GuzzleHttp\Client;
use Barryvdh\DomPDF\Facade\Pdf as PDF;



class ViewBlogsController extends Controller
{
    public function index(Request $request)
    {
    
        // $blogs = Blog::orderBy('created_at', 'desc')->paginate(3);
        $blogs = Blog::where('blog_type', 'blog')
            ->orderBy('created_at', 'desc')->get();
            $blogs->transform(function ($blog) {

                $blog->shareUrl = route('blogs.show', ['slug' => $blog->slug]);  // Generate the share URL
                $blog->shareTitle = $blog->title;
                $blog->shareDescription = $blog->excerpt ?? substr(strip_tags($blog->description), 0, 150); // Use excerpt or description
                // Check if the blog has images and set the share image URL
                $shareImage = $blog->images->first()
                ? url('storage/' . $blog->images->first()->imagename)  // Generates absolute URL
                : url('storage/default-image.jpg');  // Default image
                //dd($blog->shareImage);
                $blog->shareImage=$shareImage;
    
                // dd($blog->shareImage);
    
                return $blog;
            });   
        
        return view('blog', compact('blogs'));
    }
      //owl carousel
    public function latest()
    {
        $latestBlogs = Blog::with('images')
          ->orderBy('created_at', 'desc')->take(5)->get();
        //dd( $latestBlogs);
        return response()->json($latestBlogs);
    }
  
    public function latestPressPr()
    {
        // Fetch the latest 4 blog posts
        $latestBlogs = Blog::with('images')
        ->where('blog_type', 'blog') // Ensure the column name is correct
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();
        return response()->json($latestBlogs);
    }

   


      
    
    public function show($slug)
    {
        // Retrieve the blog post by slug
        $blog = Blog::where('slug', $slug)->firstOrFail();
        
        // Fetch the latest blogs excluding the current one, based on slug
        $latestBlogs = Blog::with('images')
            ->where('blog_type', 'blog') // Ensure the column name is correct
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
        $section1 = ''; // First 500 words
        $section2 = ''; // Next 500 words
        $section3 = ''; // Next 500 words
        $section4 = ''; // Remaining words
        $wordCount = 0;
    
        $section1Limit = 200; // Set word limit for section1
        $section2Limit = 400; // Set word limit for section2
        $section3Limit = 400; // Set word limit for section3
        
        // Distribute paragraphs into sections based on word count
        foreach ($paragraphs as $paragraph) {
            $words = explode(' ', $paragraph->nodeValue); // Split the paragraph into words
            $wordCountInParagraph = count($words);
    
            if ($wordCount + $wordCountInParagraph <= $section1Limit) {
                // Add paragraph to section1 if within word limit
                $section1 .= '<div class="col-12"><p>' . $paragraph->nodeValue . '</p></div>';
                $wordCount += $wordCountInParagraph;
            } elseif ($wordCount + $wordCountInParagraph <= ($section1Limit + $section2Limit)) {
                // Add paragraph to section2 if within section2's word limit
                $section2 .= '<div class="col-12"><p>' . $paragraph->nodeValue . '</p></div>';
                $wordCount += $wordCountInParagraph;
            } elseif ($wordCount + $wordCountInParagraph <= ($section1Limit + $section2Limit + $section3Limit)) {
                // Add paragraph to section3 if within section3's word limit
                $section3 .= '<div class="col-12"><p>' . $paragraph->nodeValue . '</p></div>';
                $wordCount += $wordCountInParagraph;
            } else {
                // Add remaining paragraphs to section4
                $section4 .= '<div class="col-12"><p>' . $paragraph->nodeValue . '</p></div>';
            }
        }
    
        // Determine if there are images to display
        $hasImage = $blog->images->isNotEmpty();
    
        return view('single-blog', compact('blog', 'latestBlogs', 'section1', 'section2', 'section3', 'section4', 'shareUrl', 'shareTitle', 'shareDescription', 'imageUrl', 'shareMessage', 'hasImage'));
    }
    
    
    
}
