document.addEventListener('DOMContentLoaded', function() {
    var passwordVisibility = document.getElementById('passwordVisibility');
    var passwordInput = document.getElementById('yourPassword');

    if (passwordVisibility && passwordInput) {
        passwordVisibility.addEventListener('click', function(event) {
            event.preventDefault();
            if (passwordInput.getAttribute('type') === 'text') {
                passwordInput.setAttribute('type', 'password');
                passwordVisibility.classList.add('fa-eye-slash');
                passwordVisibility.classList.remove('fa-eye');
            } else if (passwordInput.getAttribute('type') === 'password') {
                passwordInput.setAttribute('type', 'text');
                passwordVisibility.classList.remove('fa-eye-slash');
                passwordVisibility.classList.add('fa-eye');
            }
        });
    } else {
        console.error("Élément non trouvé. Assurez-vous que les ID sont corrects et que le script est placé après la déclaration des éléments HTML.");
    }
});
