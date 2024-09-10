document.addEventListener('DOMContentLoaded', function() {
    var registerForms = document.getElementById('registerForm');
    if (registerForms) {
        registerForms.addEventListener('submit', function(event) {
            event.preventDefault();

            var registerUsernamev = document.getElementById('registerUsername').value.trim();
            var registerPasswordv = document.getElementById('registerPassword').value.trim();

            if (!registerUsernamev || !registerPasswordv) {
                showError('Por favor, complete todos los campos.');
                return;
            }

            if (registerPasswordv.length < 8) {
                showError('La contraseña debe tener al menos 8 caracteres.');
                return;
            }

            registerUser(registerUsernamev, registerPasswordv);
        });
    }

    function registerUser(registerUsernamev, registerPasswordv) {
        var formData = new FormData();
        formData.append('registerUsername', registerUsernamev);
        formData.append('registerPassword', registerPasswordv);

        fetch('register_process.php', { 
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            handleRegisterResponse(data);
        })
        .catch(error => {
            console.error('Error al procesar la solicitud:', error);
            showError('Error en el servidor. Inténtelo nuevamente más tarde.');
        });
    }

    function handleRegisterResponse(response) {
        if (response.status === 'success') {
            showSuccess(response.message);
            setTimeout(() => {
                window.location.href = 'index.php'; // Redirige al inicio
            }, 2000); // Espera 2 segundos antes de redirigir
        } else {
            showError(response.message);
        }
    }

    function showError(message) {
        var errorMsg = document.getElementById('errorMsg');
        errorMsg.textContent = message;
        errorMsg.style.display = 'block';
        document.getElementById('successMsg').style.display = 'none';
    }

    function showSuccess(message) {
        var successMsg = document.getElementById('successMsg');
        successMsg.innerHTML = message;
        successMsg.style.display = 'block';
        document.getElementById('errorMsg').style.display = 'none';
    }

    function clearForm() {
        document.getElementById('registerUsername').value = '';
        document.getElementById('registerPassword').value = '';
    }
});
