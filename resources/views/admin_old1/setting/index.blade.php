@extends('admin.layout.master')
@section('main_section')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h4>Site Setting</h4>
        </div>
        <div class="card-body">
            {{-- <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                @checked($setting->payment_active == 'true') value="1">
                <label class="form-check-label" for="flexSwitchCheckDefault">Disable Ecommerce</label>
            </div> --}}

            <!-- salse btn -->
            <div class="form-check form-switch">
                <!-- When sales_status is 1 (disabled), the checkbox will be unchecked (sales OFF). If sales_status is 0 (enabled), it will be checked (sales ON). -->
                <input 
                    class="form-check-input" 
                    type="checkbox" 
                    id="toggleSalesStatus" 
                    @checked($setting->sales_status == 0) 
                    value="1">  <!-- Value of 1 means "disable sales", 0 means "enable sales" -->
                <label class="form-check-label" for="toggleSalesStatus">
                    Disable E-commerce
                </label>
            </div> 
        </div>

        
    </div>
</div>
    
    <script>
        $('#flexSwitchCheckDefault').change(function(e) {
            e.preventDefault();
            var value = $(this).is(':checked');
            $.ajax({
                type: "GET",
                url: "{{ route('post.site.setting') }}",
                data: {
                    value: value
                },
                success: function(response) {
                    console.log(response);
                    // toastr.success("Setting updated");
                }
            });
        });
    </script>

    

    <script>
        // Ensure the checkbox is initialized correctly based on the current sales_status
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('toggleSalesStatus');
            
            // When the checkbox is changed, send the updated sales status to the backend
            toggle.addEventListener('change', function () {
                const salesStatus = this.checked ? 0 : 1; // If checked, sales are ON (0), if unchecked, sales are OFF (1)
    
                // Send the updated sales status to the backend via AJAX
                fetch('/admin/update-sales-status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'  // CSRF token for security
                    },
                    body: JSON.stringify({ sales_status: salesStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Sales status updated successfully!');
                    } else {
                        alert('Failed to update sales status.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
            });
        });
    </script>
@endsection
