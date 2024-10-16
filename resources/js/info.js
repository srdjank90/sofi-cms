// Voice commands
document.getElementById("mic-button").addEventListener("click", function () {
    function startVoiceRecognition() {
        const recognition = new (window.SpeechRecognition ||
            window.webkitSpeechRecognition)();
        recognition.interimResults = false;
        //recognition.lang = 'sr-RS';
        recognition.lang = "en-US";

        recognition.onresult = (event) => {
            const transcript = event.results[0][0].transcript.toLowerCase();

            if (transcript.includes("info")) {
                document
                    .getElementById("info-container")
                    .classList.remove("d-none");
            } else {
                document.getElementById("code").innerHTML =
                    "That is not magic word ;)";
            }
        };

        recognition.onerror = (event) => {
            console.error("Error occurred in recognition: " + event.error);
        };

        recognition.start();
    }

    startVoiceRecognition();
});

async function fetchWeather(city) {
    const apiKey = "2f09578ccff5438b8a4145426242907";
    //const city = 'Niš';
    const url = `http://api.weatherapi.com/v1/current.json?key=${apiKey}&q=${city}`;

    window.axios
        .get(url)
        .then((response) => {
            const temperature = response.data.current.temp_c; // Current temperature in Celsius
            document.getElementById("city").innerHTML = `${city} `;
            document.getElementById(
                "temperature"
            ).innerHTML = `${temperature}°C`;
        })
        .catch((error) => {
            console.error("There was a problem with the request:", error);
        });
}

async function fetchQuote() {
    try {
        const response = await window.axios.get(
            "http://api.quotable.io/random"
        );
        const quoteText = response.data.content;
        const quoteAuthor = response.data.author;
        document.getElementById(
            "quote"
        ).innerHTML = `"${quoteText}" <br> - ${quoteAuthor}`;
    } catch (error) {
        console.error("Error fetching quote:", error);
        document.getElementById("quote").innerHTML = "Failed to fetch quote.";
    }
}

async function getCity(lat, lon) {
    const apiKey = "e6cf2c1dc81045beaac2cff39641cca1"; // Replace with your OpenCage API key
    const url = `https://api.opencagedata.com/geocode/v1/json?q=${lat}+${lon}&key=${apiKey}`;

    try {
        const response = await window.axios.get(url);
        const data = response.data;

        if (data.results.length > 0) {
            const city =
                data.results[0].components.city ||
                data.results[0].components.town ||
                data.results[0].components.village;
            const country = data.results[0].components.country; // Get country
            if (city && country) {
                return `${city}, ${country}`; // Return formatted string
            } else if (country) {
                return country; // Return only country if city is not found
            } else {
                return null; // Return null if neither is found
            }
        } else {
            return null; // Return null if no results found
        }
    } catch (error) {
        //console.error("Error fetching the city: ", error);
        return null;
    }
}

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
} else {
    alert("Geolocation is not supported by this browser.");
}

function showPosition(position) {
    const lat = position.coords.latitude;
    const lon = position.coords.longitude;

    // Call getCity and handle the returned city
    getCity(lat, lon).then((city) => {
        if (city) {
            fetchWeather(city);
        } else {
            console.log("City not found.");
        }
    });
}

function showError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            alert("User denied the request for Geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            alert("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            alert("An unknown error occurred.");
            break;
    }
}

// Fetch new quote every 30 seconds
setInterval(fetchQuote, 30000);

window.onload = function () {
    fetchQuote();
    const resources = performance.getEntriesByType("resource");
    let totalResourceTime = 0;
    resources.forEach((resource) => {
        totalResourceTime += resource.duration; // Add the duration of each resource in ms
    });
    totalResourceTime /= 1000;
    let container = document.getElementById("loading-time");
    const pageLoader = document.getElementById("page-loader");
    pageLoader.classList.remove("loader");
    container.innerHTML = `<b>${totalResourceTime.toFixed(2)} s</b>`;
};
