<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Tweet;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    public function searchUsers(Request $request)
    {
        try {
            $searchQuery = $request->input('searchQuery');
            $users = User::where('name', 'LIKE', '%' . $searchQuery . '%')->get();
            return response()->json(['users' => $users]);
        } catch (\Exception $e) {
            // Handle the exception and return a JSON error response
            return response()->json(['error' => 'An error occurred during the search.'], 500);
        }
    }

public function displayUsers($userId)
{
    // Retrieve user information
    $user = User::findOrFail($userId);

    // Retrieve tweets for the user
    $tweets = Tweet::where('u_id', $userId)->latest()->get();

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

    // Return the tweets and user data as JSON response
    return view('dashboard2', ['user' => $user, 'tweets' => $tweets]);
}





}