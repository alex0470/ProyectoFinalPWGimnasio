function seleccionarPlan(name, price) {
    const url = `detallesPlan.php?membership=${name}&price=${price}`;
    window.location.href = url;
}