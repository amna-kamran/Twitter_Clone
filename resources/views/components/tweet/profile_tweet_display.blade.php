<link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/profile_tweet.css') }}">

@foreach ($tweets as $tweet)
<div class="tweet-wrap">
  <div class="tweet-header">
    <div class="tweet-header-info">
      {{ $user->name }}<span>{{ $user->name }}</span><span>. Jun 27</span>
      <p>{{ $tweet->content}}</p>
    </div>
  </div>
</div>
@endforeach
