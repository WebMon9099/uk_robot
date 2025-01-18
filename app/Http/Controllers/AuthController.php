<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Order;
use App\Models\PressRelease;
use App\Models\UserDetails;
use App\Models\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Mail\AdminUserRegisteredNotification;

class AuthController extends Controller
{
   public function register()
   {
       $userCategory=UserCategory::get();
       $data['userCategory']=$userCategory;
       return view('user.register',$data);
       
   }

   public function userLogin()
   {
     return view('user.login');
   }
   public function registerUser(Request $request)
   {

       $rules = [
           'name' => 'required|string',
           'email' => 'required|email',
           'phoneNumber' => 'required|string',
           'selectedRole' => 'required|integer',
           'password' => 'required|string',
       ];

       // Perform validation
       $validator = Validator::make($request->all(), $rules);

        // If validation fails, return a JSON response
       if ($validator->fails()) {
           return response()->json([
               'error' => 'Validation failed',
               'messages' => $validator->errors(),
           ], 422); // 422 Unprocessable Entity
       }

       // Save the user data
       $user = User::create([
           'name' => $request->input('name'),
           'email' => $request->input('email'),
           'phone' => $request->input('phoneNumber'),
           'user_type' => $request->input('selectedRole'),
           'password' => bcrypt($request->input('password')),
           'status' => '0', // Default status to 0
       ]);
       $adminEmail = 'test@gmail.com'; // Replace with your admin email
       Mail::to($adminEmail)->send(new AdminUserRegisteredNotification($user));
  
       return redirect()->route('user.login');
   }
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('admin.auth.login');
    }

    public function submitLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();
        $remember = $request->has('remember'); // Check if "Remember Me" is checked
        if (!$user) {
            // If the user does not exist, return an error
            return response()->json(['errors' => ['email' => 'This email address is not registered.']], 404);
        }
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            // Check if the user is restricted by status field (assuming 'status' = 0 means restricted)
            if ($user->status == 0) {
                Auth::logout();
                return response()->json(['error' => 'Your account is not activated. Please check your email to activate your account or contact support.'], 403);
            }
            if (session()->has('cart')) {
                $cart = session()->get('cart');
                foreach ($cart as $cartItem) {
                    $existingCartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $cartItem['product_id'])
                        ->where('can_type', $cartItem['can_type'])
                        ->first();

                    if ($existingCartItem) {
                        $newQuantity = $existingCartItem->quantity + $cartItem['quantity'];

                        if ($newQuantity > 5) {
                            $newQuantity = 5;
                        }
                        $existingCartItem->update([
                            'quantity' => $newQuantity,
                            'price' => $cartItem['price'],
                            'total_price' => $cartItem['total_price'],
                        ]);
                    } else {
                        Cart::create([
                            'user_id' => $user->id,
                            'product_id' => $cartItem['product_id'],
                            'quantity' => $cartItem['quantity'],
                            'price' => $cartItem['price'],
                            'total_price' => $cartItem['total_price'],
                            'can_type' => $cartItem['can_type']
                        ]);
                    }
                }
                session()->forget('cart');

            }
            if ($user->user_type == 1) {
                // If user type is 1, redirect to admin dashboard
                return response()->json(['success' => 'Admin logged in successfully.', 'redirect' => route('dashboard')]);
            } elseif ($user->user_type == 2) {
                // If user type is 2, redirect to user dashboard
                return response()->json(['success' => 'User logged in successfully.', 'redirect' => route('product')]);

            } elseif ($user->user_type == 3 || $user->user_type == 4 || $user->user_type == 5 || $user->user_type == 6 || $user->user_type==7 ) {
                // If user type is 1, redirect to admin dashboard
                return response()->json(['success' => 'Logged in successfully.', 'redirect' => route('dashboard')]);
            }else {
                // If user type is neither 1 nor 2, logout and return error
                Auth::logout();
                return response()->json(['error' => 'Unauthorized access.'], 403);
            }
        } else {
            return response()->json(['errors' => ['password' => 'Invalid credentials']], 401);
            
        }
    }


    public function dashboard()
    {
        $totalUsers = User::count(); // Total users
        $totalProducts = Product::count(); // Total products
        $totalBlogs = Blog::count(); // Total blogs
        // $totalImages = BlogImage::count(); // Total blog images
        $totalOrders = Order::count(); // Total orders
        $totalPressPr = PressRelease::count(); 

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalProducts' => $totalProducts,
            'totalBlogs' => $totalBlogs,
            // 'totalImages' => $totalImages,
            'totalOrders' => $totalOrders, // Pass total orders to the view
            // 'blogs' => $blogs, // Pass blogs with images to the view
            // 'blogImagePaths' => $blogImagePaths, // Pass blog image paths to the view
            'totalPressPr' => $totalPressPr,
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'user logout successfully');
    }

    public function userlogout()
    {
        Auth::logout();
        return redirect()->route('user.login')
        ->with('success','Logout Successfully');
    }
    public function profile()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $userDetails=UserDetails::where('user_id',Auth::user()->id)->first();
        // Check if the user type is 2 (User)
        if (Auth::user()->user_type == 2) {
            return view('user.profile', ['user' => $user,'userDetails'=>$userDetails]);
        }

        // For other user types (e.g., admin), return the admin profile view
        return view('admin.User.profile', ['user' => $user, 'userDetails' => $userDetails]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        // Validate incoming request data
        $validatore = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|regex:/^[0-9\-\+\(\)\/\s]*$/',
            'address' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            
        ]);
        
        if ($validatore->passes()) {            
            $user->update(
                ['name' => $request->name, 
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            $user->details()->updateOrCreate([
                'user_id' => $user->id
            ], $request->only(['address', 'postcode', 'state', 'country']));
            session()->flash('success', 'Profile Updated Sucessfully');

            return response()->json([
                'status' => true,
                'message' => 'Profile Updated Sucessfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'error' => $validatore->errors()
            ]);

        }

    }
    //Multistage form

    public function showRegistrationForm()
    {
        return view('user.multiStepRegistration');
    }
    public function sendPasscode(Request $request)
    {
        // Validate email input
        $request->validate([
            'email' => 'required|email', // or 'phone' => 'required'
        ]);

        // Check if the user already exists
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // If the user exists, return an error message
            return response()->json([
                'status' => 'error',
                'message' => 'User already exists. Please log in or use another email.',
            ], 400); // 400 Bad Request
        }
        // Generate a random 6-digit passcode
        $passcode = rand(100000, 999999);

        // Store the passcode in session or database (for verification later)
        session(['email_passcode' => $passcode]);

        // Send the email with the passcode
        Mail::send('mail.passcode', ['passcode' => $passcode], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Your Verification Passcode');
        });

        return response()->json(['message' => 'Passcode sent successfully!']);
    }

    public function verifyPasscode(Request $request)
    {
        $request->validate([
            'passcode' => 'required|numeric'
        ]);

        // Check if the passcode matches
        if ($request->passcode == session('email_passcode')) {
            return response()->json(['message' => 'Passcode verified successfully!']);
        }

        return response()->json(['message' => 'Invalid passcode'], 400);
    }

    public function submitForm(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'orderType' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'phoneNumber' => 'required|string',
            'units' => 'required|integer',
            'password' => 'required|string',
        ]);

        // Check if the user already exists (by email)
        $existingUser = User::where('email', $request->input('email'))->first();

        if ($existingUser) {
            // Handle the case where the email already exists
            return redirect()->back()->with('error', 'Email already exists. Please verify your email.');
        }

        // Save the user data
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phoneNumber'),
            'units' => $request->input('units'),
            'order_type' => $request->input('orderType'),
            'password' => bcrypt($request->input('password')),
        ]);
        //dd($user);

        // Redirect to a thank you page or another appropriate page
        return redirect()->route('user.login');
    }

    public function updateProfileImage(Request $request)
    {
        //dd($request->all());
        $userId = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'image' => 'required|image',
        ]);

        if ($validator->passes()) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = $userId . '-' . time() . '.' . $ext;
            $image->move(public_path('/images/profile_image/'), $imageName);

            //resize image
            $sourcePath = public_path('/images/profile_image/' . $imageName);
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($sourcePath);
            $image->cover('80', '80');
            $image->toPng()->save(public_path('/images/profile_image/thumb/' . $imageName));
            User::where('id', $userId)->update(['image' => $imageName]);

            //delete old file
            File::delete(public_path('/images/profile_image/' . Auth::user()->image));
            File::delete(public_path('/images/profile_image/thumb/' . Auth::user()->image));


            session()->flash('success', 'Profile Picture Updated Sucessfully');
            return response()->json([
                'status' => true,
                'message' => 'Profile Picture Updated Sucessfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ]);
        }
    }

     // check old password 
     public function checkOldPassword(Request $request)
     {
         $user = auth()->user();
         if (Hash::check($request->input('old_password'), $user->password)) {
             return response()->json(['status' => 'success']);
         } else {
             return response()->json(['status' => 'error', 'message' => 'Your old password is incorrect']);
         }
     }
 
     // update password
     public function updatePassword(Request $request)
     {
         $validator = Validator::make($request->all(),[
             'old_password' => 'required',
             'new_password' => 'required|min:8',
             'confirm_password' => 'required|same:new_password',
         ]);
 
         if ($validator->fails()){
             return response()->json([
                 'status' => false,
                 'errors' => $validator->errors(),
             ]);
         }
         if(Hash::check($request->old_password, Auth::user()->password) == false ){
             
             return response()->json([
                 'status' => false,
                 'errors' => ['old_password' => 'Your old password is incorrect.']
             ]);
         }
         
         $user = User::find(Auth::user()->id);
         $user->password = Hash::make($request->new_password);
         $user->save();
 
        
         return response()->json([
             'status' => true,
             'message' => 'Password updated successfully.'
         ]);
     }
}
