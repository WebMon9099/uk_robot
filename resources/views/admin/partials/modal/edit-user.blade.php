<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
               

                <div class="mb-3">
                    <label for="name" class="form-label">User Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">User Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" required readonly>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">User Contact</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" >
                </div>

                <!-- User Details (always show these fields) -->
                <div class="row">
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" >{{ old('address', $user->details->address ?? '') }}</textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="postcode" class="form-label">Postcode</label>
                        <input type="text" class="form-control" id="postcode" name="postcode" value="{{ old('postcode', $user->details->postcode ?? '') }}" >
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" id="state" name="state" value="{{ old('state', $user->details->state ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $user->details->country ?? '') }}" >
                    </div>
                </div>

                <!-- User Status -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="user_status" class="form-label">User Status</label>
                        <select name="user_status" id="user_status" class="form-control">
                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="user_role" class="form-label">User Role</label>
                    <select name="user_role" id="user_role" class="form-control">
                        @if (Auth::user()->user_type == 0) <!-- Check if logged-in user is Super Admin -->
                            <option value="1" {{ $user->user_type == 1 ? 'selected' : '' }}>Admin</option>
                        @endif
                        <option value="2" {{ $user->user_type == 2 ? 'selected' : '' }}>User</option>
                        <option value="3" {{ $user->user_type == 3 ? 'selected' : '' }}>Journalist</option>
                        <option value="4" {{ $user->user_type == 4 ? 'selected' : '' }}>Blogger</option>
                        <option value="5" {{ $user->user_type == 5 ? 'selected' : '' }}>Social Media Influencer</option>
                        <option value="6" {{ $user->user_type == 6 ? 'selected' : '' }}>Local Writer</option>
                        <option value="7" {{ $user->user_type == 7 ? 'selected' : '' }}>Sales Professional</option>
                        <option value="8" {{ $user->user_type == 8 ? 'selected' : '' }}>Wholesaler / Wholesale Customer</option>
                        <option value="9" {{ $user->user_type == 9 ? 'selected' : '' }}>Retailer / Retail Customer</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
        </div>
    </div>
</div>
