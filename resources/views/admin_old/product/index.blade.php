@extends('admin.layout.master')
@section('main_section')
    <div>
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
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="Datatable">
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
                                        <button class="btn btn-outline-primary btn-sm edit-btn"
                                            data-id="{{ $product->id }}"><i class="fa fa-edit m-0"></i></button>
                                        <a href="{{ route('product.delete', ['id' => $product->id]) }}"
                                            class="btn btn-outline-danger btn-sm"><i class="fa fa-trash m-0"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
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
    </script>
@endsection
