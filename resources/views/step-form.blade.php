@extends('layout.app')
@section('main_section')
    <div class="position-relative text-white" style="background-color: #0ba1a1;">
        <div>
            @include('components.navbar')
        </div>
    </div>
    <div class="position-relative" style="min-height: 55vh">
        <div
            style="z-index:0.5;position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('images/home-section-1.png'); opacity: 0.1;">
        </div>
        <style>
            .step {
                display: none;
            }

            .btn-primary {
                background: #F2A71B;
                color: white;
                border-radius: 15px;
                border: none;
                padding-left: 20px;
                padding-right: 20px;
            }
        </style>
        <div class="position-relative container py-5 col-6 mx-auto" style="min-height: 55vh">
            <div class="step my-5" id="step1" style="display: block;">
                <h4 class="mb-3">Hi, please can we get your first name?</h4>
                <div class="form-group mb-4">
                    <label for="firstName">First Name:</label>
                    <input type="text" class="form-control" id="firstName" required>
                </div>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
            </div>
            <div class="step my-5" id="step2">
                <h4 class="mb-3">Thanks Fred, what’s your last name?</h4>
                <div class="form-group mb-4">
                    <label for="lastName">Last Name:</label>
                    <input type="text" class="form-control" id="lastName" required>
                </div>
                <button type="button" class="btn btn-primary" onclick="prevStep()">Previous</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
            </div>
            <div class="step my-5" id="step3">
                <h4 class="mb-3">Ok - Fred Smith, thanks - we need your email ~ please type it below;</h4>
                <div class="form-group mb-4">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <button type="button" class="btn btn-primary" onclick="prevStep()">Previous</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
            </div>
            <div class="step my-5" id="step4">
                <h4 class="mb-3">Ok - we’re going to send you a code, via your email - so that you can verify your email
                    address..
                    ok?</h4>
                <button type="button" class="btn btn-primary" onclick="prevStep()">Previous</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
            </div>
            <div class="step my-5" id="step5">
                <h4 class="mb-3"> Ok - so we have now confirmed your email - can we get your mobile number please? This is
                    for
                    exclusive offers and invites.</h4>
                <div class="form-group mb-4">
                    <label for="email">Phone Number:</label>
                    <input type="tel" class="form-control" id="email" required>
                </div>
                <button type="button" class="btn btn-primary" onclick="prevStep()">Previous</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
            </div>
            <div class="step my-5" id="step6">
                <h4 class="mb-3">Great - thanks.. and finally, can we get your address ~ ? This is so that we can send you
                    exclusive offers and invites to events.</h4>
                <div class="form-group mb-4">
                    <label for="email">Passcode</label>
                    <input type="number" class="form-control" id="email" required>
                </div>
                <button type="button" class="btn btn-primary" onclick="prevStep()">Previous</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
            </div>
            <div class="step my-5" id="step7">
                <h4 class="mb-3">Ok great - which number do you live at?</h4>
                <div class="form-group mb-4">
                    <label for="email">Address</label>
                    <textarea name="" rows="5" class="form-control"></textarea>
                </div>
                <button type="button" class="btn btn-primary" onclick="prevStep()">Previous</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
            </div>
            <div class="step my-5" id="step8">
                <h4 class="py-5">Ok Fred - we have confirmed your details - thank you so much. We will be in touch with
                    any
                    special offers and invites.👍</h4>
            </div>
        </div>
    </div>
    <script>
        let currentStep = 1;
        const totalSteps = document.querySelectorAll('.step').length;
        function nextStep() {
            const currentStepElement = document.getElementById(`step${currentStep}`);
            const inputs = currentStepElement.querySelectorAll('input[required], textarea[required]');
            let isValid = true;
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    return;
                }
            });

            // Proceed to the next step only if all required fields are filled
            if (isValid) {
                if (currentStep < totalSteps) {
                    currentStepElement.style.display = 'none';
                    currentStep++;
                    document.getElementById(`step${currentStep}`).style.display = 'block';
                }
            } else {
                alert('Please fill out all required fields.');
            }
        }


        function prevStep() {
            if (currentStep > 1) {
                document.getElementById(`step${currentStep}`).style.display = 'none';
                currentStep--;
                document.getElementById(`step${currentStep}`).style.display = 'block';
            }
        }
    </script>
@endsection
