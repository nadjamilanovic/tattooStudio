window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);


function initPageScripts(page) {

    const galleryImages = document.querySelectorAll('.gallery-item img');
    if (galleryImages.length > 0) {
        let lightbox = document.getElementById('lightbox');
        if (!lightbox) {
            lightbox = document.createElement('div');
            lightbox.id = 'lightbox';
            lightbox.innerHTML = `
                <div class="lightbox-content">
                    <span class="close">&times;</span>
                    <img class="lightbox-img" src="" alt="Preview">
                </div>`;
            document.body.appendChild(lightbox);
        }

        const lightboxImg = lightbox.querySelector('.lightbox-img');
        const closeBtn = lightbox.querySelector('.close');

        galleryImages.forEach(img => {
            img.addEventListener('click', () => {
                lightbox.style.display = 'flex';
                lightboxImg.src = img.src;
            });
        });

        closeBtn.addEventListener('click', () => {
            lightbox.style.display = 'none';
        });

        lightbox.addEventListener('click', e => {
            if (e.target === lightbox) {
                lightbox.style.display = 'none';
            }
        });
    }
}

document.addEventListener("DOMContentLoaded", () => {
    loadPage('home'); 
});


    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        event.preventDefault(); 

        const form = document.getElementById('registrationForm');
        const password = document.getElementById('password').value;
        const passwordConfirm = document.getElementById('passwordConfirm').value;
        const passwordError = document.getElementById('passwordError'); 

        if (password !== passwordConfirm) {
            passwordError.style.display = 'block';
            passwordError.textContent = "Passwords do not match.";
            form.classList.add('was-validated'); 
        } else {
            passwordError.style.display = 'none'; 
            if (form.checkValidity()) {
                setTimeout(function() {
                  
                    document.getElementById('form-container').style.display = 'none';
                    document.getElementById('confirmation-message').style.display = 'block';
                }, 1000); 
            } else {
                form.classList.add('was-validated');
            }
        }
    });

    document.getElementById('password').addEventListener('input', function () {
        const password = this.value;
        const strengthIndicator = document.getElementById('passwordStrength');
        const regexWeak = /[a-z]/;
        const regexMedium = /[A-Z]/;
        const regexStrong = /[0-9]/;
        const regexVeryStrong = /[\W_]/; 

        let strength = 'Weak';

        if (regexWeak.test(password)) {
            strength = 'Weak';
        }
        if (regexMedium.test(password)) {
            strength = 'Medium';
        }
        if (regexStrong.test(password)) {
            strength = 'Strong';
        }
        if (regexVeryStrong.test(password)) {
            strength = 'Very Strong';
        }

        strengthIndicator.textContent = `Password Strength: ${strength}`;
    });

    const passwordConfirm = document.getElementById("passwordConfirm");
    passwordConfirm.addEventListener("input", function () {
        const password = document.getElementById("password").value;

        if (password !== passwordConfirm.value) {
            passwordConfirm.setCustomValidity("Passwords do not match.");
            passwordConfirm.classList.add("is-invalid");
            passwordError.textContent = "Passwords do not match.";
            passwordError.style.display = "block";
        } else {
            passwordConfirm.setCustomValidity("");
            passwordConfirm.classList.remove("is-invalid");
            passwordError.style.display = "none";
        }
    });

/*bookings */
document.addEventListener('DOMContentLoaded', () => {
    const bookingForm = document.getElementById('bookingForm');
    const confirmation = document.getElementById('confirmation-message');

    bookingForm.addEventListener('submit', function(event) {
        event.preventDefault(); // spriječi reload stranice

        if (!bookingForm.checkValidity()) {
            event.stopPropagation();
            bookingForm.classList.add('was-validated');
            return;
        }

        bookingForm.style.display = 'none';
        confirmation.style.display = 'block';
    });
});

});

