<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Edit Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('product.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Product Name -->
                    <div class="col-md-4 mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter product name" value="{{ old('name', $product->name) }}" required>
                    </div>

                    <!-- Product Price -->
                    <div class="col-md-4 mb-3">
                        <label for="price" class="form-label">Product Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price"
                            placeholder="Enter product price" value="{{ old('price', $product->price) }}" required>
                    </div>

                    <!-- Product Image -->
                    <div class="col-md-4 mb-3">
                        <label for="product_image" class="form-label">Product Image</label>
                        <input class="form-control" name="product_image[]" type="file" multiple>
                        @if ($product->images->count())
                            <div class="mt-2">
                                <strong>Existing Images:</strong>
                                <ul>
                                    {{-- Display existing images here --}}
                                </ul>
                            </div>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="col-md-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" rows="8" class="form-control">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <!-- Product Variations -->
                    <div class="col-md-12 mb-3">
                        <label for="variations" class="form-label">Product Variations</label>
                        <div id="variation-container">
                            @if (!empty($variations) && is_array($variations))
                                @foreach ($variations as $index => $variation)
                                    <div class="row mb-2 variation-row">
                                        <div class="col-md-5">
                                            <select class="form-control variation-select" name="variations[{{ $index }}][name]" required>
                                                <option value="1 Can" {{ ($variation['name'] ?? '') == '1 Can' ? 'selected' : '' }}>1 Can</option>
                                                <option value="12 Can BOX" {{ ($variation['name'] ?? '') == '12 Can BOX' ? 'selected' : '' }}>12 Can BOX</option>
                                                <option value="32 Can BOX" {{ ($variation['name'] ?? '') == '32 Can BOX' ? 'selected' : '' }}>32 Can BOX</option>
                                                <option value="1 Pallet" {{ ($variation['name'] ?? '') == '1 Pallet' ? 'selected' : '' }}>1 Pallet</option>
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="number" step="0.01" class="form-control price-input" name="variations[{{ $index }}][price]" placeholder="Variation price (e.g., 100)" value="{{ $variation['price'] ?? '' }}" required>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger remove-variation">Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No variations available.</p>
                            @endif
                        </div>
                        {{-- <button type="button" class="btn btn-secondary" id="add-variation">Add Another Variation</button> --}}
                    </div>

                    <div class="col-md-12">
                        <label for="description" class="form-label">Status</label>
                        <select class="form-control" name="product_status" id="product_status">
                            <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $product->status) == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12 my-3">
                        <button class="btn btn-primary" type="submit">Update Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        console.log('Custom script loaded and ready.'); // Debugging

        // Add Variation Button Click Event
        $('#add-variation').on('click', function() {
            console.log('Add Variation button clicked'); // Debugging

            // Get the current number of variations to determine the index
            const variationIndex = $('#variation-container .variation-row').length;
            console.log('Current variation index:', variationIndex); // Debugging

            // Create new variation HTML
            const newVariation = `
                <div class="row mb-2 variation-row">
                    <div class="col-md-5">
                        <select class="form-control variation-select" name="variations[${variationIndex}][name]" required>
                            <option value="">Select Variation</option>
                            <option value="1 Can">1 Can</option>
                            <option value="12 Can BOX">12 Can BOX</option>
                            <option value="32 Can BOX">32 Can BOX</option>
                            <option value="1 Pallet">1 Pallet</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <input type="number" step="0.01" class="form-control price-input" name="variations[${variationIndex}][price]" placeholder="Variation price (e.g., 100)" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-variation">Remove</button>
                    </div>
                </div>`;

            // Append new variation to the container
            $('#variation-container').append(newVariation);
            console.log('New variation added:', newVariation); // Debugging
        });

        // Remove Variation Button Click Event
        $(document).on('click', '.remove-variation', function() {
            console.log('Remove Variation button clicked'); // Debugging
            $(this).closest('.variation-row').remove();
        });
    });
</script>
