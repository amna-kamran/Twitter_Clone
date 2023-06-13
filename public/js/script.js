const wrapper = document.querySelector(".wrapper"),
    editableInput = wrapper.querySelector(".editable"),
    readonlyInput = wrapper.querySelector(".readonly"),
    placeholder = wrapper.querySelector(".placeholder"),
    counter = wrapper.querySelector(".counter"),
    button = wrapper.querySelector("button");

editableInput.onfocus = () => {
    placeholder.style.color = "#c5ccd3";
};
editableInput.onblur = () => {
    placeholder.style.color = "#98a5b1";
};

editableInput.onkeyup = (e) => {
    let element = e.target;
    validated(element);
};
editableInput.onkeypress = (e) => {
    let element = e.target;
    validated(element);
    placeholder.style.display = "none";
};

function validated(element) {
    let text;
    let maxLength = 100;
    let currentlength = element.innerText.length;

    if (currentlength <= 0) {
        placeholder.style.display = "block";
        counter.style.display = "none";
        button.classList.remove("active");
    } else {
        placeholder.style.display = "none";
        counter.style.display = "block";
        button.classList.add("active");
    }

    counter.innerText = maxLength - currentlength;

    if (currentlength > maxLength) {
        let overText = element.innerText.substr(maxLength); // extracting over texts
        overText = `<span class="highlight">${overText}</span>`; // creating new span and passing over texts
        text = element.innerText.substr(0, maxLength) + overText; // passing overText value in textTag variable
        readonlyInput.style.zIndex = "1";
        counter.style.color = "#e0245e";
        button.classList.remove("active");
    } else {
        readonlyInput.style.zIndex = "-1";
        counter.style.color = "#333";
    }
    readonlyInput.innerHTML = text; // replacing innerHTML of readonly div with textTag value
}

button.addEventListener("click", () => {
    console.log("clicked");
    // Reload the page after updating the view
    location.reload();
    const tweetContent = editableInput.innerText; // Obtain the tweet content from the editable input

    fetch("/tweets", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            content: tweetContent,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log("Request sent successfully.");

            // Check if the response contains an error message
            if (data.errorMessage) {
                console.error("Error:", data.errorMessage);
                return;
            }

            // Update the view with the received tweets
            const tweetsContainer = document.querySelector("#tweets-container");
            const tweetView = `
            @include('components.tweet.twdisplay', ['tweets' => ${JSON.stringify(
                tweets
            )}, 'user' => ${JSON.stringify(user)}])
        `;
            // Update the view here...
        });
});
