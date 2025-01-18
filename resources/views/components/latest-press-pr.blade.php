<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest Blogs</title>

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <style>
        .img-fluid {
            object-fit: cover;
            border-radius: 8px;
        }

        .news-carousel .item {
            position: relative;
            height: 300px;
            /* Fixed height for carousel items */
            overflow: hidden;
        }

        .news-carousel img {
            width: 100%;
            height: auto;
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
        }

        .news-carousel img:hover {
            transform: scale(1.1);
            border-radius: 8px;
        }

        .news-carousel .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 15px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 0 0 8px 8px;
            transition: background 0.3s;
            display: flex;
            flex-direction: column;
            /* Aligns content vertically */
        }

        .news-carousel .overlay:hover {
            background: rgba(0, 0, 0, 0.7);
        }

        /* Title, Date, and Category in the same row */
        .news-carousel .content-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .news-carousel .left-content {
            flex: 1;
        }

        .news-carousel .h6 {
            font-size: 18px;
            line-height: 1.4;
            color: white;
            text-transform: uppercase;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .news-carousel .h6:hover {
            color: #FF5722;
        }

        .news-carousel .left-content p {
            font-size: 12px;
            margin-top: 5px;
            color: white;
            font-weight: normal;
        }

        .news-carousel .badge {
            font-size: 12px;
            background-color: #FF5722;
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            font-weight: bold;
            display: inline-block;
        }

        /* Social Share Section */
        .news-carousel .social-share {
            display: flex;
            justify-content: space-around;
            margin-top: 10px;
            width: 100%;
        }

        .social-share a {

            padding: 8px;
            border-radius: 50%;
            color: white;
            transition: background-color 0.3s;
        }

        .social-share a:hover {
            background-color: #FF5722;
        }

        .social-share .btn-linkedin {
            background-color: #FFB900;
            /* LinkedIn yellow background */
            color: white;
            /* White icon */
            padding: 8px;
            /* Adjust padding to make it look good */
            border-radius: 50%;
            /* Make the button circular */
            transition: background-color 0.3s ease;
        }

        .social-share .btn-linkedin:hover {
            background-color: #FF9800;
            /* Darker yellow on hover */
        }

        .owl-carousel .owl-nav button {
            background-color: #FF5722;
            border: none;
            color: white;
            border-radius: 50%;
            padding: 10px;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
        }

        .owl-carousel .owl-nav .owl-prev {
            left: 10px;
        }

        .owl-carousel .owl-nav .owl-next {
            right: 10px;
        }

        .owl-carousel .owl-dots {
            display: none;
        }

        @media (max-width: 576px) {
            .news-carousel .overlay
            {
              /  padding: 0px;
            }
            .news-carousel .item {
            position: relative;
            height: 400px;
            /* Fixed height for carousel items */
            overflow: hidden;
        }
            .news-carousel .social-share {
                flex-direction: row;
                align-items: center;
            }

            .social-share a {
                margin: 5px 0;
            }

            /* Increase image size on mobile */
            .news-carousel img {
                height: 350px;
                /* Increased image height */
            }

            /* Adjust title, date, and category for mobile */
            .news-carousel .content-row {
                flex-direction: column; /* Stack elements vertically */
                align-items: flex-start;
            }
            .news-carousel .left-content {
        order: 1; /* Title first */
    }

    .news-carousel .left-content p {
        order: 2; /* Date second */
    }

    .news-carousel .right-content {
        order: 3; /* Category button last */
        width: 100%; /* Make sure the category spans full width */
        margin-top: 10px; /* Add spacing between items */
    }

            .news-carousel .h6 {
                font-size: 16px;
            }

            .news-carousel .left-content p {
                font-size: 14px;
            }

            .news-carousel .badge {
                font-size: 14px;
                margin-top: 5px;
            }
        }
    </style>
</head>

<body>

    <!-- Latest Blogs Section -->

    <div class="container-fluid pt-5 mb-3">
        <div class="container">
            <div class="section-title mb-4">
                <h3 class="m-0 text-uppercase font-weight-bold">Our Latest Press/Blogs</h3>
            </div>
            <div class="owl-carousel news-carousel position-relative" id="latest-blogs-carousel">
                <!-- Blogs will be dynamically injected here -->
            </div>
        </div>
    </div>

    <!-- jQuery (you can uncomment the line below if jQuery is needed, but Owl Carousel does not require it) -->
    {{--
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <!-- Owl Carousel JS -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const latestBlogsUrl = "{{ route('latestblogs') }}";

            fetch(latestBlogsUrl)
                .then(response => response.json())
                .then(data => {
                    const carouselContainer = document.getElementById("latest-blogs-carousel");

                    if (!data.length) {
                        carouselContainer.innerHTML = `  
                    <div class="text-center w-100">
                        <p>No blogs available at the moment.</p>
                    </div>
                `;
                        return;
                    }

                    // Get the top 6 blogs
                    const topBlogs = data.slice(0, 6);

                    topBlogs.forEach(blog => {
                        const carouselItem = document.createElement("div");
                        carouselItem.classList.add("item"); // Use 'item' class for Owl Carousel items

                        // Limit title to 5 words
                        let title = blog.title;
                        const words = title.split(' ');
                        if (words.length > 5) {
                            title = words.slice(0, 5).join(' ') + "..."; // Join the first 5 words and add "..."
                        }

                        // Determine the URL based on blog_type
                        const baseUrl = window.location.origin; // Get the base URL of the current site
                        const blogUrl = blog.blog_type === 'article' ? `${baseUrl}/press/${blog.slug}` : `${baseUrl}/blog/${blog.slug}`;

                        // Social media share URLs
                        const fbShareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(blogUrl)}`;
                        const twitterShareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(blogUrl)}&text=${encodeURIComponent(title)}`;
                        const whatsappShareUrl = `https://api.whatsapp.com/send?text=${encodeURIComponent(title + " " + blogUrl)}`;
                        const linkedinShareUrl = `https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(blogUrl)}&title=${encodeURIComponent(title)}`;
                        const telegramShareUrl = `https://t.me/share/url?url=${encodeURIComponent(blogUrl)}&text=${encodeURIComponent(title)}`;
                        const redditShareUrl = `https://www.reddit.com/submit?url=${encodeURIComponent(blogUrl)}&title=${encodeURIComponent(title)}`;
                        const pinterestShareUrl = `https://pinterest.com/pin/create/button/?url=${encodeURIComponent(blogUrl)}&description=${encodeURIComponent(title)}`;
                        const mailShareUrl = `mailto:?subject=${encodeURIComponent(title)}&body=${encodeURIComponent(blogUrl)}`;

                        carouselItem.innerHTML = `
                        <img class="img-fluid" src="/storage/${blog.images[0]?.imagename || 'default.jpg'}" alt="${blog.title}">
                        <div class="overlay">
                            <!-- Left side: Title and Date -->
                            <div class="content-row">
                                <div class="left-content">
                                    <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="${blogUrl}">
                                        ${title}
                                    </a>
                                    <p class="text-white mt-1"><small>${new Date(blog.created_at).toLocaleDateString()}</small></p>
                                </div>

                                <!-- Right side: Category -->
                                <p class="badge mt-1 right-content">
                                    ${blog.category || "General"}
                                </p>
                            </div>

                            <!-- Social Share in a new row -->
                            <div class="social-share mt-3">
                                <a href="${fbShareUrl}" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="${twitterShareUrl}" target="_blank" class="btn btn-info btn-sm">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="${whatsappShareUrl}" target="_blank" class="btn btn-success btn-sm">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <a href="${linkedinShareUrl}" target="_blank" class="btn btn-linkedin btn-sm">
                                    <i class="fab fa-linkedin" style="background-color: #FFB900;"></i>  
                                </a>
                                <a href="${telegramShareUrl}" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fab fa-telegram"></i>
                                </a>
                                <a href="${redditShareUrl}" target="_blank" class="btn btn-danger btn-sm">
                                    <i class="fab fa-reddit"></i>
                                </a>
                                <a href="${pinterestShareUrl}" target="_blank" class="btn btn-danger btn-sm">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                                <a href="${mailShareUrl}" target="_blank" class="btn btn-dark btn-sm">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    `;
                        carouselContainer.appendChild(carouselItem);
                    });

                    $(".owl-carousel").owlCarousel({
                        loop: true,
                        margin: 20,
                        nav: true,
                        autoplay: true,
                        autoplayTimeout: 5000,
                        responsive: {
                            0: {
                                items: 1
                            },
                            576: {
                                items: 2
                            },
                            768: {
                                items: 3
                            },
                            992: {
                                items: 4
                            }
                        },
                        navText: [
                            '<i class="fas fa-arrow-left"></i>',
                            '<i class="fas fa-arrow-right"></i>',
                        ]
                    });
                })
                .catch(error => console.error("Error fetching latest blogs:", error));
        });
    </script>

</body>

</html>