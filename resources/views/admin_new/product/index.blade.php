@extends('admin.layout.master')
@section('main_section')
    <div class="container-p-y">
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
                    <h4 class="mb-3">Products</h4>
                    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#myModal">
                        <i class="fa fa-plus-circle me-2"></i>
                        Add Product</button>
                </div>
            </div>
          
                <div class="table-responsive card-body">
                    <table class="table table-hover table-border-bottom-0" id="Datatable">
                        <thead>
                            <tr class="bg-light">
                                <th>Sno</th>
                                <th>Product Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        @foreach ($product->images as $p)
                                            <img src="{{ asset($p->image_path) }}" alt=""
                                                class="img-fluid avatar-sm rounded">
                                        @endforeach
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ Str::words($product->description, 4) }}..</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <button class="btn rounded-pill btn-primary btn-sm edit-user-btn edit-btn me-2" 
                                                data-id="{{ $product->id }}">
                                                <i class="fa fa-edit m-0"></i>
                                            </button>
                                            <a href="{{ route('product.delete', ['id' => $product->id]) }}" 
                                                class="btn rounded-pill btn-danger btn-sm">
                                                <i class="fa fa-trash m-0"></i>
                                            </a>
                                        </div>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            
        </div>
    </div>
    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter product name" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="product_price" class="form-label">Product Price</label>
                                <input type="number" class="form-control" id="price" name="price"
                                    placeholder="Enter product price" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="branch_id" class="form-label">Product Image</label>
                                <input class="form-control" name="product_image[]" type="file" multiple>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="stock_alert" class="form-label">Description</label>
                                <textarea name="description" id="" rows="8" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="variations" class="form-label">Product Variations</label>
                                <div id="variation-container">
                                    <div class="row mb-2 variation-row">
                                        <div class="col-md-6">
                                            <select class="form-control variation-select" name="variations[0][name]"
                                                required>
                                                <option value="">Select Variation</option>
                                                <option value="8 can pallet">8 can pallet</option>
                                                <option value="16 can pallet">16 can pallet</option>
                                                <option value="24 can pallet">24 can pallet</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control price-input"
                                                name="variations[0][price]" placeholder="Variation price (e.g., 100)"
                                                required>
                                            <p id="error-message" style="color: red; display: none;"></p>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary" id="add-variation">Add Another
                                    Variation</button>
                            </div>



                            <div class="col-md-12 my-3">
                                <button class="btn btn-primary" type="submit">Add Product</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">

    </div>
    <script>
        $(document).ready(function() {
            $('.edit-btn').click(function(e) {
                e.preventDefault();
                let Product_ID = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "{{ route('product.edit') }}",
                    data: {
                        id: Product_ID
                    },
                    success: function(response) {
                        $('#editModal').empty();
                        $('#editModal').html(response).modal('show');
                    }
                });
            });
        });
        let variationIndex = 1;

        // Function to disable selected options
        function disableSelectedOptions() {
            const selectedValues = [];

            // Collect all selected values
            $('.variation-select').each(function() {
                const value = $(this).val();
                if (value) {
                    selectedValues.push(value);
                }
            });

            // Loop through all selects and disable already selected options
            $('.variation-select').each(function() {
                const currentSelect = $(this);

                currentSelect.find('option').each(function() {
                    if (selectedValues.includes($(this).val()) && $(this).val() !== currentSelect.val()) {
                        $(this).prop('disabled', true); // Disable the selected option in other selects
                    } else {
                        $(this).prop('disabled', false); // Enable it if not selected
                    }
                });
            });
        }

        // Add variation functionality
        $('#add-variation').click(function() {
            const lastPrice = $('.price-input').last().val();

            // Error message handling
            let errorMessage = $('#error-message');
            if (!lastPrice || lastPrice <= 0) {
                errorMessage.text("Please enter a valid price before adding a new variation.");
                errorMessage.show();
                return;
            }

            // If price is valid, hide error message
            errorMessage.hide();

            // Create new variation row
            let newVariation = `
        <div class="row mb-2 variation-row">
            <div class="col-md-6">
                <select class="form-control variation-select" name="variations[${variationIndex}][name]" required>
                    <option value="">Select Variation</option>
                    <option value="8 can pallet">8 can pallet</option>
                    <option value="16 can pallet">16 can pallet</option>
                    <option value="24 can pallet">24 can pallet</option>
                </select>
            </div>
            <div class="col-md-6">
                <input type="number" class="form-control price-input" name="variations[${variationIndex}][price]" placeholder="Variation price (e.g., 150)" required>
            </div>
        </div>`;

            $('#variation-container').append(newVariation);
            variationIndex++;

            // Disable already selected options in all dropdowns
            disableSelectedOptions();
        });

        // Listen to change event on all selects to disable selected options when a selection changes
        $(document).on('change', '.variation-select', function() {
            disableSelectedOptions();
        });
    </script>
@endsection
