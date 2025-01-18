<div class="position-relative py-3" style="background-color: #d93b75;">
    <div class="mt-3 container py-5">
        <div class="row w-100 align-items-center m-auto">
            <div class="col-lg-6 col-12 text-white gap-lg-0 gap-3 ">
                <h2 class="fw-bold fs-1 mb-2">Contact Us</h2>
                <h4>We'd love to hear from you! If you have any questions, comments or suggestions, please do not
                    hesitate to contact us.</h4>
                <h5 class="my-2">We value your opinions and are committed to providing you with the best product
                    possible.</h5>
                <p>Address: 85 Great Portland Street, London, W1W 7LT, United Kingdom</p>
                <a href="https://www.netzerofoods.org" target="_blank">
                    <img src="{{ asset('images/section-8-small-img.png') }}" alt="" class="img-fluid w-25">
                </a>
            </div>
            <div class="col-lg-6 col-12">
               <form action="{{ route('submit.contact.form') }}" method="POST">
    @csrf
    <div class="mb-3">
        <input type="text" class="form-control rounded-4" placeholder="Name" name="name" required>
    </div>
    <div class="mb-3">
        <input type="email" class="form-control rounded-4" placeholder="Email" name="email" required>
    </div>
    <div class="mb-3">
        <input type="tel" class="form-control rounded-4" placeholder="Phone" name="phone" required>
    </div>
    <div class="mb-3">
        <input type="text" class="form-control rounded-4" placeholder="Subject" name="subject" required>
    </div>
    <div class="mb-3">
        <textarea type="text" class="form-control rounded-4" placeholder="Message" name="message" rows="6" required></textarea>
    </div>
    <div class="mb-3">
        <h3 class="fw-bold mb-2 text-white">GDPR Agreemnet*</h3>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="GDPR" required>
            <label class="form-check-label text-white" for="GDPR">
                I consent to having this website store my submitted information so they can respond to my inquiry
            </label>
          </div>
    </div>
    <div class="mb-3">
        <button class="btn w-50 rounded-4" type="submit" style="background: #f2a71b">Send Message</button>
    </div>
</form>

            </div>
        </div>
    </div>
</div>
