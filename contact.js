const form = document.getElementById('contactForm');
const thankYouMsg = document.getElementById('thankYou');

form.addEventListener('submit', function(e) {
  e.preventDefault(); 

  const name = document.getElementById('name').value;
  const email = document.getElementById('email').value;
  const message = document.getElementById('message').value;

  thankYouMsg.textContent = `Thank you, ${name}! Your message has been sent.`;
  thankYouMsg.style.display = 'block';

  form.reset();
});
