<?php

namespace App\Http\Controllers;

use App\Models\EmailVarificationCode;
use App\Models\NewsLetter;
use App\Models\SaveNumberCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Twilio\Rest\Client;




class NewsLetterController extends Controller
{
    public function index()
    {
        $subscription = NewsLetter::whereNotNull('firstname')
            ->whereNotNull('lastname')
            ->whereNotNull('email')
            ->whereNotNull('phone_number')
            ->whereNotNull('address')
            ->get();

        return view('admin.newsletter.index', [
            'subscription' => $subscription
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:news_letters,email'
        ]);

        try {
            NewsLetter::create([
                'email' => $request->email
            ]);

            return back()->with('success', 'Newsletter subscription successful');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', 'Failed to subscribe to newsletter');
        }
    }

    public function sendVarificationMail(Request $request)
    {
        DB::beginTransaction();
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:news_letters,email'
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => 'Email Already Registered'], 422);
            }

            $data = NewsLetter::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
            ]);

            $code = $this->generateUniqueCode(6);
            EmailVarificationCode::create([
                'code' => $code,
                'news_letter_id' => $data->id
            ]);

            $email = $request->email;
            Mail::send('mail.send-verify-mail', [
                'title' => 'Verify Email',
                'emailMessage' => 'Click the button below to verify yourself',
                'url' => URL::route('news.letter', ['code' => $code]),
            ], function ($message) use ($email) {
                $message->to($email)->subject('Verify Email');
            });
            DB::commit();
            return response('Mail sent successfully. Please verify your email.', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return response('Failed to send mail. Please try again later.', 500);
        }
    }


    private function generateUniqueCode($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        do {
            $code = '';
            for ($i = 0; $i < $length; $i++) {
                $code .= $characters[rand(0, strlen($characters) - 1)];
            }
        } while (EmailVarificationCode::where('code', $code)->exists());
        return $code;
    }
    public function getNewsLetter($code = null)
    {
        $status = "success";
        $message = "";
        $data = null;

        if ($code) {
            $getemailuser = EmailVarificationCode::where('code', $code)->first();
            if (!$getemailuser) {
                abort(403);
                $status = "error";
                $message = "Newsletter not found";
            } else {
                $data = NewsLetter::find($getemailuser->news_letter_id);
            }
        }
        return view('news-letter', compact('data', 'status', 'message'));
    }


    public function sendPasscode(Request $request)
    {
        $receiverNumber = $request->phonenumber;
        $message = mt_rand(100000, 999999);
        $twilioSid = 'AC58fd4397791ee11610fef43433ed4a3a';
        $twilioToken = '9130eadb29cef6488c6d6f18c2188272';

        try {
            // $twilio = new Client($twilioSid, $twilioToken);
            // $twilio->messages->create(
            //     $receiverNumber,
            //     [
            //         'from' => '+13346038847',
            //         'body' => "Your passcode is: $message"
            //     ]
            // );
            SaveNumberCode::create([
                'code' => $message,
                'news_letter_id' => $request->id
            ]);
            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function checkPasscode(Request $request)
    {
        try {
            $data = SaveNumberCode::OrderByDesc('id')->where('news_letter_id', $request->id)->first();
            $check = $data->code == $request->passcode;
            if ($check) {
                return response()->json(['status' => true], 200);
            } else {
                return response()->json(['status' => false], 200);
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
    }

   public function sendAddress(Request $request)
{
    try {
        NewsLetter::where('id', $request->id)->update([
            'email' => $request->email,
            'phone_number' => $request->phonenumber,
            'address' => $request->address
        ]);
        
        $updatedData = NewsLetter::find($request->id);
 
        $email = $updatedData->email;
        $subject = 'Welcome to ROBOT Kombucha!';
        Mail::send('mail.after', [
            'title' => $subject,
            'updatedData' => $updatedData
        ], function ($message) use ($email, $subject) {
            $message->to($email)->subject($subject);
        });

        $notificationContent = "A new user has signed up to receive a newsletter. The person's details are as follows: Name: {$updatedData->firstname} {$updatedData->lastname}, Address: {$updatedData->address}, Email: {$updatedData->email}. Signed up on " . now()->format('l jS F, \a\t g:ia');
        $notificationSubject = 'New Newsletter Subscription';
        Mail::raw($notificationContent, function ($message) use ($notificationSubject) {
            $message->to('info@robotkombucha.co.uk')->subject($notificationSubject);
        });
        
        return response()->json(['status' => true], 200);
    } catch (\Exception $e) {
        dd($e->getMessage());
        return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
    }
}
  
    public function deleteExtraRecord()
    {
        NewsLetter::whereNull('phone_number')->whereNull('Address')->delete();
        return response('record Deleted');
    }
}
