const notesInput = document.getElementById("note-text");
const userIdInput = document.getElementById("user-id");
const bookIdInput = document.getElementById("book-id");
const noteButton = document.getElementById("note");
const noteDisplay = document.getElementById("display-note");
function fetchAndDisplayNotes() {
    fetch("http://localhost/brainsterprojects_jovanmaksimoski-fs15/api.php")
        .then((response) => response.json())
        .then((data) => {
            noteDisplay.innerHTML = "";
            data.forEach((item) => {
                const div = document.createElement("div");
                div.textContent = `ID: ${item.id}, Commentary: ${item.commentary}, User ID: ${item.user_id}, Book ID: ${item.book_id}`;
                noteDisplay.appendChild(div);
            });
        })
        .catch((error) => {
            console.error("Error fetching notes:", error);
        });
}

fetchAndDisplayNotes();
noteButton.addEventListener("click", () => {
    const commentary = notesInput.value;
    const userId = userIdInput.value;
    const bookId = bookIdInput.value;

    fetch("http://localhost/brainsterprojects_jovanmaksimoski-fs15/api.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ commentary: commentary, user_id: userId, book_id: bookId }),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            alert(data.message);
            fetchAndDisplayNotes();
        })
        .catch((error) => {
            console.error("Error adding note:", error);
        });
});