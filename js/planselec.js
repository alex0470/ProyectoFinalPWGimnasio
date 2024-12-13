// Asume que ya se tiene seleccionado el nombre del plan y su duración
function confirmSelection() {
    const planName = document.querySelector("#name").textContent;
    const planDuration = document.querySelector("input[name='payment-plan']:checked").value;

    document.querySelector("#selected-plan-name").value = planName;
    document.querySelector("#selected-plan-duration").value = planDuration;

    // Mostrar el formulario de pago
    document.querySelector("#payment-form").style.display = "block";
}
