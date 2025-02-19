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
                    <h4 class="mb-3">Roles</h4>
                </div>
            </div>
            
            <div class="table-responsive card-body">
                <table class="table table-hover table-border-bottom-1" id="Datatable">
                    <thead>
                        <tr class="bg-light custom-table">
                            <th>Sno</th>
                            <th>Roles</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Display roles with serial numbers -->
                        <tr>
                            <td>1</td>
                            <td>Super Admin</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Admin</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>User</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Journalist</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Blogger</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Social Media Influencer</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Local Writer</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Sales Professional</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Wholesaler / Wholesale Customer</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Retailer / Retail Customer</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection