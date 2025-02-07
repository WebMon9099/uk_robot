@extends('layout.app')
@section('title', $shareTitle)

@section('og:title', $shareTitle)
@section('og:description', $shareDescription)
@section('og:url', $shareUrl)
@section('og:image', $imageUrl)

@section('og:image:alt', $shareTitle)

@section('main_section')
<style>
    / Styling for the share button icon /
.share-icon {
    cursor: pointer;
}

/ Style for the share buttons container /
.share-buttons-container {
    display: none; / Initially hidden /
    padding: 0px 10px 0 10px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
    background-color: #ffffff;
}

/ Styling for share icon links /
.share-icon i {
    font-size: 20px;
    transition: transform 0.3s ease;
}

.share-icon:hover i {
    transform: scale(1.2); / Grow on hover /
}

/ Horizontal layout for share icons /
.share-buttons-container .row {
    display: flex;
    justify-content: flex-start;
}

.share-buttons-container .col-1 {
    padding: 5px;
}
    .login-prompt {
    display: inline-block;
    background: #ff4d4d; /* Red background for visibility */
    color: #fff; /* White text */
    font-size: 14px; /* Adjust font size */
    padding: 5px 10px; /* Padding for better spacing */
    border-radius: 5px; /* Rounded corners */
    position: absolute;
    margin-left: 10px; /* Space from the heart button */
    white-space: nowrap; /* Prevent text from wrapping */
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
}

    .share-container {
        display: none; /* Initially hidden */
        position: absolute;
        bottom: 50px; /* Adjust for positioning above button */
        left: 0;
        background: white;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2); /* Shadow effect */
        border-radius: 10px;
        padding: 10px;
        z-index: 1000;
    }

    .share-links {
        display: flex;
        flex-direction: row; /* Vertical alignment */
        gap: 10px;
        
    }

    .share-links a {
        text-decoration: none;
        display: flex;
        justify-content: center; /* Center icons */
        color: #333;
        font-size: 20px; /* Adjust icon size */
        padding: 8px;
        border-radius: 5px;
        transition: background 0.3s ease;
    }

    .share-links a:hover {
        background: #f5f5f5;
        border: none;
    }

    .share-icon{
        padding-right: 40px;
        margin-left: 10px;
    }

    .hide-button{
        background: transparent;
        border: none;
        font-size: 20px;
        padding-right: 20px;
        padding-left: 20px;
        margin-bottom: 0px;
    }

    .btn-like {
        display: flex;
        align-items: center;
        gap: 5px; /* Adjust spacing between heart and count */
        border: none;
        background: none;
        cursor: pointer;
        font-size: 20px;
        padding-right: 0px;
    }
                                        
    .like-count {
        font-weight: bold !important;
    }

    .comment-user {
        width: 6% !important;
        height: auto !important;
        border-radius: 15px !important;
        margin-bottom: 5px !important;
        object-fit: cover !important;
        background: #125259
    }
    .comment-btn{
        background: #125259 !important;
        border: none !important;
        padding: 5px 25px 5px 25px !important;
        border-radius: 5px !important;
        color: #ffF !important;
    }
    @media print {
        body {
            background-color: red !important;
        }

        .row>* {
            padding-right: 0 !important;
            padding-left: 0 !important;

        }

        .container,
        .container-sm {
            max-width: none !important;
            width: 85% !important;
        }

    }

    body {
        background-color: #f7f7f7;
        font-family: 'Arial', sans-serif;
    }

    .category-tag {
        font-size: 0.8rem;
        font-weight: bold;
        color: white;
        background: #ef257a;
        padding: 0.5rem 1rem;
        text-transform: uppercase;
        position: absolute;
        z-index: 1;
        top: 11rem;
        right: 6rem;
        border-radius: 2rem 0 0 2rem;
    }

    .single-blog-container {
        padding: 20px;
        background-color: #fff;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 8px 0px;
    }

    .single-blog-container img {
        width: 80%;
        height: auto;
        border-radius: 3px;
        margin-bottom: 20px;
        object-fit: cover;
    }

    .blog-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: #333;
    }

    .blog-header .blog-date {
        font-size: 1rem;
        color: #777;
        margin-bottom: 30px;
    }

    .blog-description p {
        font-size: 1.2rem;
        line-height: 1.7;
        color: #333;
        font-weight: normal;
        margin-bottom: 20px;
    }

    .latest-blogs h3 {
        font-size: 2rem;
        margin-bottom: 30px;
        font-weight: 600;
        color: #333;
    }

    .latest-blogs .card {
        border: none;
        border-radius: 15px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 8px 0px;
        transition: transform 0.3s ease-in-out;
    }

    .latest-blogs .card:hover {
        transform: translateY(-5px);
    }

    .latest-blogs .card-img-top {
        height: 250px;
        object-fit: cover;
        border-radius: 15px;
    }

    .latest-blogs .card-body {
        padding: 15px;
    }

    .latest-blogs .card-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .latest-blogs .card-text {
        font-size: 1rem;
        color: #555;
    }

    .latest-blogs .btn-primary {
        background-color: #125259;
        border: none;
        font-size: 1rem;
        transition: background-color 0.3s ease;
        padding: 8px 20px;
        text-transform: uppercase;
        border-radius: 5px;
    }

    .latest-blogs .btn-primary:hover {
        background-color: #0f3e42;
    }

    .latest-blogs .row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .latest-blogs .col-md-4 {
        flex: 1 1 30%;
        max-width: 30%;
    }

    .custom-btn {
        background-color: #ef257a;
        color: white;
        border: none;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .custom-btn:hover {
        background-color: #d21f66;
        transform: scale(1.05);
    }

    .profile-name {
        font-size: 0.9rem;
        font-weight: 500;
        margin: 0;
        color: #333;
    }

    .pulished_by {
        font-size: 1rem;
        font-weight: 400;
        color: #125259;
    }

    .blog-item {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .thumbnail-container {
        flex-shrink: 0;
    }

    .thumbnail {
        margin: 10px;
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
    }

    .blog-details {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        /* Space between title and meta */
    }

    .blog-meta {
        font-size: 0.9rem;
        color: #666;
    }

    .blog-title {
        font-size: 1.2rem;
        font-weight: bold;
        color: #333;
        text-decoration: none;
    }

    .blog-title:hover {
        color: #007BFF;
        /* Optional: hover effect */
    }

    .blog-hashtag {
        font-size: 0.8rem;
        /* Smaller font size for the date */
        font-weight: 600;
        color: #ef257a;
        margin-bottom: 0.3rem;
        /* Reduced margin */
    }

    .blog-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        object-position: center;
    }

    .card-profile .profile-img {
        width: 40px;
        /* Smaller profile image */
        height: 40px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #feb47b;
        /* Smaller border */
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .blog-title {
            font-size: 20px;
            text-align: center;
            margin-top: 10px;
        }

        .latest-blogs .row {
            display: block;
        }

        .col-md-4 {
            justify-content: center;
            align-items: center;
            display: flex;
        }

        .latest-blogs .col-md-4 {

            max-width: 100%;
            margin-bottom: 20px;
        }

        .single-blog-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .single-blog-container img {
            width: 50%;
            /* Reduce the width for mobile screens */
            height: auto;
            /* Maintain aspect ratio */
            border-radius: 3px;
            margin-bottom: 2px;
            object-fit: cover;
        }

        .latest-blogs .card-img-top {
            height: 60%;
            width: 60%;
            /* Reduce height for mobile screens */
            object-fit: cover;
            border-radius: 01px;
            max-height: 50%;
            max-width: 50%;
        }

        .latest-blogs .card {
            padding-top: 10px;
            margin-bottom: 15px;
        }

        .blog-description p {
            padding: 0px;
        }

        .blog-card {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .latest-blogs .card-body {
            display: flex;
            flex: colum;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 10px;
        }

        .latest-blogs .card-title {
            font-size: 1rem;
            /* Reduce font size for title */
        }

        .latest-blogs .card-text {
            font-size: 0.9rem;
            /* Reduce font size for description */
        }

        .category-tag {
            font-size: 0.8rem;
            font-weight: bold;
            color: white;
            background: #ef257a;
            padding: 0.5rem 1rem;
            text-transform: uppercase;
            position: absolute;
            z-index: 1;
            top: 9.9rem;
            right: 2.3rem;
            border-radius: 2rem 0 0 2rem;

        }

    }

    @media (max-width: 768px) {
        .category-tag {
            font-size: 0.7rem;
            top: 7rem;
            right: 1.5rem;
            padding: 0.4rem 0.8rem;
        }

        .blog-header h1 {
            font-size: 20px;
            text-align: center;
            margin-top: 10px;
        }
    }

    @media (max-width: 480px) {
        .category-tag {
            font-size: 0.6rem;
            top: 10.1rem;
            right: 2.3rem;
            padding: 0.3rem 0.6rem;

        }

        .blog-header h1 {
            font-size: 20px;
            text-align: center;
            margin-top: 10px;
        }
    }
</style>

<div class="position-relative text-white" style="background-color: #125259;">
    <div>
        @include('components.navbar')
    </div>
</div>

<div class="container mt-5">
    <div class="single-blog-container mb-5">
        <div class="row m-1 p-4 print-adjust" style="background: aliceblue">
            <div class="col-md-12">
                <div class="d-flex flex-column align-items-center">
                    <h1 class="text-decoration-underline blog-title" style="color: #000000">{{ $blog->title }}</h1>
                    <p class="category-tag">{{ $blog->category }}</p>
                </div>

                <!-- First Row: Image and Content -->
                <div class="row mt-4">
                    <div class="col-md-4">
                        @if($hasImage)
                            <img src="{{ asset('storage/' . $blog->images->first()->imagename) }}" alt="Blog Image"
                                class="img-fluid blog-image">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="">
                            {!! $section1 !!}
                        </div>
                    </div>
                </div>

                <!-- Second Row: Content and Image -->
                <!-- <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="blog-description">
                            {!! $section2 !!}
                    <div class="col-md-4">
                        @if($hasImage && $blog->images->count() > 1)
                            <img src="{{ asset('storage/' . $blog->images[1]->imagename) }}" alt="Blog Image"
                                class="img-fluid blog-image">
                        @endif
                    </div>
                </div> -->
                <div class="row mt-4">
                    @if($hasImage && $blog->images->count() > 1)
                        <div class="col-md-8">
                            <div class="">
                                {!! $section2 !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $blog->images[1]->imagename) }}" alt="Blog Image"
                                class="img-fluid blog-image">
                        </div>
                    @else
                        <!-- If no image, content spans the full width -->
                        <div class="col-md-12">
                            <div class="">
                                {!! $section2 !!}
                            </div>
                        </div>
                    @endif
                </div>


                <!-- Third Row: Image or Full Description -->
                <div class="row mt-4">
                    @if($hasImage && $blog->images->count() > 2)
                        <div class="col-8">
                            {!! $section3 !!}
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $blog->images[2]->imagename) }}" alt="Blog Image"
                                class="img-fluid blog-image">
                        </div>

                    @else
                        <div class="col-md-12">
                            {!! $section3 !!}
                        </div>
                    @endif

                </div>

                <!-- Fourth Row: Additional Content -->
                <div class="row mt-2">
                    <div class="col-md-12">
                        {!! $section4 !!}
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="card-profile d-flex flex-column flex-md-row ">

                        <!-- Text Information -->
                        <div class="profile-details mt-3 mt-md-0 text-center text-md-start">
                            @if(!empty($blog->published_by)) 
                                <h4 class="pulished_by">Published By:
                                    {{ $blog->published_by ?? 'Unknown User' }}
                                </h4>
                            @endif    
                            @if(!empty($blog->written_by))
                                <h4 class="pulished_by">Written By:
                                    {{ $blog->written_by ?? 'Unknown User' }}
                                </h4>
                            @endif
                            <h4 class="pulished_by">Published on:
                                {{ $blog->created_at->format('M d, Y') }}
                            </h4>
                          
                            <div class="d-flex justify-content-start align-items-center mb-3">
                                <button class="mt-1 btn btn-sm btn-info custom-btn profile-followers m-2 print-button"
                                    onclick="printBlog()">Print</button>

                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center">
                                    <!-- Like Button -->
                                    <div class="me-3">
                                        <div class="post-actions">
                                            @if (auth()->check())
                                                <button class="btn btn-like" id="likeButton-{{ $blog->id }}"
                                                    onclick="likePost({{ $blog->id }})">
                                                    ❤️ <span id="likeCount-{{ $blog->id }}"
                                                        class="like-count">{{ $blog->likes->count() }}</span>
                                                </button>
                                            @else
                                                <button class="btn btn-like" id="likeButton-{{ $blog->id }}"
                                                    onclick="showLoginPrompt({{ $blog->id }})">
                                                    🤍 <span id="likeCount-{{ $blog->id }}"
                                                        class="like-count">{{ $blog->likes->count() }}</span>
                                                </button>
                                                <span id="loginPrompt-{{ $blog->id }}" class="login-prompt"
                                                    style="display:none;">Please login to like</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Comment Toggle Button -->
                                    <div class="me-3">
                                        <button onclick="toggleComments()" class="hide-button">
                                            <i class="fa fa-comment" aria-hidden="true"></i>
                                        </button>
                                        {{ $blog->comments()->count() }}
                                    </div>

                                    <!-- Share Button -->
                                    <div class="me-3 position-relative">
                                        <div class="share-icon">
                                            <button class="btn btn-share" id="shareButton" style="border: none;">
                                                <i class="fa fa-share-alt" aria-hidden="true"
                                                    style="font-size: 20px;"></i>
                                            </button>
                                            <span id="shareCount-{{ $blog->id }}">{{ $blog->share_count }}</span>
                                        </div>

                                        <!-- Social Share Links -->
                                        <div id="shareLinks" class="share-container">
                                            <div class="share-links d-flex">
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}"
                                                    target="_blank" onclick="updateShareCount({{ $blog->id }})">
                                                    <i class="fa-brands fa-facebook"></i>
                                                </a>
                                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($shareTitle) }}&url={{ urlencode($shareUrl) }}"
                                                    target="_blank" onclick="updateShareCount({{ $blog->id }})">
                                                    <i class="fa-brands fa-twitter"></i>
                                                </a>
                                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($shareUrl) }}"
                                                    target="_blank" onclick="updateShareCount({{ $blog->id }})">
                                                    <i class="fa-brands fa-linkedin"></i>
                                                </a>
                                                <a href="https://api.whatsapp.com/send?text={{ urlencode($shareMessage . ' ' . $shareUrl) }}"
                                                    target="_blank" onclick="updateShareCount({{ $blog->id }})">
                                                    <i class="fa-brands fa-whatsapp"></i>
                                                </a>
                                                <a href="https://telegram.me/share/url?url={{ urlencode($shareUrl) }}&text={{ urlencode($shareTitle) }}"
                                                    target="_blank" onclick="updateShareCount({{ $blog->id }})">
                                                    <i class="fa-brands fa-telegram"></i>
                                                </a>
                                                <a href="https://pinterest.com/pin/create/button/?url={{ urlencode($shareUrl) }}&media={{ urlencode($imageUrl) }}&description={{ urlencode($shareTitle) }}"
                                                    target="_blank" onclick="updateShareCount({{ $blog->id }})">
                                                    <i class="fa-brands fa-pinterest"></i>
                                                </a>
                                                <a href="https://www.reddit.com/submit?url={{ urlencode($shareUrl) }}&title={{ urlencode($shareTitle) }}"
                                                    target="_blank" onclick="updateShareCount({{ $blog->id }})">
                                                    <i class="fa-brands fa-reddit"></i>
                                                </a>
                                                <a href="mailto:?body={{ urlencode($shareMessage . ' ' . $shareUrl) }}"
                                                    target="_blank" onclick="updateShareCount({{ $blog->id }})">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Read Count -->
                                    <div class="me-3">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                        <span class="ml-1">{{ $blog->read_times }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <livewire:comments :model="$blog"/> --}}
           
            <div id="commentSection" style="display: none;border:none;">
                <livewire:comments :model="$blog"/>
            </div>
        </div>
    </div>

    <!-- Single Blog Container -->

    <div class="container-fluid">
        <div class="row">
            <h3 class="text-decoration-underline">Our Latest Blogs</h3>
            @foreach ($latestBlogs as $blog)
                <div class="col-md-4 col-lg-4 print-adjust">
                    <div class="blog-item d-md-flex border-md p-md-3">
                        <a href="{{ route('blogs.show', $blog->slug) }}" style="text-decoration: none; color: inherit;">
                            <img src="{{ asset('storage/' . ($blog->images->first()->imagename ?? 'default-image.jpg')) }}"
                                alt="Article Thumbnail" class="thumbnail img-fluid">
                            <div class="blog-details mt-2">
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="blog-title">
                                    {{ \Illuminate\Support\Str::limit($blog->title, 20, '...') }}</a>
                                <div class="blog-meta">
                                    <p class="blog-hashtag"><i class="fas fa-calendar-alt"></i>
                                        {{ $blog->created_at->format('M d, Y') }}</p>
                                    <h3 class="profile-name mb-1">Published By:
                                        {{ $blog->published_by ?? 'Unknown User' }}
                                    </h3>
                                   
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection
@section('customJs')
<script>
document.addEventListener("DOMContentLoaded", function () {
    var shareButton = document.getElementById("shareButton");
    var shareLinks = document.getElementById("shareLinks");

    shareButton.addEventListener("click", function (event) {
        // Toggle display of share links
        if (shareLinks.style.display === "none" || shareLinks.style.display === "") {
            shareLinks.style.display = "block";
        } else {
            shareLinks.style.display = "none";
        }

        event.stopPropagation(); // Stop event propagation
    });

    // Close share links when clicking outside
    document.addEventListener("click", function (event) {
        if (!shareLinks.contains(event.target) && event.target !== shareButton) {
            shareLinks.style.display = "none";
        }
    });
});

