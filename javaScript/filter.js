window.addEventListener("DOMContentLoaded", function () {

    const dropdownToggle = document.getElementById('dropdownDefault');
    const dropdownMenu = document.getElementById('dropdown');

    dropdownToggle.addEventListener('click', function () {
        dropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', function (event) {
        if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll(".category-checkbox");
    const bookCards = document.querySelectorAll(".book-card");

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", function () {
            filterBooks();
        });
    });

    function filterBooks() {
        const selectedCategories = Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);

        bookCards.forEach(card => {
            const bookCategory = card.getAttribute("data-category");
            if (selectedCategories.length === 0 || selectedCategories.includes(bookCategory)) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }

        });
    }
});


