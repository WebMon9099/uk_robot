<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index(){
        
        return view('admin.contact.index' , [
            'contact' => ContactUs::all()
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'sometimes',
        ]);

        try {
            ContactUs::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message
            ]);

            return back()->with('success', 'Contact form submitted successfully. Our team will contact you later via email.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Submission failed. Please try again later.');
        }
    }

}
