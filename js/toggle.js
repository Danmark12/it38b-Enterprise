document.addEventListener("DOMContentLoaded", function () {
    const menuBtn = document.getElementById("menu-toggle");
    const sidebar = document.getElementById("sidebar");
  
    menuBtn.addEventListener("click", () => {
      sidebar.classList.toggle("hide");
    });
  });
  