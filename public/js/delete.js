const deleteButtons = document.querySelectorAll(".delete-tweet-button");
//AJAX request for deleting a tweet
function deleteTweet(tweetId) {
    fetch("/tweets/{id}", {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            tweet_id: tweetId,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                console.log("Tweet deleted successfully.");
                // Perform any necessary UI updates or actions
                location.reload();
            } else {
                console.error("Error:", data.errorMessage);
                // Handle the error case
            }
        })
        .catch((error) => {
            console.log("error");
        });
}
deleteButtons.forEach((button) => {
    button.addEventListener("click", function () {
        //we access the data-tweet-id attribute directly from the button element itself using this.dataset.tweetId.
        const tweetId = this.dataset.tweetId;
        console.log(tweetId);
        deleteTweet(tweetId);
    });
});
