const events = [
  {
    title: "IT Seminar",
    date: "2025-12-05",
    description: "Learn latest trends in IT.",
    image: "image2.jpg"
  },
  {
    title: "Hackathon",
    date: "2025-12-12",
    description: "Compete in coding challenges.",
    image: "image1.jpg"
  },
  {
    title: "Alumni Meetup",
    date: "2025-12-20",
    description: "Meet past BSIT graduates.",
    image: "image.webp"
  }
];

const container = document.getElementById("events-list");

events.forEach(event => {
  const div = document.createElement("div");
  div.classList.add("card", "event-card");
  div.innerHTML = `
    <img src="${event.image}" alt="${event.title}">
    <h3>${event.title}</h3>
    <p><strong>Date:</strong> ${event.date}</p>
    <p>${event.description}</p>
  `;
  container.appendChild(div);
});