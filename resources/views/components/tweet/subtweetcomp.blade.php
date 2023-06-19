<div>
<div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("See whats new!") }}
                </div>

                <div class="tweet-main"> 
                    @include('components.tweet.tweet')
                </div>

            <br>
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

            <div id="tweets-container">
                @include('components.tweet.twdisplay', ['tweets' => $tweets, 'user' => $user])
</div>
</div>