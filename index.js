// Smooth scroll to features (home page only if button exists)
const btn = document.querySelector(".btn");
if (btn) {
  btn.addEventListener("click", function(e) {
    e.preventDefault();
    const featuresSection = document.querySelector(".features");
    if (featuresSection) {
      featuresSection.scrollIntoView({ behavior: "smooth" });
    }
  });
}

// Highlight active nav link
document.querySelectorAll("nav a").forEach(link => {
  if (link.href === window.location.href) {
    link.classList.add("active");
  }
});

// Auto-generate homepage cards (if section exists)
const grid = document.querySelector(".grid");
if (grid) {
  const features = [
    {title: "Quality Education", description: "Industry-ready curriculum and hands-on learning."},
    {title: "Active Community", description: "BSIT events, competitions, and student organizations."},
    {title: "Professional Training", description: "Workshops, certifications, and career guidance."}
  ];

  features.forEach(item => {
    const div = document.createElement("div");
    div.classList.add("card");
    div.innerHTML = `<h3>${item.title}</h3><p>${item.description}</p>`;
    grid.appendChild(div);
  });
}


// ---------------- PAGE TRANSITION EFFECT ----------------

// Fade-IN on page load
document.addEventListener("DOMContentLoaded", () => {
  document.body.classList.add("page-loaded");
});

// Fade-OUT when clicking nav links
document.querySelectorAll('a').forEach(link => {
  link.addEventListener('click', function(e) {
    if (this.target === "_blank" || this.href.includes("#")) return;

    e.preventDefault();
    const goTo = this.href;

    document.body.classList.remove("page-loaded");
    document.body.classList.add("page-transition");

    setTimeout(() => {
      window.location.href = goTo;
    }, 500);
  });
});

