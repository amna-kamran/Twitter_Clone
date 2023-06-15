const searchBar = document.getElementById("searchBar");
const searchResultsContainer = document.getElementById(
    "searchResultsContainer"
);

// Function to handle the AJAX request for searching users
function searchUsers(searchQuery) {
    fetch("/search", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({ searchQuery }),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log("here");
            // Clear previous search results
            searchResultsContainer.innerHTML = "";

            if (data.users.length > 0) {
                // Create an unordered list for the search results
                const resultList = document.createElement("ul");
                resultList.classList.add("search-results");

                // Iterate over the search results and create list items
                data.users.forEach((user) => {
                    const listItem = document.createElement("li");
                    listItem.classList.add("search-result");

                    // Create the name element
                    const name = document.createElement("span");
                    name.textContent = user.name;
                    name.classList.add("name");
                    listItem.appendChild(name);

                    // Create the username element
                    const username = document.createElement("span");
                    username.textContent = "@" + user.name;
                    username.classList.add("username");
                    listItem.appendChild(username);

                    // Add click event listener to each list item
                    listItem.addEventListener("click", function () {
                        // Call a function to display the user's profile and tweets
                        displayUserProfile(user.id);
                    });

                    // Append the list item to the result list
                    resultList.appendChild(listItem);
                });

                // Append the result list to the search results container
                searchResultsContainer.appendChild(resultList);
            } else {
                // Handle case when no search results are found
                searchResultsContainer.textContent = "No results found";
            }
        })
        .catch((error) => {
            console.log("Error:", error);
        });
}

// Function to handle the input event on the search bar
// Function to handle the input event on the search bar
function handleSearchInput() {
    const searchQuery = searchBar.value.trim();

    // Clear previous search results if search query is empty
    if (searchQuery === "") {
        searchResultsContainer.innerHTML = "";
        return;
    }

    searchUsers(searchQuery);
}

// Attach the event listener to the search bar input event
searchBar.addEventListener("input", handleSearchInput);
