document.addEventListener("DOMContentLoaded", function () {
    fetchQuote();

    function fetchQuote() {
        fetch('https://api.quotable.io/random')
            .then(response => response.json())
            .then(data => {
                document.getElementById('quote').textContent = data.content + " - " + data.author;
            })
            .catch(error => console.error('Error fetching quote:', error));
    }

    document.querySelector('footer').addEventListener('click', fetchQuote);
});