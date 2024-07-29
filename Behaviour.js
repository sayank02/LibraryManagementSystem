document.addEventListener("DOMContentLoaded", async () => {
  const sidebar = document.getElementById("sidebar");
    const menuBtn = document.getElementById("menu-btn");
  
    menuBtn.addEventListener("click", () => {
      sidebar.classList.toggle("hidden");
    });
  // Initial render
  const initialRoute = window.location.hash.replace("#", "") || "Dashboard";
  await render(initialRoute);

  // Handle browser back/forward navigation
  window.onpopstate = async function () {
    const route = window.location.hash.replace("#", "");
    await render(route);
  };
});

async function navigateTo(route) {
  window.history.pushState({}, route, `#${route}`);
  await render(route);
}

async function render(route) {
  const appDiv = document.getElementById("Main-content");
  try {
    const response = await fetch(`${route}.html`);
    if (response.ok) {
      const content = await response.text();
      appDiv.innerHTML = content;
    } else {
      appDiv.innerHTML = "<h1>Coming SOON</h1>";
    }
  } catch (error) {
    appDiv.innerHTML = "<h1>Error loading content</h1>";
  }
}