</script>
<script>
    function toggleComments() {
        let commentSection = document.getElementById('commentSection');
        if (commentSection.style.display === "none") {
            commentSection.style.display = "block";
        } else {
            commentSection.style.display = "none";
        }
    }
</script>
<script>
    function likePost(postId) {
        $.ajax({
            url: '/like-post/' + postId, // URL for liking/unliking post
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Include CSRF token for security
            },
            success: function (response) {
                // Dynamically update the like count and heart icon
                $('#likeCount-' + postId).text(response.likes); // Update like count
                let likeButton = $('#likeButton-' + postId);

                // Toggle the button text based on the action (like/unlike)
                if (response.message == 'Post liked') {
                    likeButton.html('❤️ <span id="likeCount-' + postId + '">' + response.likes + '</span>');
                } else {
                    likeButton.html('🤍 <span id="likeCount-' + postId + '">' + response.likes + '</span>');
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function updateShareCount(blogId) {
            fetch(`/update-share-count/${blogId}`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`shareCount-${blogId}`).innerText = data.share_count;
                    }
                })
                .catch(error => console.error("Error updating share count:", error));
        }

    function showLoginPrompt(postId) {
        // Show the login prompt message when the user clicks on the like button
        $('#loginPrompt-' + postId).fadeIn();

        // Hide the prompt after 3 seconds
        setTimeout(function () {
            $('#loginPrompt-' + postId).fadeOut();
        }, 3000);
    }
</script>

<script>
    // Define print-specific styles
    const printStyles = `
            @page {
                margin-left: 0;
                margin-right: 0;
                margin-top: 0;
                margin-bottom: 0;
                size: auto;
            }

            .print-adjust {
                padding: 0 !important; /* Remove padding for print */
            }

            html, body {
                margin: 0;
                padding: 0;
                width: 100%;  
            }
            

            body {
                margin: 0;
                padding: 0;
                line-height: 1.2;
                transform-origin: top left;
            }

            .single-blog-container {
                margin: 0;
                padding: 0;
                width: 100%;  /* Ensure full page width */
                display: block;  /* Prevent internal margins from affecting layout */
            }

            .blog-title, .blog-description, .blog-image {
                margin: 0;
                padding: 0;
                width: 100%;
            }

            .blog-image {
                
                width: 100%;  /* Ensure image spans full width of the container */
                height: 150%;  /* Maintain aspect ratio */
                object-fit: cover;
            }

            .profile-img {
                width: 100%;  /* Ensure image spans full width of the container */
                height: 100%;  /* Maintain aspect ratio */
                object-fit: cover;
                padding: 5px;
                object-fit: cover;
                border-radius: 50%;
            }

            .print-button, .press-link {
                display: none !important;
            }
            `;

    let styleTag;

    window.addEventListener('beforeprint', function () {
        // Create a new <style> element
        styleTag = document.createElement('style');
        styleTag.innerHTML = printStyles;

        // Append the <style> element to the <head> section of the document
        document.head.appendChild(styleTag);
    });

    window.addEventListener('afterprint', function () {
        // Remove the style tag from the document after printing
        if (styleTag) {
            document.head.removeChild(styleTag);
        }
    });

    function printBlog() {
        // Select the blog content you want to print (excluding Press Link and Print button)
        const printContent = document.querySelector('.single-blog-container');
        const latestBlogsSection = document.querySelector('.latest-blogs'); // The section you want to exclude
        const pressLinkButtons = document.querySelectorAll('.press-link');
        const printButtons = document.querySelectorAll('.print-button');

        // Store the original visibility state of the elements
        const originalPressLinkButtonsDisplay = pressLinkButtons[0]?.style.display;
        const originalPrintButtonsDisplay = printButtons[0]?.style.display;
        const originalLatestBlogsSectionDisplay = latestBlogsSection?.style.display;

        // Temporarily hide the Press Link and Print buttons
        pressLinkButtons.forEach(button => button.style.display = 'none');
        printButtons.forEach(button => button.style.display = 'none');

        // Temporarily remove the Latest Press/Pr section
        if (latestBlogsSection) {
            latestBlogsSection.style.display = 'none';
        }

        // Ensure printContent is visible, while the rest is hidden
        const bodyContent = document.body;
        bodyContent.style.visibility = 'hidden'; // Hide the whole body content except the print section
        printContent.style.visibility = 'visible'; // Make only the printContent visible

        // Trigger the print dialog
        window.print();

        // After printing or cancelling, restore the visibility of the original content
        bodyContent.style.visibility = 'visible';
        if (latestBlogsSection) {
            latestBlogsSection.style.display =
                originalLatestBlogsSectionDisplay; // Restore Latest Blogs section visibility
        }

        pressLinkButtons.forEach(button => button.style.display =
            originalPressLinkButtonsDisplay); // Restore Press Link button visibility
        printButtons.forEach(button => button.style.display =
            originalPrintButtonsDisplay); // Restore Print button visibility
    }
</script>
@endsection