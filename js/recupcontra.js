document.getElementById('resetForm').addEventListener('submit', async (e) => { 
    e.preventDefault();

    const email = document.getElementById('correo').value; // Cambiar a "correo"
    const message = document.getElementById('message');

    try {
        const response = await fetch('recuperar.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `correo=${encodeURIComponent(email)}` // Corregido: el parámetro enviado coincide con PHP
        });

        const result = await response.text();
        message.textContent = result;
    } catch (error) {
        message.textContent = 'Hubo un error. Inténtalo de nuevo.';
    }
});
