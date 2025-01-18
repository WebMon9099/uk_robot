<?php

namespace App\Http\Controllers\Auth;

use Str;
use Mail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ForgetPasswordController extends Controller
{
    public function forgetPasswordView()
    {
        return view('user.forgetPassword');
    }
    public function forgetPassword(Request $request)
    {
        $messages = [
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'The email address does not exist in our system.',
        ];
        // Validate the email input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
    
        if ($validator->fails()) {
            if ($validator->fails()) {
                // Return custom validation errors as JSON
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->errors()->first('email'), // Send only the first error related to the email field
                ], 422);
            }
        }
    
        // Generate a token for password reset
        $token = Str::random(64);
    
        // Store the token in the password_resets table
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
        $user = DB::table('users')->where('email', $request->email)->first();
        // Send the password reset email
        Mail::send('mail.forgetPassword', ['token' => $token,'name'=>$user->name,'email'=>$user->email], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });
    
        // Redirect back with a success message
        return response()->json(['success' => true, 'message' => 'We have e-mailed your password reset link!']);
    }
    

    public function showResetPasswordForm($token) { 
        return view('user.forgetPasswordLink', ['token' => $token]);
     }

     public function submitResetPasswordForm(Request $request)
     {
         $request->validate([
             'email' => 'required|email|exists:users',
             'password' => 'required|string|min:6|confirmed',
             'password_confirmation' => 'required'
         ]);
     
         $updatePassword = DB::table('password_resets')->where([
             'email' => $request->email,
             'token' => $request->token,
         ])->first();
     
         if (!$updatePassword) {
             return response()->json([
                'success' => false, 
                'message' => 'Invalid token!',
                'errors'=>[
                    'email' => ['Invalid token or email mismatch!']
                ]
            ], 422);
         }
     
         User::where('email', $request->email)->update([
             'password' => Hash::make($request->password)
         ]);
     
         DB::table('password_resets')->where(['email' => $request->email])->delete();
     
         return response()->json(['success' => true, 'message' => 'Your Password Has Been Changed!']);
     }
     
}
