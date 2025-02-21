<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Get the authenticated user's user_type
        $currentUserType = auth()->user()->user_type;

        // Define the array of user types based on currentUserType
        $userTypes = $currentUserType == 1 ? [2, 3, 4, 5, 6, 7, 8, 9] : [1, 2, 3, 4, 5, 6, 7, 8, 9]; // Include all types for other user types

        // Fetch users based on the dynamic user type filter
        $user = User::whereIn('user_type', $userTypes)->latest();
        if(!empty($request->get('keyword')))
        {
            $user=User::where('name','like','%'.$request->get('keyword').'%');
        }
        $user=$user->get();
        return view('admin.User.list',compact('user'));
    }
    public function store(Request $request)
    {
        // dd($request);
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ]);
        }
        //dd($request);
        // Create the new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'postcode' => $request->postcode,
            'state' => $request->state,
            'country' => $request->country,
            'user_type' => $request->user_role, 
            'status' => $request->user_status, 
        ]);

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully.',
            'user' => $user,
        ]);
    }


    public function edit(Request $request)
    {
        try{
            $user=User::with('details')->find($request->id);
            //dd($user);
            return view('admin.partials.modal.edit-user',['user'=>$user]);
        }catch(\Exception $e) {
            return response("error: {$e->getMessage()}", 500);
            
        }
    }

    public function update(Request $request, $id)
    {
      
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'address' => 'nullable|string',
            'postcode' => 'nullable|string',
            'state' => 'nullable|string',
            'country' => 'nullable|string',
            'user_status' => 'nullable|in:0,1',
            'user_role' => 'required|in:1,2,3,4,5,6,7,8,9' 
        ]);
       
    
        try {
            //dd($request->all());
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => $request->user_status,
                'user_type' => $request->user_role  
            ]);
           
            // Update or create User Details
            $user->details()->updateOrCreate(
                ['user_id' => $user->id], 
                [ 
                    'address' => $request->address,
                    'postcode' => $request->postcode,
                    'state' => $request->state,
                    'country' => $request->country,
                ]
            );
    
            return back()->with('success', 'User Updated Successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'User Update Failed: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            // Find the user by ID and delete
            $user = User::findOrFail($id);
            
            // Optionally, delete user details if they exist
            $user->details()->delete();
            
            $user->delete(); // Delete the user

            return back()->with('success', 'User Deleted Successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'User Deletion Failed: ' . $e->getMessage());
        }
    }

    public function roles(Request $request)
    {
        // Get the authenticated user's user_type
        $currentUserType = auth()->user()->user_type;

        // Define the array of user types based on currentUserType 
        $userTypes = $currentUserType == 1 ? [2, 3, 4, 5, 6, 7, 8, 9] : [1, 2, 3, 4, 5, 6, 7, 8, 9]; // Include all types for other user types

        // Fetch users based on the dynamic user type filter
        $users = User::whereIn('user_type', $userTypes)->latest();
        if(!empty($request->get('keyword')))
        {
            $users=User::where('name','like','%'.$request->get('keyword').'%');
        }
        $users=$users->get();
        return view('admin.User.user-role',compact('users'));
    }

    
}
