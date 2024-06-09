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


