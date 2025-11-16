(function () {
  const toggles = document.querySelectorAll(".menu-toggle");

  function openContent(contentEl) {
    contentEl.style.display = "flex";
    const fullH = contentEl.scrollHeight;
    contentEl.style.height = fullH + "px";
    contentEl.setAttribute("aria-hidden", "false");
  }
  function closeContent(contentEl) {
    contentEl.style.height = "0px";
    const clean = () => {
      contentEl.style.display = "";
      contentEl.removeEventListener("transitionend", clean);
      contentEl.setAttribute("aria-hidden", "true");
    };
    contentEl.addEventListener("transitionend", clean);
  }

  toggles.forEach((t) => {
    const targetId = t.dataset.target;
    const content = document.getElementById(targetId);

    if (!content) return;

    t.addEventListener("click", () => {
      const expanded = t.getAttribute("aria-expanded") === "true";
      if (expanded) {
        t.setAttribute("aria-expanded", "false");
        closeContent(content);
      } else {
        t.setAttribute("aria-expanded", "true");
        openContent(content);
      }
    });

    t.addEventListener("keydown", (e) => {
      if (e.key === "Enter" || e.key === " ") {
        e.preventDefault();
        t.click();
      }
    });

    content.style.height = "0px";
    content.style.display = "";
    content.setAttribute("aria-hidden", "true");
  });

  document.addEventListener("click", (ev) => {
    const insideSidebar = ev.target.closest(".sidebar");
    if (!insideSidebar) {
      toggles.forEach((t) => {
        if (t.getAttribute("aria-expanded") === "true") {
          t.setAttribute("aria-expanded", "false");
          const content = document.getElementById(t.dataset.target);
          if (content) closeContent(content);
        }
      });
    }
  });
})();
