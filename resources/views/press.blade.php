@extends('layout.app')
@foreach ($blogs as $blog)
    @section('og:image', $blog->shareImage)
    @section('og:title', $blog->shareTitle)
    @section('og:description', $blog->shareDescription)
    @section('og:url', $blog->shareUrl)

    @section('main_section')
    <style media="screen">
        .blog-list {
            display: flex;
            flex-direction: column;
            /* gap: 1.5rem; */
            height: 490px;
            overflow-y: auto;
            padding-right: 20px;
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
            width: 100px;
            height: 115px;
            object-fit: contain;
            border-radius: 3px;

        }

        .blog-details {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-left: 20px;
            /* Space between title and meta */
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

        .blog-meta {
            font-size: 0.9rem;
            color: #666;
        }

        .pagination-links {
            display: flex;
            margin-top: 20px;
        }

        .pagination {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .pagination .page-item {
            margin: 0 5px;
        }

        .pagination .page-link {
            font-size: 0.875rem;
            padding: 5px 10px;
            border-radius: 4px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            color: #333;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .pagination .page-link:hover {
            background-color: #125259;
            /* Change hover background color */
            color: #fff;
            /* Change text color on hover */
            text-decoration: none;
            /* Prevent underline on hover */
        }

        .pagination .page-item.active .page-link {
            background-color: #125259;
            /* Active background color */
            color: #fff;
            /* Active text color */
            border: 1px solid #125259;
            /* Match border with background */
        }

        .pagination .page-item.disabled .page-link {
            background-color: #e9ecef;
            /* Disabled background */
            color: #6c757d;
            /* Disabled text color */
            pointer-events: none;
            /* Prevent interaction */
        }

        /* @media (min-width: 769px) {
                                            .blog-list {
                                                display: none;
                                            }
                                        } */

        .wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1.5rem;
            /* Reduced gap for smaller cards */
            padding: 2rem;
            height: 600px;
            /* Set a fixed height */
            overflow-y: auto;
            /* Enable vertical scrolling */
            scroll-behavior: smooth;
            /* Smooth scrolling */
        }

        /* .card {
                    overflow: hidden;
                    border-radius: 12px;
                    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                    width: 270px;
                    margin: 1rem;
                    cursor: pointer;
                    position: relative;
                    overflow: hidden;
                } */

        .card:hover {
            transform: scale(1.05);
            box-shadow: rgba(0, 0, 0, 0.2) 0px 15px 50px 0px;
        }

        .card-banner {
            position: relative;
            height: 160px;
            /* Decreased height for the banner image */
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-banner img {
            object-fit: cover;
            height: 100%;
            width: 100%;
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
            top: 1rem;
            right: 1rem;
            border-radius: 2rem 0 0 2rem;
        }

        .card-body {
            padding: 1rem;
            /* Reduced padding for the card body */
            background-color: #fff;
            border-top: 4px solid #ef257a;
            border-radius: 0 0 12px 12px;
        }

        .blog-hashtag {
            font-size: 0.8rem;
            /* Smaller font size for the date */
            font-weight: 600;
            color: #ef257a;
            margin-bottom: 0.3rem;
            /* Reduced margin */
        }

        .blog-title {
            font-size: 1.1rem;
            /* Reduced font size for the title */
            font-weight: bold;
            /* color: #ef257a; */
            line-height: 1.4rem;
            /* Reduced line-height */
            margin: 0.3rem 0;
            /* Reduced margin */
        }

        .blog-description {
            color: #616b74;
            font-size: 0.9rem;
            /* Smaller font size */
            margin: 0;
            line-height: 1.4;
        }

        .card-profile {
            display: flex;
            align-items: center;
            margin-top: 1rem;
            /* Reduced margin */
        }

        .profile-img {
            width: 40px;
            /* Smaller profile image */
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #feb47b;
            /* Smaller border */
        }

        .card-profile-info {
            margin-left: 0.8rem;
            /* Reduced margin */
        }

        .pulished_by {
            font-size: 1rem;
            /* Smaller font size */
            font-weight: 600;
            color: #125259;
        }

        .profile-name {
            font-size: 0.9rem;
            /* Smaller font size */
            font-weight: 700;
            margin: 0;
            color: #333;
        }

        .profile-followers {
            color: #616b74;
            font-size: 0.8rem;
            /* Smaller font size */
            text-decoration: none;
        }

        .profile-followers:hover {
            color: #ff7e5f;
        }

        /* Press Section */
        .press-section {
            padding-bottom: 0.5rem;
            /* padding: 1.5rem 2rem; */
            /* background-color: #125259; */
            text-align: center;
            color: white;
        }

        .press-section h1 {
            font-size: 2.2rem;
            font-weight: bold;
            /* margin-bottom: 1rem; */
        }

        .press-section p {
            font-size: 1.1rem;
            color: #d1e0e0;
            /* margin-bottom: 1.5rem;
                                            line-height: 1.6; */
        }

        .press-intro {
            font-style: italic;
            font-size: 1.3rem;
            /* margin-top: 1.5rem; */
            color: #ffebd0;
            /* max-width: 800px; */
            max-width: 1250px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Press Card Styles */
        .press-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
            margin-top: 3rem;
        }

        .press-card {
            width: 350px;
            background-color: #fff;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .press-card:hover {
            transform: scale(1.05);
            box-shadow: rgba(0, 0, 0, 0.2) 0px 15px 50px 0px;
        }

        .press-image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .press-content {
            padding: 1rem;
            text-align: left;
        }

        .press-title {
            font-size: 1.4rem;
            color: #125259;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .press-details {
            font-size: 1rem;
            color: #616b74;
            margin-bottom: 1rem;
        }

        .press-link {
            font-size: 1rem;
            color: #ff7e5f;
            text-decoration: none;
            font-weight: bold;
        }

        .press-link:hover {
            text-decoration: underline;
        }

        .contact-link {
            color: #ef257a;
            font-weight: bold;
            text-decoration: none;
        }

        .custom-btn {
            background-color: #ef257a;
            color: white;
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .custom-btn:hover {
            background-color: #d21f66;
            /* Slightly darker shade for hover effect */
            transform: scale(1.05);
        }

        /* Mobile responsiveness */
        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .press-media-heading {
                font-size: 2rem;
            }

            .wrapper {
                display: none;
            }

            /*
                    .card {
                        overflow: hidden;
                        border-radius: 12px;
                        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
                        transition: transform 0.3s ease, box-shadow 0.3s ease;
                        width: 100px;

                        cursor: pointer;
                        position: relative;
                        overflow: hidden;
                    } */

            .card-banner {
                position: relative;
                height: 100px;
                /* Decreased height for the banner image */
                overflow: hidden;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .card-banner img {
                object-fit: cover;
                height: 50%;
                width: 50%;
            }

            .press-section h1 {
                font-size: 1.2rem;
                font-weight: bold;
                margin-bottom: 1rem;
            }

            .press-section p {
                font-size: 0.8rem;
                font-weight: 600;
                margin-bottom: 1px;
                /* line-height: 1.6; */
            }

            .blog-title {
                font-size: 0.9rem;
                /* Smaller font size for titles on mobile */
                line-height: 1.2rem;
                /* Adjust line-height */
                margin: 0.2rem 0;
                /* Reduced margin */
            }

            .blog-description {
                font-size: 0.8rem;
                /* Smaller font size for descriptions */
                line-height: 1.3;
                /* Adjust line-height */
            }

            .press-section {
                /* padding: 2rem 2rem; */
                /* background-color: #125259; */
                text-align: center;
                color: white;
            }

        }
    </style>
    <div class="position-relative text-white"
        style="background-color: #125259; background-image: url('{{ asset('images/home-section-1.png') }}'); background-size: cover; background-position: center;">
        <div class="overlay"
            style="background: rgba(0, 0, 0, 0.6); position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 1;">
        </div>

        <div style="position: relative; z-index: 2;">
            @include('components.navbar')
            <div class="press-section text-center">
                <h1 class="display-4 font-weight-bold">Press & Media</h1>
                @guest
                    <div class="d-flex justify-content-center">
                        <!-- Register Button -->
                        <a href="{{ route('register') }}"
                            class="btn btn-sm btn-warning text-white px-4 py-2 rounded-pill mr-3 shadow-sm hover-effect">
                            <i class="fas fa-user-plus mr-2"></i> Register
                        </a>

                        <!-- Login Button -->
                        <a href="{{ route('user.login') }}"
                            class="btn btn-sm btn-warning text-white px-4 py-2 rounded-pill shadow-sm hover-effect">
                            <i class="fas fa-sign-in-alt mr-2"></i> Login
                        </a>
                    </div>
                @endguest
                <p class="press-intro mb-0">
                    Here you can read about any independent press reviews, articles, or news about ROBOT Kombucha.<br>
                    If you’d like to write about ROBOT, or if you’re a press journalist interested in a sample for review,
                    please <a href="mailto:press@robotkombucha.co.uk" class="contact-link">get in touch via email</a>.
                    “ROBOT is an innovative revolution in the soft-drinks industry—a solution to the problem of high-sugar
                    fizzy
                    colas. ROBOT is a healthy, sustainable, nutritious drink that tastes identical to global giant brands,
                    with one
                    major difference: it’s healthy! Our Organic Honey Cola Kombucha offers all the familiar flavors of
                    classic cola
                    without any of the unhealthy aspects.”
                </p>
                <a href="{{ route('advocate.ambassador') }}"
                    class="btn btn-outline-warning px-2 py-2 font-weight-bold text-uppercase rounded-pill">ROBOT -
                    Advocates & Ambassadors</a>
            </div>
        </div>
    </div>
    <!--For Mobile-->
    <div class="container mt-4">
        <div class="row">
            <!-- Blog List -->
            <div class="col-lg-12 col-md-12 col-sm-8">
                <div class="container blog-list">
                    <div class="row">
                        <!-- Loop through blogs, show two per row -->
                       
                                @foreach ($blogs as $index => $blog)
                                        @if ($index % 2 == 0 && $index != 0)
                                            </div> <!-- Close the previous row -->
                                            <div class="row"> <!-- Start a new row for the next set of blogs -->
                                        @endif
                                        <div class="col-md-6 mb-2"> <!-- Two blogs per row -->
                                            <a href="{{ route('press.show', $blog->slug) }}">
                                                <div class="blog-item">
                                                    <img src="{{ asset('storage/' . ($blog->images->first()->imagename ?? 'default-image.jpg')) }}"
                                                        alt="Article Thumbnail" class="thumbnail shadow-lg">
                                                    <div class="blog-details">
                                                        <a href="{{ route('press.show', $blog->slug) }}"
                                                            class="blog-title">{{ $blog->title }}</a>
                                                        <div class="blog-meta">
                                                            <p class="blog-hashtag"><i class="fas fa-calendar-alt"></i>
                                                                {{ $blog->created_at->format('M d, Y') }}</p>
                                                            @if(!empty($blog->published_by)) 
                                                                <h3 class="profile-name mb-1">Published By:
                                                                    {{ $blog->published_by ?? 'Unknown User' }}
                                                                </h3>
                                                            @endif    
                                                            @if(!empty($blog->written_by))
                                                                <h3 class="profile-name mb-1">Written By:
                                                                    {{ $blog->written_by ?? 'Unknown User' }}
                                                                </h3>
                                                            @endif 
                                                            <a href="{{ $blog->press_link }}" target="_blank"
                                                                class="btn btn-sm btn-info custom-btn profile-followers">Press Link</a>
                                                        </div>
                                                        <div class="d-flex justify-content-start align-items-center mb-3">
                                                            <div class="share-buttons">
                                                                <div class="row no-gutters">
                                                                    <!-- Facebook -->

                                                                    <div class="col-1">
                                                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($blog->shareUrl) }}&picture={{ urlencode($blog->shareImage) }}"
                                                                            target="_blank" class="share-icon">
                                                                            <i class="fa-brands fa-facebook fa-lg"
                                                                                style="color: #4267B2"></i>
                                                                        </a>
                                                                    </div>


                                                                    <!-- Twitter -->
                                                                    <div class="col-1">
                                                                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->shareTitle) }}&url={{ urlencode($blog->shareUrl) }}"
                                                                            target="_blank" class="share-icon">
                                                                            <i class="fa-brands fa-twitter fa-lg"
                                                                                style="color: #1DA1F2"></i>
                                                                        </a>
                                                                    </div>

                                                                    <!-- LinkedIn -->
                                                                    <div class="col-1">
                                                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($blog->shareUrl) }}"
                                                                            target="_blank" class="share-icon">
                                                                            <i class="fa-brands fa-linkedin fa-lg"
                                                                                style="color: #0077B5"></i>
                                                                        </a>
                                                                    </div>

                                                                    <!-- WhatsApp -->
                                                                    <div class="col-1">
                                                                        <a href="https://api.whatsapp.com/send?text={{ urlencode($blog->shareUrl) }}"
                                                                            target="_blank" class="share-icon">
                                                                            <i class="fa-brands fa-whatsapp fa-lg"
                                                                                style="color:#25D366"></i>
                                                                        </a>
                                                                    </div>

                                                                    <!-- Telegram -->
                                                                    <div class="col-1">
                                                                        <a href="https://telegram.me/share/url?url={{ urlencode($blog->shareUrl) }}&text={{ urlencode($blog->shareTitle) }}"
                                                                            target="_blank" class="share-icon">
                                                                            <i class="fa-brands fa-telegram fa-lg"
                                                                                style="color: #0088cc"></i>
                                                                        </a>
                                                                    </div>

                                                                    <!-- Pinterest -->
                                                                    <div class="col-1">
                                                                        <a href="https://pinterest.com/pin/create/button/?url={{ urlencode($blog->shareUrl) }}&media={{ urlencode($blog->shareImage) }}&description={{ urlencode($blog->shareTitle) }}"
                                                                            target="_blank" class="share-icon">
                                                                            <i class="fa-brands fa-pinterest fa-lg"
                                                                                style="color: 	#E60023"></i>
                                                                        </a>
                                                                    </div>

                                                                    <!-- Reddit -->
                                                                    <div class="col-1">
                                                                        <a href="https://www.reddit.com/submit?url={{ urlencode($blog->shareUrl) }}&title={{ urlencode($blog->shareTitle) }}"
                                                                            target="_blank" class="share-icon">
                                                                            <i class="fa-brands fa-reddit fa-lg" style="color: #FF4500"></i>
                                                                        </a>
                                                                    </div>

                                                                    <!-- Email -->
                                                                    <div class="col-1">
                                                                        <a href="mailto:?body={{ urlencode($blog->shareUrl) }}"
                                                                            target="_blank" class="share-icon">
                                                                            <i class="fa-solid fa-envelope fa-lg"
                                                                                style="color: #000000"></i>
                                                                        </a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </a>

                                        </div>
                                @endforeach
                      
                    </div>
                    <!-- Loading more blogs message -->
                    <div id="loading-message" style="display: none;">Loading more Press...</div>

                    <!-- No more blogs message -->
                    <div id="no-more-blogs-message" style="display: none;text-align:center;" class="fw-bold">No more Press available.</div>
                </div>
            </div>

            <!-- Contact Section (New Row) -->
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4 mt-4">
                <div class="contact-section"
                    style="display: flex;background-color: #125259;padding: 1rem;color: white;justify-content: center;flex-direction: column;align-items: center;">
                    <h2 style="color: #fffff; font-size: 2rem;">Press & Media</h2>
                    <p style="color: #ffffff; font-size: 1rem; margin-bottom: 1.5rem;">
                        If you have any press-related questions, feel free to reach out to us via the contact information
                        below.
                    </p>

                    <div class="flex-sm-row gap-2">
                        <!-- Phone Section -->
                        <div class="mb-1" style="flex: 1; display: flex;">
                            <p class="mb-2" style="margin: 0; font-size: 1rem;">
                                <i class="fas fa-phone-alt"></i>
                                <br>
                            <div class="mx-2">
                                <a href="tel:03333553600"
                                    style="color: #f0f0f0; text-decoration: none; font-size: 1rem;">Phone: 0333 355
                                    3600</a>
                                <br>
                                <a href="tel:07976826004"
                                    style="color: #f0f0f0; text-decoration: none; font-size: 1rem;">Mobile: 07976
                                    826004</a>
                            </div>
                            </p>
                        </div>

                        <!-- Media Director Section -->
                        <div class="mb-1 mt-1" style="flex: 1; display: flex;">
                            <p class="mb-2" style="margin: 0; font-size: 1rem;">
                                <i class="fas fa-user mb-1"></i>
                                <br>
                            <div class="mx-2">
                                PR Director: Simon Turton<br>
                                Care Of: Opera PR & Communications,
                            </div>
                            </p>
                        </div>

                        <!-- Email Section -->
                        <div class="mb-1 mt-1" style="flex: 1; display: flex;">
                            <p class="mb-2" style="margin: 0; font-size: 1rem;">
                                <i class="fas fa-envelope"></i><br>
                            <div class="mx-2">
                                <a href="mailto:simon@operapr.com"
                                    style="color: #f0f0f0; text-decoration: none; font-size: 1rem;">simon@operapr.com</a>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
