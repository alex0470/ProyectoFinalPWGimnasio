document.addEventListener('DOMContentLoaded', () => {
    // Asignar dinámicamente el tipo de membresía desde una variable PHP
    const membershipType = '<?= $nombre_membresia ?>'; 
    const discountRates = {
        Basic: 0,
        Especial: 0.5,
        Gold: 0.7,
        Platinum: 1
    };

    console.log("Tipo de membresía:", membershipType); // Verifica el tipo de membresía

    document.querySelectorAll('.btn-inscribir').forEach(button => {
        button.addEventListener('click', () => {
            const basePrice = parseFloat(button.dataset.price); // Obtén el precio base del atributo data-price
            console.log("Precio base:", basePrice); // Verifica el precio base

            const discount = discountRates[membershipType] ?? 0; // Obtén el descuento correspondiente
            const claseId = button.getAttribute('data-id'); // Obtén el ID de la clase
            const finalPrice = basePrice * (1 - discount); // Calcula el precio final con descuento

            console.log("Clase ID:", claseId); // Verifica el ID de la clase
            console.log("Precio final:", finalPrice.toFixed(2)); // Verifica el precio final calculado

            // Verificar que el precio sea válido antes de redirigir
            if (!isNaN(finalPrice)) {
                // Redirige enviando el ID y el precio calculado en la URL
                window.location.href = `pagoclase.php?id=${claseId}&precio=${finalPrice.toFixed(2)}`;
            } else {
                alert("Ocurrió un error al calcular el precio. Por favor, inténtalo de nuevo.");
            }
        });
    });
});
