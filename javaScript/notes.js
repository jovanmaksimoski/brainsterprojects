
$(document).ready(function() {
    function fetchAndDisplayNotes() {
        $.ajax({
            url: "http://localhost/brainsterprojects_jovanmaksimoski-fs15/api.php",
            type: "GET",
            dataType: "json",
            success: function(data) {
                $("#note-list").empty();
                data.forEach(function(note) {
                    const noteElement = $("<div>").addClass("note").attr("data-note-id", note.id);
                    noteElement.append($("<p>").text(note.commentary));


                    const editButton = $("<button>").text("Edit").addClass("edit-note bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-3 mr-2");
                    const deleteButton = $("<button>").text("Delete").addClass("delete-note bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-3");
                    noteElement.append(editButton).append(deleteButton);

                    $("#note-list").append(noteElement);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error fetching notes:", errorThrown);
            }
        });
    }

    fetchAndDisplayNotes();


    $("#add-note").click(function() {
        const commentary = $("#note-text").val();

        $.ajax({
            url: "http://localhost/brainsterprojects_jovanmaksimoski-fs15/api.php",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify({ commentary: commentary }),
            dataType: "json",
            success: function(data) {
                console.log(data);
                alert(data.message);
                fetchAndDisplayNotes();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error adding note:", errorThrown);
            }
        });
    });


    $("#note-list").on("click", ".edit-note", function() {
        const noteId = $(this).closest(".note").attr("data-note-id");
        const newCommentary = prompt("Enter new commentary:");

        if (newCommentary !== null) {
            $.ajax({
                url: `http://localhost/brainsterprojects_jovanmaksimoski-fs15/api.php?id=${noteId}`,
                type: "PUT",
                contentType: "application/json",
                data: JSON.stringify({ commentary: newCommentary }),
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    alert(data.message);
                    fetchAndDisplayNotes();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error editing note:", errorThrown);
                }
            });
        }
    });

    $("#note-list").on("click", ".delete-note", function() {
        const noteId = $(this).closest(".note").attr("data-note-id");

        $.ajax({
            url: `http://localhost/brainsterprojects_jovanmaksimoski-fs15/api.php?id=${noteId}`,
            type: "DELETE",
            success: function(data) {
                console.log(data);
                alert(data.message);
                fetchAndDisplayNotes();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error deleting note:", errorThrown);
            }
        });
    });
});