@endforeach

@section('customJs')
<script>
    let isLoading = false;
let currentPage = 1;
let noMoreBlogs = false;

window.addEventListener('scroll', async function() {
    // Check if loading is in progress or no more blogs
    if (isLoading || noMoreBlogs) return;

    const scrollPosition = window.innerHeight + window.scrollY;
    const bottomPosition = document.documentElement.scrollHeight;

    // Trigger when the user is 500px away from the bottom of the page
    if (scrollPosition >= bottomPosition - 500) {
        isLoading = true;

        // Show loading message
        document.getElementById('loading-message').style.display = 'block';

        // Simulate fetching more blogs
        currentPage++;

        // If there are no more blogs to load, show the "No more blogs" message
        if (currentPage > 3) { // Assume you have 3 pages of blogs max (adjust as needed)
            noMoreBlogs = true;
            document.getElementById('no-more-blogs-message').style.display = 'block';
        } else {
            const data = ''; // Simulating no new data, replace with actual fetch request

            if (!data.trim()) {
                noMoreBlogs = true;
                document.getElementById('no-more-blogs-message').style.display = 'block';
            } else {
                // Append the new blogs to the page
                const blogContainer = document.getElementById('blog-container');
                blogContainer.insertAdjacentHTML('beforeend', data);
            }
        }

        // Hide loading message
        document.getElementById('loading-message').style.display = 'none';

        // Reset loading state
        isLoading = false;
    }
});

</script>
<!-- <script>
    document.addEventListener("DOMContentLoaded", () => {
        const blogList = document.querySelector('.blog-list');
        let currentPage = 1; // Start with the first page
        const loadingIndicator = document.createElement('div');
        loadingIndicator.textContent = "Loading...";
        loadingIndicator.style.textAlign = "center";
        blogList.appendChild(loadingIndicator);

        const loadBlogs = async () => {
            try {
                const response = await fetch(`/press?page=${currentPage}`);
                if (!response.ok) throw new Error("Failed to load blogs");
                const html = await response.text();
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = html;

                const newBlogs = tempDiv.querySelectorAll('.blog-item');
                newBlogs.forEach(blog => blogList.insertBefore(blog, loadingIndicator));

                // Remove loading indicator if there are no more blogs
                if (newBlogs.length === 0) {
                    loadingIndicator.textContent = "No more Press/Pr";
                    observer.disconnect();
                }
            } catch (error) {
                console.error(error);
            }
        };

        const observer = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) {
                currentPage++;
                loadBlogs();
            }
        });

        observer.observe(loadingIndicator);
    });
</script> -->
@endsection