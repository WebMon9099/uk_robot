<div class="col-md-4 col-lg-3 mb-4">
    <!-- Profile Card -->
    <div class="card border-0 shadow-sm rounded-lg mb-4">
        <div class="card-body text-center">
            @if (Auth::user()->image !='')
            <img src="{{ asset('images/profile_image/'.Auth::user()->image) }}" alt="avatar"  class="rounded-circle img-fluid" style="width:125px;height:125px">
                @else
                <img src="{{ asset('assets/images/avatar7.png') }}" alt="avatar"  class="rounded-circle img-fluid" style="width: 150px;">
            @endif
            <h4 class="font-weight-bold mb-2">{{ ucfirst(Auth::user()->name) }}</h4>
            <p class="text-muted mb-3">{{ Auth::user()->email }}</p>
            <div class="d-flex justify-content-center mb-2">
                <button data-bs-toggle="modal" data-bs-target="#profileModal" type="button" class="btn btn-primary">Change Profile Picture</button>
            </div>
        </div>
    </div>
    
    <!-- Account Navigation Card -->
    <div class="card border-0 shadow-sm rounded-lg">
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center p-3 border-bottom">
                    <a href="" class="text-dark">Account Settings</a>
                </li>
    
                <li class="list-group-item d-flex justify-content-between align-items-center p-3 border-bottom">
                    <a href="" class="text-dark">My Orders</a>
                </li>
                
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('user.logout') }}" class="text-danger">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</div>