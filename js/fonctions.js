document.addEventListener('DOMContentLoaded', function() {
    
    // Affichage du loader
    function showLoader() {
        const loader = document.getElementById("loader");
        if (loader) {
            loader.style.display = "flex";  // Utiliser "flex" pour l'affichage centré
        }
    }

    function hideLoader() {
        const loader = document.getElementById("loader");
        if (loader) {
            loader.style.display = "none";  // Cacher le loader
        }
    }



// Soumission du formulaire de connexion (email)
document.getElementById("login-form")?.addEventListener("submit", function(e) {
    e.preventDefault();
    showLoader();

    const formData = new FormData(this);
    formData.append("action", "login");  // Ajouter l'action 'login'

    fetch('php/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())  // Lire la réponse en tant que texte
    .then(text => {
        console.log('Réponse brute reçue:', text);  // Log de la réponse brute pour débogage
        try {
            const data = JSON.parse(text);  // Convertir le texte en JSON
            console.log('Réponse JSON:', data);  // Log de la réponse JSON pour débogage

            hideLoader();
            if (data.success) {
                iziToast.success({
                    title: 'Succès',
                    message: data.message
                });

                // Afficher le champ OTP
                const otpField = document.getElementById("otp-field");
                if (otpField) {
                    otpField.style.display = "block"; // Afficher le champ OTP
                }

                // Afficher le bouton de soumission OTP
                const submitOtpButton = document.getElementById("submit-otp");
                if (submitOtpButton) {
                    submitOtpButton.style.display = "block"; // Afficher le bouton OTP
                }

                // Cacher le bouton "Se connecter"
                const submitLoginButton = document.getElementById("submit-login");
                if (submitLoginButton) {
                    submitLoginButton.style.display = "none"; // Cacher le bouton "Se connecter"
                }
            } else {
                iziToast.error({
                    title: 'Erreur',
                    message: data.message || 'Une erreur est survenue.'
                });
            }
        } catch (error) {
            console.error('Erreur de parsing JSON:', error);
            iziToast.error({
                title: 'Erreur',
                message: 'Réponse invalide du serveur.'
            });
        }
    })
    .catch(error => {
        hideLoader();
        console.error('Erreur AJAX:', error);  // Log de l'erreur
        iziToast.error({
            title: 'Erreur',
            message: 'Une erreur est survenue, veuillez réessayer.'
        });
    });
});







// Soumission du formulaire OTP (soumettre l'OTP)
document.getElementById("submit-otp")?.addEventListener("click", function(e) {
    e.preventDefault();
    showLoader();

    let otp = '';
    for (let i = 1; i <= 5; i++) {
        otp += document.getElementById('otp-' + i).value;
    }

    const formData = new FormData();
    formData.append("action", "verify_otp");
    formData.append("otp", otp);  // Ajouter le code OTP saisi par l'utilisateur

    fetch('php/otp.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        hideLoader();
        if (data.success) {
            iziToast.success({
                title: 'Succès',
                message: data.message
            });

            if (data.role === "abonne") {

                //redirect to home courses
                location.replace('home');

            }else{

                //redirect to home courses
                location.replace('tera.admin/add.php');

            }


        } else {
            iziToast.error({
                title: 'Erreur',
                message: data.message
            });
        }
    })
    .catch(error => {
        hideLoader();
        iziToast.error({
            title: 'Erreur',
            message: 'Une erreur est survenue, veuillez réessayer.'
        });
    });
});



    // Soumission du formulaire d'inscription
    document.getElementById("signup-form")?.addEventListener("submit", function(e) {
        e.preventDefault();
        showLoader();
        
        const formData = new FormData(this);
        formData.append("action", "register");  // Ajouter l'action 'register'
        
        fetch('php/sign.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            hideLoader();
            if (data.success) {
                iziToast.success({
                    title: 'Succès',
                    message: data.message
                });

                // Redirection vers la page OTP
                location.replace('otp.php');
            } else {
                iziToast.error({
                    title: 'Erreur',
                    message: data.message
                });
            }
        })
        .catch(error => {
            hideLoader();
            iziToast.error({
                title: 'Erreur',
                message: 'Une erreur est survenue, veuillez réessayer.'
            });
        });
    });

    // Vérification du code OTP
    document.getElementById("otp-confirmation-form")?.addEventListener("submit", function(e) {
        e.preventDefault(); // Empêcher le formulaire de se soumettre par défaut

        const otp = Array.from(document.querySelectorAll('.otp-input')).map(input => input.value).join('');
        
        if (otp.length === 5) {
            showLoader();
            
            // Créer un objet FormData à partir du formulaire
            const formData = new FormData();
            formData.append("otp", otp);  // Ajouter l'OTP
            formData.append("action", "verify_otp");  // Ajouter l'action 'verify_otp'

            // Envoyer la requête AJAX
            fetch('php/otp-sign.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                hideLoader();
                if (data.success) {
                    iziToast.success({
                        title: 'Succès',
                        message: data.message
                    });

                    //redirect to home courses
                    location.replace('home.php');

                } else {
                    iziToast.error({
                        title: 'Erreur',
                        message: data.message
                    });
                }
            })
            .catch(error => {
                hideLoader();
                iziToast.error({
                    title: 'Erreur',
                    message: 'Une erreur est survenue, veuillez réessayer!'
                });
            });
        } else {
            iziToast.error({
                title: 'Erreur',
                message: 'Le code OTP est invalide.'
            });
        }
    });

// Fonction pour renvoyer l'OTP
function resendOTP() {
    showLoader();

    // Créer un objet FormData
    const formData = new FormData();
    formData.append("action", "resend_otp");  // Ajouter l'action 'resend_otp'

    // Envoyer la requête AJAX
    fetch('php/functions.php', {
        method: 'POST',
        body: formData // Envoi des données via FormData
    })
    .then(response => response.json())
    .then(data => {
        hideLoader();
        if (data.success) {
            iziToast.success({
                title: 'Succès',
                message: data.message
            });
        } else {
            iziToast.error({
                title: 'Erreur',
                message: data.message
            });
        }
    })
    .catch(error => {
        hideLoader();
        iziToast.error({
            title: 'Erreur',
            message: 'Une erreur est survenue, veuillez réessayer.'
        });
    });
}

// Écouter le clic sur le bouton "resend-otp-btn"
document.getElementById("resend-otp-btn")?.addEventListener("click", function(e) {
    e.preventDefault();
    resendOTP();  // Appeler la fonction pour renvoyer l'OTP
});






});