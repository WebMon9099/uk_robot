@extends('admin.layout.master')
@section('main_section')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="d-flex ">
                    <h4 class="mb-3">Submited Contact Us Form</h4>
                </div>
            </div>
           
                <div class="table-responsive text-nowrap card-body">
                    <table class="table table-hover table-border-bottom-0" id="Datatable">
                        <thead>
                            <tr class="bg-light">
                                <th>Sno</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>submited date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contact as $c)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $c->name }}</td>
                                    <td>{{ $c->email }}</td>
                                    <td><strong>{{ $c->phone }}</strong></td>
                                    <td>{{ $c->subject }}</td>
                                    <td>{{ $c->message }}</td>
                                    <td>{{ $c->created_at->format('M d, Y h:i A') }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
          
        </div>
    </div>
@endsection
