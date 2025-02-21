<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdvocateambassadorController extends Controller
{
    public function index()
    {
        return view('user.advocateambassadorSignup');
    }

    public function submitForm(Request $request)
    {
        // dd($request->all());

        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'phoneNumber' => 'required|string',
            'selectedRole' => 'required|integer',
            'password' => 'required|string',
            'jobTitle' => 'required|string',
            'workExp' => 'required|integer|min:0',
            'industry' => 'required|string',
            'currentlyWork' => 'required|string',
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
         
        
         // Prepare the additional data for the 'data' column
        $formData = [
            'jobTitle' => $request->input('jobTitle'),
            'workExp' => $request->input('workExp'),
            'industry' => $request->input('industry'),
            'currentlyWork' => $request->input('currentlyWork'),
        ];
        $verificationToken = Str::random(32);
        // Save the user data
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phoneNumber'),
            'user_type' => $request->input('selectedRole'),
            'password' => bcrypt($request->input('password')),
            'status' => '0', // Default status to 0
            'data' => json_encode($formData),
            'verification_token' => Str::random(64),
        ]);

        //Send Email
        Mail::to($user->email)->send(new VerificationMail($user));
        
        // Redirect to a thank you page or another appropriate page
        return redirect()->route('user.login');
    }

    public function verifyEmail($token)
    {
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid verification token.'], 404);
        }

        $user->update([
            'status' => '1', 
            'verification_token' => null, 
        ]);

        return redirect()->route('user.login')->with('success', 'Your email has been verified. You can now log in.');
    }
}
