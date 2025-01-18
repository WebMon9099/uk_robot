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
                <h4 class="mb-3">Users</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="Datatable">
                    <thead>
                        <tr class="bg-light">
                            <th>Sno</th>
                            <th>Order Number</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Payment Mode</th>
                            <th>Date Purchased</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->orderNumber }}</td>
                            <td>{{ $order->users ? $order->users->email : 'N/A' }}</td>

                            <td>{{ $order->users->phone }}</td>
                            <td>
                                @if($order->status == 'pending')
                                <span class="badge bg-danger">Pending</span>
                                @elseif($order->status == 'shipped')
                                <span class="badge bg-info">Shipped</span>
                                @else
                                <span class="badge bg-success">Delivered</span>
                                @endif
                            </td>
                            <td>${{ number_format($order->grand_total,2) }}</td>
                            <td>{{ ucfirst($order->payment_method)}}</td>
                            <td>{{ \Carbon\Carbon::parse($order->create_at)->format('d M, Y') }}</td>
                            <td>
                                <a href="{{ route('order.order-detail' ,['id' => $order->id] ) }}" class="btn btn-outline-primary btn-sm edit-user-btn"
                                    data-id="{{ $order->id }}"><i class="fa fa-edit m-0"></i></a>
                                <a href="{{ route('user.destroy', ['id' => $order->id]) }}"
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


@endsection