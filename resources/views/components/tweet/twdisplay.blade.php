<!-- Add your CSS stylesheets and other dependencies -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="{{ asset('css/display.css') }}">

<!-- partial:index.partial.html -->
@if (isset($errorMessage))
    <p>{{ $errorMessage }}</p>
@else
    <div class="tw-block-parent">
        @foreach ($tweets as $tweet)
            <div class="timeline-TweetList-tweet">
                <div class="timeline-Tweet">
                    <div class="timeline-Tweet-brand">
                        <div class="Icon Icon--twitter"></div>
                    </div>
                    <div class="timeline-Tweet-author">
                        <div class="TweetAuthor">
                            <a class="TweetAuthor-link" href="#channel"></a>
                            <span class="TweetAuthor-avatar">
                                <div class="Avatar"></div>
                            </span>
                            <span class="TweetAuthor-name">{{ $user->name }}</span>
                            <span class="Icon Icon--verified"></span>
                            <span class="TweetAuthor-screenName">@ {{ $user->name }}</span>
                            <span><button type="submit" class="delete-tweet-button" data-tweet-id="{{ $tweet->id }}">Delete</button></span>


                        </div>
                    </div>
                    <div class="timeline-Tweet-text">{{ $tweet->content }}</div>
                    <div class="timeline-Tweet-metadata">
                        <span class="timeline-Tweet-timestamp">{{ $tweet->created_at->diffForHumans() }}</span>
                    </div>
                    <ul class="timeline-Tweet-actions">
                        <li class="timeline-Tweet-action"><a class="Icon Icon--heart" href="#"></a></li>
                        <li class="timeline-Tweet-action"><a class="Icon Icon--share" href="#"></a></li>
                    </ul>
                     <li class="timeline-Tweet-action">
                                
                        </li>
                </div>
            </div>
        @endforeach
    </div>
@endif
<!-- partial -->

<!-- Add your JavaScript code and other content -->
 <script src="{{asset('js/delete.js')}}"></script>
</body>
</html>
