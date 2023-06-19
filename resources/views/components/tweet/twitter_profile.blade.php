
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <title>Twitter Profile</title>
</head>
<body>


  <div class="banner">
    <h1>Twitter do Gabriel de Jesus</h1>
  </div>

  <div class="bar">
    <div class="container">
      <ul>
        <li class="active">
          <span>Tweets</span>
          <strong>345</strong>
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
        <h1>Amna Kamran</h1>
        <span>@amnakamran</span>
  
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


</body>


