document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".tab-button");
  const contents = document.querySelectorAll(".tab-content");

  // Initialize first tab
  const firstTab = document.querySelector(".tab-button");
  if (firstTab && !document.querySelector(".tab-button.active")) {
    firstTab.classList.add("active");
    document.querySelector(`#${firstTab.dataset.tab}`)?.classList.add("active");
  }

  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      const tabId = button.dataset.tab;

      // Update buttons
      buttons.forEach((btn) => {
        btn.classList.remove("active");
        btn.setAttribute("aria-selected", "false");
      });
      button.classList.add("active");
      button.setAttribute("aria-selected", "true");

      // Update content
      contents.forEach((content) => {
        content.classList.remove("active");
        content.setAttribute("aria-hidden", "true");
      });
      const activeContent = document.getElementById(tabId);
      if (activeContent) {
        activeContent.classList.add("active");
        activeContent.setAttribute("aria-hidden", "false");
      }

      // Focus management for accessibility
      button.focus({ preventScroll: true });
    });

    // Keyboard navigation
    button.addEventListener("keydown", (e) => {
      if (e.key === "Enter" || e.key === " ") {
        e.preventDefault();
        button.click();
      }
    });
  });
});
