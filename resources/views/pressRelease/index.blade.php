@extends('layout.app')

@section('main_section')
    <div class="position-relative text-white" style="background-color: #125259;">
        <div>
            @include('components.navbar')
        </div>
        <div class="press-section m-4">
            <h1 class="fw-bold fs-1">Press Pack</h1>
            <div class="fs-1_3rem mt-3 mb-3">
                <p style="font-size: 1.3rem;padding:3px;">Stay updated with the latest news and announcements from our company. Our press releases provide insights
                    into our new product launches, partnerships, community engagements, and other exciting developments. Read on
                    to learn more about our ongoing efforts to innovate and grow.</p>
                <p style="font-size: 1.3rem;padding:3px;">We are thrilled to share our latest initiatives and milestones. Our press releases cover a range of topics,
                    including:</p>
                <p style="font-size: 1.3rem;padding:3px;">Our press releases are designed to keep our stakeholders informed and engaged with our progress. Whether you
                    are a media professional, investor, or customer, our updates offer valuable insights into the company's
                    growth and future plans.</p>
                <p style="font-size: 1.3rem;padding:3px;">If you would like to stay informed about our latest news, please feel free to <a href="{{ route('news.letter') }}" style="color: yellow">subscribe to
                        our newsletter</a> or contact our press team for more information.</p>
            </div>
            
        </div>
    </div>

    <div class="container py-5">
        <h1 class="text-center mb-4" style="font-weight: 500;font-size: 3.5rem;">Our Media Kit</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <!-- Media Kit Card 1 -->
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-img-top d-flex justify-content-center align-items-center" style="height: 100px;">
                        <i class="fas fa-file-pdf fa-4x text-danger"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">All Media Kit</h5>
                        <p class="card-text">Explore our press kit with all Pdf and high-resolution images.</p>
                        <a href="{{ route('downloadMediaKit') }}" class="btn btn-danger text-white">
                            <i class="fas fa-download"></i> Download Media Kit
                        </a>
                        <small class="d-block mt-2 text-muted">FileType: Zip</small>
                    </div>
                </div>
            </div>

            <!-- Media Kit Card 2 -->
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-img-top d-flex justify-content-center align-items-center" style="height: 100px;">
                        <i class="fas fa-file-alt fa-4x text-success"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Web Kit</h5>
                        <p class="card-text">A comprehensive guide to our brand with logos, images, and press releases.</p>
                        <a href="{{ route('downloadImages') }}" class="btn btn-success text-white">
                            <i class="fas fa-download"></i> Download Images
                        </a>
                        <small class="d-block mt-2 text-muted">FileType: Zip</small>
                    </div>
                </div>
            </div>

            <!-- Media Kit Card 3 -->
            <div class="col">
                <div class="card shadow-sm">

                    <div class="card-img-top d-flex justify-content-center align-items-center" style="height: 100px;">
                        <i class="fas fa-newspaper fa-4x text-info"></i>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title">Guide</h1>
                        <p class="card-text">All the latest media materials and press contact information.</p>
                        <a href="{{ route('downloadPdfs') }}" class="btn btn-info text-white">
                            <i class="fas fa-download"></i> Download PDFs
                        </a>
                        <small class="d-block mt-2 text-muted">FileType: Zip</small>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('customCss')
<style>
    /* Custom Styles for the Media Kit Cards */
    .card {
        border-radius: 05px;
    }

    .card-body {
        text-align: center;
    }

    .card-text {
        font-size: 1rem;
        margin-bottom: 15px;
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: #f5f5f5;
    }
    /* Responsive Styles */
    @media (max-width: 576px) {
        .card-content .icon {
            font-size: 40px;
        }

        .card-content .title {
            font-size: 0.9rem;
        }

        .card-content .description {
            font-size: 0.8rem;
        }
    }

    .press-section {
        padding: 1.5rem 2rem;
        background-color: #125259;
        text-align: center;
        color: white;
        margin-top: 20px;
        height: 420px;
    }

    .press-section h1 {
        font-size: 2.2rem;
        font-weight: bold;
    }

    .fa-folder {
        font-size: 6rem;
    }

    .press-section p {
        font-size: 1.1rem;
        color: #d1e0e0;
    }



    /* Image hover effect */
    .card-img-top {
        margin-top: 20px;
        height: auto;
        /* Allow height to adjust */
        max-height: 230px;
        /* Max height */
        object-fit: cover;
        /* Maintain image aspect ratio */
        transition: transform 0.3s ease-in-out;
    }

    /* Card hover effect: Image grows slightly */
    .card:hover .card-img-top {
        transform: scale(1.1);
        /* Slightly scale up the image */
    }

    /* Title styling */
    .card-title {
        font-weight: bolder;
        font-size: 2.5rem;
        color: #000;
        text-align: center;
        margin-top: 10px;
    }

    /* Hover effect on card */
    .card:hover {
        transform: translateY(-10px);
        /* Elevate the card on hover */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        /* Add shadow for hover */
    }

    .card-style {

        padding: 12px;
        border-radius: 0;
        background: #f0f0f0;
    }

    .btn {
        font-size: 1rem;
        padding: 12px 25px;
        border-radius: 25px;
        text-transform: uppercase;
        font-weight: bold;
    }

    .btn-danger {
        background-color: #e74a3b;
        border-color: #e74a3b;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c0392b;
        border-color: #c0392b;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #218838;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: white;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #138496;
    }


    @media (max-width: 768px) {
        .press-section {
            height: auto;
        }

        /* Adjust card size for smaller screens */
        .card-img-top {
            max-height: 180px;
            /* Smaller image size on mobile */
        }

        /* Ensure 3 cards per row on mobile */
        .col-4 {
            width: 33.33%;
            /* 3 cards in a row */
        }
    }
</style>
@endsection
@section('customJs')
    <script>
        // Add share functionality
        document.addEventListener('DOMContentLoaded', () => {
            const shareButtons = document.querySelectorAll('.share-button');

            shareButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const fileUrl = button.getAttribute('data-url');
                    if (navigator.share) {
                        // Use Web Share API if available
                        navigator.share({
                            title: 'Check out this file',
                            url: fileUrl
                        }).catch(err => console.error('Error sharing:', err));
                    } else {
                        // Fallback for unsupported browsers
                        const tempInput = document.createElement('input');
                        document.body.appendChild(tempInput);
                        tempInput.value = fileUrl;
                        tempInput.select();
                        document.execCommand('copy');
                        document.body.removeChild(tempInput);
                        alert('Link copied to clipboard');
                    }
                });
            });
        });
    </script>

    <script>
        function shareFolder(title, link) {
            const shareData = {
                title: title,
                text: `Check out this folder: ${title}`,
                url: link
            };
            if (navigator.share) {
                navigator.share(shareData).catch((error) => console.error('Error sharing:', error));
            } else {
                alert('Sharing is not supported on this browser.');
            }
        }
    </script>
@endsection
