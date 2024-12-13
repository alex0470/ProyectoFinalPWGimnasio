const userData = {
    name: "Juan Pérez",
    email: "juanperez@example.com",
    plan: "Premium",
    classes: [
      { name: "Yoga", schedule: "Lunes y Miércoles - 6:00 PM" },
      { name: "Spinning", schedule: "Martes y Jueves - 7:00 AM" },
      { name: "CrossFit", schedule: "Viernes - 5:00 PM" },
    ],
  };
  
  function displayUserProfile(user) {
    const profileDetails = document.getElementById("profile-details");
  
    profileDetails.innerHTML = `
      <ul>
        <li><strong>Nombre:</strong> ${user.name}</li>
        <li><strong>Correo:</strong> ${user.email}</li>
        <li><strong>Plan:</strong> ${user.plan}</li>
        <li><strong>Clases Inscritas:</strong>
          <ul>
            ${user.classes
              .map(
                (classData) =>
                  `<li><strong>${classData.name}:</strong> ${classData.schedule}</li>`
              )
              .join("")}
          </ul>
        </li>
      </ul>
    `;
  }

  document.addEventListener("DOMContentLoaded", () => {
    displayUserProfile(userData);
  });
  