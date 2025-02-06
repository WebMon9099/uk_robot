<?php

namespace App\Http\Controllers;

use App\Models\AdminNews;
use App\Models\NewsLetter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class AdminNewsController extends Controller
{
    //
    public function index()
    {
        $news = AdminNews::all();

        return view('admin.monthlyNews.index', compact('news'));
    }

    public function store(Request $request)
    {

        // Manually validate using Validator::make
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'publish_date' => 'required|date',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(), // Return the first validation error
            ], 422); // Unprocessable Entity status code
        }

        try {

            /* $publish_date = $request->input('publish_date');
            return response()->json([
                'success' => true,
                'data' => $publish_date,
            ], 200); */

            // Create a new record using validated data
            $news = AdminNews::create([
                'title' => $request->input('title'),
                'sub_title' => $request->input('sub_title'),
                'description' => $request->input('description'),
                'publish_date' => $request->input('publish_date'),
            ]);

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'News added successfully!',
                'data' => $news,
            ], 200);

        } catch (\Exception $e) {
            // Log the exception for debugging
            \Log::error('Error while adding news: ' . $e->getMessage());

            // Return an error response
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
            ], 500); // Internal Server Error
        }
    }

    public function update(Request $request, $id)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'publish_date' => 'required|date',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }
    
    //dd($request->all());
        try {
            // Find the news item by ID
            $news = AdminNews::findOrFail($id);
    
            // Update the news item
            $news->update([
                'title' => $request->input('title'),
                'sub_title' => $request->input('sub_title'),
                'description' => $request->input('description'),
                'publish_date' => $request->input('publish_date'),
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'News updated successfully!',
                'data' => $news,
            ], 200);
    
        } catch (\Exception $e) {
            \Log::error('Error while updating news: ' . $e->getMessage());
    
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
    }

    public function destroy($id){
        try{
            $news = AdminNews::findOrFail($id);
            $news->delete();

            return response()->json([
                'success' => true,
                'message' => 'News deleted successfully!'
            ]);

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the News. Please try again.'
            ],500);
        }
    }


    public function sendNewsletterEmail(Request $request)
    {
        $news = AdminNews::find($request->news_id);

        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        $subscribers = Newsletter::pluck('email')->toArray();

        // Remove HTML tags from description
        $plainDescription = strip_tags($news->description);

        foreach ($subscribers as $email) {
            Mail::raw("Latest News: {$news->title}\n\n{$plainDescription}", function ($message) use ($email) {
                $message->to($email)
                        ->subject('Newsletter Update');
            });
        }

        return response()->json(['message' => 'Emails sent successfully!']);
    }
    public function sendTodayNewsletter()
    {
        $today = now()->toDateString(); // Get today's date (YYYY-MM-DD)

        // Fetch today's news that hasn't been sent
        $newsItems = AdminNews::whereDate('publish_date', $today)
                              ->whereNotIn('id', Cache::get('sent_news_ids', [])) // Fetch only unsent news
                              ->get();

        if ($newsItems->isEmpty()) {
            return response()->json(['message' => 'No newsletters to send today'], 200);
        }

        $subscribers = Newsletter::pluck('email')->toArray();

        if (empty($subscribers)) {
            return response()->json(['message' => 'No subscribers found'], 200);
        }

        $sentNewsIds = Cache::get('sent_news_ids', []);

        foreach ($newsItems as $news) {
            $plainDescription = strip_tags($news->description);
            $newsUrl = url("/news/{$news->id}"); // Generate URL for the news

            foreach ($subscribers as $email) {
                Mail::raw("Latest News: {$news->title}\n\n{$plainDescription}\n\nRead more: {$newsUrl}", function ($message) use ($email) {
                    $message->to($email)
                            ->subject('Newsletter Update');
                });
            }

            // Store sent news ID in cache to prevent duplicate sending
            $sentNewsIds[] = $news->id;
        }

        // Update cache with the new sent news IDs (valid for 1 day)
        Cache::put('sent_news_ids', $sentNewsIds, now()->endOfDay());

        return response()->json(['message' => 'Emails sent successfully!'], 200);
    }

}
