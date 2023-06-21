<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Following;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FollowingsController extends Controller
{

public function storeFollowings(Request $request)
{
    $userId = $request->input('user_id');
    // Get the currently logged in user
    $user = Auth::user();

    // Check if the relationship already exists
    if ($user->following()->where('following_id', $userId)->exists()) {
        // Relationship already exists, return a response indicating the error
        return response()->json(['message' => 'Already following this user']);
    }

    // Store the following relationship in the database
    Following::create([
        'user_id' => $user->id,
        'following_id' => $userId,
        'created_at' => Carbon::now(),
    ]);

    // Get the updated count of followings for the user
    $followingsCount = $user->following()->count();

    // Return a response with the followings count
    return response()->json(['message' => 'Following user successfully', 'followings_count' => $followingsCount]);
}

 public function getFollowingsCount(Request $request)
    {
        // Retrieve the user ID from the request body
        $userId = $request->input('user_id');
        
        // Retrieve the followings count for the specified user ID
        $followingsCount = Following::where('user_id', $userId)->count();
        
        // Return the followings count as JSON response
        return response()->json(['followings_count' => $followingsCount]);
    }

public function getFollowings(Request $request)
{
    // Retrieve the user ID from the request body
    $userId = $request->input('user_id');
    
    // Retrieve the following users' IDs
    $followings = Following::where('user_id', $userId)->get();
    $followingIds = $followings->pluck('following_id');

    // Retrieve the user data for the following user IDs
    $users = User::whereIn('id', $followingIds)->get();

    // Prepare the result array with followings and corresponding users
    $result = [
        'followings' => $followings,
        'users' => $users,
    ];

    // Return the result array as JSON response
    return response()->json($result);
}


}
