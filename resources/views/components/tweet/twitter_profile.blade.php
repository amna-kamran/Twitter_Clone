
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
        <li class="active" id="tweetButton">
          <span>Tweets</span>
          <strong></strong>
        </li>
        
        <li id="followings_container" onclick = showFollowings>
          <span>Followings</span>
          <strong id="followings"></strong>
        </li>
        
        <li id="followers_container">
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
        <div id="following-user" style="display: none;">Hi</div>
        <div id="replacementDiv" style="display: none;">Hi</div>
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
    const followButton = document.querySelector('.follow');
    const profileUserId = followButton.dataset.userId;
    const followingsElement = document.getElementById('followings');
    const containers = document.querySelectorAll('li');
    const followingsContainer = document.getElementById('followings_container');
    const followersContainer = document.getElementById('followers_container');
    const tweetButton = document.getElementById('tweetButton');
    const tweets = document.querySelector('.tweets');
    const replacementDiv = document.getElementById('replacementDiv');

    tweetCountElement.textContent = tweetCount;
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

//displaying the user the logged in user is following
function activeContainer(){
    // Make the current container active
   const container = event.currentTarget;
  container.classList.add('active');
  
  // Remove active class from the rest of the containers
  containers.forEach(containerItem => {
    if (containerItem !== container) {
      containerItem.classList.remove('active');
    }
  });

}
function showFollowings() {
activeContainer();
  // Send AJAX request to display following users
  fetch('/get-followings', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
       'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
  body: JSON.stringify({ user_id: profileUserId })
  })
    .then(response => response.json())
    .then(data => {
  const followingUsersDiv = document.getElementById('following-users');

  // Clear any existing content
  // followingUsersDiv.innerHTML = '';
  console.log(data.followings)
  // Iterate over the following user array and create HTML elements);
})
.catch(error => {
  // Handle errors
  console.error('Error:', error);
});
}

// Attach click event listener to the "Followings" element

followingsContainer.addEventListener('click', showFollowings);
followersContainer.addEventListener('click', activeContainer);
tweetButton.addEventListener('click', activeContainer);
</script>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
  // Hide the ul with class "tweets" and show the replacement div initially

  // Function to perform some action on container click
  function activeContainer() {
    // Add your code to make the container active
    console.log("Container clicked");
  }

  // On clicking the "Tweet" button, call the toggleTweets function and activeContainer function
  tweetButton.addEventListener('click', function(e) {
    activeContainer();
    console.log("Tweet button clicked");
          tweets.style.display = 'block';
      replacementDiv.style.display = 'none';
  });
    followingsContainer.addEventListener('click', function(e) {
    activeContainer();
    console.log("Tweet button clicked");
          tweets.style.display = 'none';
      replacementDiv.style.display = 'block';
  });
});

    </script>

</body>


