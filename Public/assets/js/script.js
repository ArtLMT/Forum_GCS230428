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

function togglePassword() {
    const input = document.getElementById("password");
    const showIcon = document.getElementById("toggleIconShow");
    const hideIcon = document.getElementById("toggleIconHide");

    if (input.type === "password") {
        input.type = "text";
        showIcon.classList.add("hidden");
        hideIcon.classList.remove("hidden");
    } else {
        input.type = "password";
        hideIcon.classList.add("hidden");
        showIcon.classList.remove("hidden");
    }
}