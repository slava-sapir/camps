document.addEventListener("DOMContentLoaded", function () {
  const presentations = document.querySelectorAll(".presentation");

  presentations.forEach(function (presentation) {
    presentation.addEventListener("click", function () {
      presentations.forEach(function (p) {
        const clickEvent = p.querySelector(".click-event");
        const hoverEvent = p.querySelector(".hover-event");

        if (clickEvent && hoverEvent) {
          clickEvent.classList.remove("d-flex");
          clickEvent.classList.add("d-none");
          hoverEvent.classList.remove("d-none");
          hoverEvent.classList.add("d-flex");
        }
      });

      const clickEvent = presentation.querySelector(".click-event");
      const hoverEvent = presentation.querySelector(".hover-event");

      if (clickEvent && hoverEvent) {
        clickEvent.classList.remove("d-none");
        clickEvent.classList.add("d-flex");
        hoverEvent.classList.remove("d-flex");
        hoverEvent.classList.add("d-none");
      }
    });
  });
});

// document.addEventListener("DOMContentLoaded", function () {
//   const tabLinks = document.querySelectorAll(
//     '#nav-tab a[data-bs-toggle="tab"]'
//   );

//   tabLinks.forEach(function (tabLink) {
//     tabLink.addEventListener("click", function (event) {
//       event.preventDefault();

//       tabLinks.forEach((link) => {
//         link.classList.remove("active");
//         const paneId = link.getAttribute("data-bs-target");
//         document.querySelector(paneId).classList.remove("show", "active");
//         document.querySelector(paneId).classList.add("d-none");
//       });

//       tabLink.classList.add("active");
//       const paneId = tabLink.getAttribute("data-bs-target");
//       document.querySelector(paneId).classList.add("show", "active");
//       document.querySelector(paneId).classList.remove("d-none");
//     });
//   });
// });
