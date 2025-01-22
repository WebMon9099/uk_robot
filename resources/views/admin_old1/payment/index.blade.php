@extends('admin.layout.master')

@section('main_section')
<div class="container-xxl flex-grow-1 container-p-y">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $error }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endforeach
    @endif

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4 class="mb-3">Payments</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                    <i class="fa fa-plus-circle me-2"></i>
                    Add Payment
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="Datatable">
                    <thead>
                        <tr class="bg-light">
                            <th>Sno</th>
                            <th>Live Client Id</th>
                            <th>Live Secret Id</th>
                            <th>Sandbox Client Id</th>
                            <th>Sandbox Client Secret</th>
                            <th>Mode</th>
                            <th>Payment Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ Str::limit($payment->live_client_id, 9, '...') }}</td>
                            <td>{{ Str::limit($payment->live_client_secret, 9, '...') }}</td>
                            <td>{{ Str::limit($payment->sandbox_client_id, 9, '...') }}</td>
                            <td>{{ Str::limit($payment->sandbox_client_secret, 9, '...') }}</td>
                            <td>{{ $payment->mode }}</td>
                            <td>{{ $payment->payment_type }}</td>
                            <td>
                                <!-- Check the status and display Active or Inactive -->
                                @if($payment->status == 1)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-outline-primary btn-sm edit-btn" data-id="{{ $payment->id }}">

                                    <i class="fa fa-edit m-0"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Payment Modal -->
<div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add Payments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('payment.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="client_id" class="form-label">Sandbox Client Id</label>
                            <input type="text" name="client_id" id="client_id" class="form-control" required>
                            <small id="client_id_error" class="text-danger"></small>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="client_secret" class="form-label">Sandbox Secret Id</label>
                            <input type="text" name="client_secret" id="client_secret" class="form-control" required>
                            <small id="client_secret_error" class="text-danger"></small>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="live_client_id" class="form-label">Live Client Id</label>
                            <input type="text" name="live_client_id" id="live_client_id" class="form-control" required>
                            <small id="live_client_id_error" class="text-danger"></small>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="live_client_secret" class="form-label">Live Secret Id</label>
                            <input type="text" name="live_client_secret" id="live_client_secret" class="form-control" required>
                            <small id="live_client_secret_error" class="text-danger"></small>
                        </div>

                        <div class="col-md-2 mb-3">
                            <div class="form-check form-switch d-flex justify-content-between align-items-center mb-3">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Status</label>
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="status" value="1" {{ old('status', $payment->status ?? '') == 1 ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="mode" class="form-label">Mode</label>
                            <select name="mode" id="mode" class="form-control" required>
                                <option value="live">Live</option>
                                <option value="sandbox">Sandbox</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="payment_type" class="form-label">Payment Type</label>
                            <select name="payment_type" id="payment_type" class="form-control" required>
                                <option value="paypal">Paypal</option>
                            </select>
                        </div>

                        <div class="col-md-12 my-3">
                            <button class="btn btn-primary" type="submit">Add Payment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Payment Modal -->
<div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPaymentForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="edit_client_id" class="form-label">Sandbox Client Id</label>
                            <input type="text" name="client_id" id="edit_client_id" class="form-control" required>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="edit_client_secret" class="form-label">Sandbox Client Secret</label>
                            <input type="text" name="client_secret" id="edit_client_secret" class="form-control" required>
                        </div>
                       
                        <div class="col-md-5 mb-3">
                            <label for="edit_edit_live_client_id" class="form-label">Live Client Id</label>
                            <input type="text" name="edit_live_client_id" id="edit_live_client_id" class="form-control" required>
                            <small id="edit_live_client_id_error" class="text-danger"></small>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="edit_live_client_secret" class="form-label">Live Secret Id</label>
                            <input type="text" name="edit_live_client_secret" id="edit_live_client_secret" class="form-control" required>
                            <small id="edit_live_client_secret_error" class="text-danger"></small>
                        </div>

                        <div class="col-md-2 mb-3">
                            <div class="form-check form-switch mb-3">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Status</label>
                                @if ($payment->status == 1)
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="status" value="1" >
                                @else
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="status" value="0">
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="edit_mode" class="form-label">Mode</label>
                            <select name="mode" id="edit_mode" class="form-control">
                                <option value="live">Live</option>
                                <option value="sandbox">Sandbox</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="edit_payment_type" class="form-label">Payment Type</label>
                            <select name="payment_type" id="edit_payment_type" class="form-control">
                                <option value="paypal">Paypal</option>
                            </select>
                        </div>

                        <input type="hidden" name="payment_id" id="payment_id">

                        <div class="col-md-12 my-3">
                            <button class="btn btn-primary" type="submit">Update Payment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('flexSwitchCheckChecked');
        const label = document.getElementById('statusLabel');

        // Function to update label based on checkbox state
        function updateLabel() {
            label.textContent = checkbox.checked ? 'Status: Active' : 'Status: Inactive';
        }

        // Initial label update
        updateLabel();

        // Event listener for checkbox toggle
        checkbox.addEventListener('change', updateLabel);
    });

    $(document).ready(function() {

        $('.edit-btn').click(function(e) {
            e.preventDefault();
            let paymentId = $(this).data('id');

            $.ajax({
                type: "GET",
                url: `/Admin/Payment/${paymentId}/edit`,
                success: function(response) {
                    $('#edit_client_id').val(response.sandbox_client_id);
                    $('#edit_client_secret').val(response.sandbox_client_secret);
                    $('#edit_live_client_id').val(response.live_client_id);
                    $('#edit_live_client_secret').val(response.live_client_secret);
                    $('#edit_mode').val(response.mode);
                    $('#edit_payment_type').val(response.payment_type);
                    $('#payment_id').val(paymentId);

                    // Set checkbox based on the status (1 for checked, 0 for unchecked)
                    $('#flexSwitchCheckChecked').prop('checked', response.status == 1);

                    $('#editModal').modal('show');
                },
                error: function() {
                    alert('Error fetching payment data.');
                }
            });
        });



        $(document).on('submit', '#editPaymentForm', function(e) {
            e.preventDefault();

            let formData = $(this).serializeArray();

            // Manually set status value as 0 if the checkbox is unchecked
            if (!$('#flexSwitchCheckChecked').is(':checked')) {
                formData.push({
                    name: 'status',
                    value: 0
                });
            }

            let paymentId = $('#payment_id').val();
            $.ajax({
                type: "PUT",
                url: `/Admin/Payment/update/${paymentId}`,
                data: $.param(formData),
                success: function(response) {
                    alert('Payment updated successfully!');
                    location.reload();
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = Object.values(errors).flat();
                    alert(errorMessages.join('\n'));
                }
            });
        });


        $('.toggle-status').click(function(e) {
            e.preventDefault();
            let paymentId = $(this).data('id');
            let button = $(this);

            $.ajax({
                url: '/admin/payment/toggle-status/' + paymentId, // adjust your URL as necessary
                type: 'POST',
                success: function(response) {
                    if (response.success) {
                        alert(response.message); // Show success message
                        // Optionally, update the checkbox or UI element accordingly
                    }
                },
                error: function(xhr) {
                    alert('Error toggling payment status. Please try again.'); // Show error message
                }
            });
        });

    });
</script>

@endsection