const urlParams = new URLSearchParams(window.location.search);
const membershipName = urlParams.get('membership');
const membershipPrice = parseFloat(urlParams.get('price'));

    document.getElementById('name').textContent = membershipName;
    document.getElementById('price').textContent = membershipPrice;

    const planOptions = document.querySelectorAll('input[name="payment-plan"]');
        planOptions.forEach(option => {
            option.addEventListener('change', () => {
                const multiplier = parseFloat(option.dataset.multiplier);
                const newPrice = (membershipPrice * multiplier).toFixed(2);
                document.getElementById('price').textContent = newPrice;
            });
        });

    function confirmSelection() {
        alert(`Has seleccionado la membresía ${membershipName} con un precio final de $${document.getElementById('price').textContent}`);
    }
planOptions.forEach(option => {
    option.addEventListener('change', () => {
        const selectedTime = option.value;
        document.getElementById('interval').value = selectedTime;
    });
});

const fechaVencimientoInput = document.getElementById('fecha_vencimiento');
const nombrePlanInput = document.getElementById('nombre_plan');

planOptions.forEach(option => {
    option.addEventListener('change', () => {
        const multiplier = parseFloat(option.dataset.multiplier);
        const selectedTime = option.value;

        // Cálculo de la fecha de vencimiento
        const today = new Date();
        const newDate = new Date(today);

        switch (selectedTime) {
            case 'day':
                newDate.setDate(today.getDate() + 1);
                break;
            case 'week':
                newDate.setDate(today.getDate() + 7);
                break;
            case 'biweekly':
                newDate.setDate(today.getDate() + 14);
                break;
            case 'month':
                newDate.setMonth(today.getMonth() + 1);
                break;
            case '2months':
                newDate.setMonth(today.getMonth() + 2);
                break;
            case 'halfyear':
                newDate.setMonth(today.getMonth() + 6);
                break;
            case 'year':
                newDate.setFullYear(today.getFullYear() + 1);
                break;
        }

        const formattedDate = newDate.toISOString().split('T')[0];
        fechaVencimientoInput.value = formattedDate;
        document.getElementById('price').textContent = (membershipPrice * multiplier).toFixed(2);
    });
});

// Actualiza el campo del nombre del plan
nombrePlanInput.value = membershipName;
