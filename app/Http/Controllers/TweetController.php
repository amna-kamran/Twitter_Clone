<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TweetController extends Controller
{

public function store(Request $request)
{
    $content = $request->input('content');
    $user = $request->user();

    // Save the tweet in the database
    $tweet = Tweet::create([
        'content' => $content,
        'user_id' => $user->id,
        'created_at' => Carbon::now(),
    ]);
    // Handle the formatted time as needed (e.g., store it in the database or perform any other actions)
    // For example, if you want to store it in the tweets table, you can add a 'formatted_time' column and set its value like this:
    // $tweet->formatted_time = $formattedTime;
    // $tweet->save();
    // Pass the necessary data to the view
    return redirect()->route('tweets.show');
}


public function show()
{
    $user = auth()->user();

    // Retrieve all the tweets, ordered by the most recent
    $tweets = Tweet::latest()->get();

    // Format the time for each tweet
    $currentTime = now();
    foreach ($tweets as $tweet) {
        $tweetTime = $tweet->created_at;
        $timeDiff = $currentTime->diffInMinutes($tweetTime);

        if ($timeDiff < 60) {
            $tweet->formattedTime = $timeDiff . 'm';
        } elseif ($timeDiff < 1440) {
            $tweet->formattedTime = floor($timeDiff / 60) . 'h';
        } else {
            $tweet->formattedTime = floor($timeDiff / 1440) . 'd';
        }
    }

    if ($tweets->isEmpty()) {
        // Handle the case where no tweets are available
        $errorMessage = "No tweets found.";
        return response()->json(['errorMessage' => $errorMessage]);
    }

    // Return the tweets as a JSON response
    return response()->json(['tweets' => $tweets, 'user' => $user]);
}


function displayDashboard(){
    $user = auth()->user();

    // Retrieve all the tweets, ordered by the most recent
    $tweets = Tweet::latest()->get();

    // Format the time for each tweet
    $currentTime = now();
    foreach ($tweets as $tweet) {
        $tweetTime = $tweet->created_at;
        $timeDiff = $currentTime->diffInMinutes($tweetTime);

        if ($timeDiff < 60) {
            $tweet->formattedTime = $timeDiff . 'm';
        } elseif ($timeDiff < 1440) {
            $tweet->formattedTime = floor($timeDiff / 60) . 'h';
        } else {
            $tweet->formattedTime = floor($timeDiff / 1440) . 'd';
        }
    }

    if ($tweets->isEmpty()) {
        // Handle the case where no tweets are available
        $errorMessage = "No tweets found.";
        return view('components.tweet.twdisplay', ['errorMessage' => $errorMessage]);
    }
     return view('dashboard', ['tweets' => $tweets, 'user' => $user]);
}
function deleteTweet(){
    
}
}