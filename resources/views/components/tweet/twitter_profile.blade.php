
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
          <strong id="followings"></strong>
        </li>
        
        <li>
          <span>Followers</span>
          <strong>34</strong>
        </li>
      </ul>
  
      <div class="actions">
        <button class="follow" data-user-id="{{ $user->id }}">Follow</button>
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

    //code to follow a user on clicking the following button
const followButton = document.querySelector('.follow');
  // Get the user ID of the profile being visited (replace with your actual code)
  const profileUserId = followButton.dataset.userId;
// Add click event listener to the follow button
followButton.addEventListener('click', function() {
  console.log("clicked");

  // AJAX request to storeFollowings function
  fetch(`/followings`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
       'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({ user_id: profileUserId })
  })
    .then(response => {
    })
    .catch(error => {
      // Handle network or fetch error
      console.error('Error:', error);
    });
});

//to get following count
function sendRequestForCount() {
// AJAX request to getFollowingsCount function
fetch('/get-followings-count', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
  },
  body: JSON.stringify({ user_id: profileUserId })
})
  .then(response => response.json())
  .then(data => {
    console.log("Followings count:", data.followings_count);
    // Update the following element with the returned count
    const followingsCount = data.followings_count;
    const followingsElement = document.getElementById('followings');
   
    if (followingsElement) {
      followingsElement.innerHTML = followingsCount.toString();
    }else followingsElement.innerHTML = 0;
  })
  .catch(error => {
    // Handle network or fetch error
    console.error('Error:', error);
  });
}
sendRequestForCount();

  </script>

</body>


