const email = "info@tugimnasio.com";
const subject = "Consulta sobre membresías";
const body = "Hola, quisiera más información sobre las membresías.";

    document.getElementById('emailLink').href = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;