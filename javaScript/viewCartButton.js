document.addEventListener('DOMContentLoaded', function () {
    const addCommentBtns = document.querySelectorAll('.add-comment-btn');
    const addNoteBtns = document.querySelectorAll('.add-note-btn');
    const commentForms = document.querySelectorAll('.comment-form');
    const noteForms = document.querySelectorAll('.note-form');

    addCommentBtns.forEach((btn, index) => {
        btn.addEventListener('click', function (event) {
            event.preventDefault();
            commentForms[index].classList.toggle('hidden');
        });
    });

    addNoteBtns.forEach((btn, index) => {
        btn.addEventListener('click', function (event) {
            event.preventDefault();
            noteForms[index].classList.toggle('hidden');
        });
    });
});