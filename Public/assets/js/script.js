const avatarButton = document.getElementById('avatar-button');
const dropdownMenu = document.getElementById('avatar-dropdown');

avatarButton.addEventListener('click', function (e) {
    e.stopPropagation();
    dropdownMenu.classList.toggle('hidden');
});

document.addEventListener('click', function () {
    if (!dropdownMenu.classList.contains('hidden')) {
        dropdownMenu.classList.add('hidden');
    }
});
