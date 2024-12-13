const btnUsuario = document.getElementById("btnUsuario");
const inscribirBtn = document.getElementById("inscribirBtn");
const registrarBtn = document.getElementById("registrarBtn");
const registf = document.getElementById("registf");
const offcanvasMenu = document.getElementById("offcanvas-menu");
const closeMenu = document.getElementById("close-menu");

  btnUsuario.addEventListener("click", () => {
    offcanvasMenu.classList.add("open");
  });

  closeMenu.addEventListener("click", () => {
    offcanvasMenu.classList.remove("open");
  });

  inscribirBtn.addEventListener("click", () => {
    window.location.href = 'crearcuenta.php';
  });

  registrarBtn.addEventListener("click", () => {
    window.location.href = 'crearcuenta.php';
  });

  registf.addEventListener("click", () => {
    window.location.href = 'crearcuenta.php';
  });