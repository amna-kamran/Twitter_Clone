
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <title>Twitter Profile</title>
</head>
<body>


  <div class="banner">
    <strong class="txt">{{ $user->name }}</strong>
  </div>

  <div class="bar">
    <div class="container">
      <ul>
        <li class="active">
          <span>Tweets</span>
          <strong></strong>
        </li>
        
        <li>
          <span>Followings</span>
          <strong>321</strong>
        </li>
        
        <li>
          <span>Followers</span>
          <strong>34</strong>
        </li>
      </ul>
  
      <div class="actions">
        <button>Follow</button>
      </div>
    </div>
  </div>

  <div class="wrapper-content">
    <div class="container">
      <aside class="profile">
        <h1>{{ $user->name }}</h1>
        <span>@ {{ $user->name }}</span>
  
        <ul class="list">
          <li>Islamabad, Pakistan</li>
          <li>Joined October 2020</li>
          <li>Born the 19th of December 1998</li>
        </ul>

      </aside>

      <section class="timeline">
        <nav>
          <a href="" class="active">Tweets</a>
        </nav>

        <ul class="tweets">
          @include('components.tweet.profile_tweet_display', ['tweets' => $tweets, 'user' => $user])

        </ul>
      </section>
    </div>
  </div>
  <script>
    // Get the actual number of tweets and update the count dynamically
    const tweetCount = {{ $tweets->count() }};
    const tweetCountElement = document.querySelector('.bar .container ul li:first-child strong');
    tweetCountElement.textContent = tweetCount;
  </script>

</body>


