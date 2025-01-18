@extends('admin.layout.master')

@section('main_section')
    <div>
        <div class="card">
            <div class="card-header">
                <div class="d-flex ">
                    <h4 class="mb-3">News Lettes Subscription Emails</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="Datatable">
                        <thead>
                            <tr class="bg-light">
                                <th>Sno</th>
                                <th>Email</th>
                                <th>Subscription Date</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subscription as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->email }}</td>
                                    <td>{{ $s->created_at->format('M d, Y h:i A') }}</td>
                                    <td>{{ $s->firstname }}</td>
                                    <td>{{ $s->lastname }}</td>
                                    <td>{{ $s->phone_number }}</td>
                                    <td>{{ $s->address }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
