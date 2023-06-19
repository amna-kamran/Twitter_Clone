<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="content-wrapper" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @include('components.tweet.twitter_profile', ['tweets' => $tweets, 'user' => $user])
            </div>
        </div>
    </div>
</x-app-layout>

