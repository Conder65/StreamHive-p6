// Modal helpers (login + register)
const loginModal = document.getElementById("loginModal");
const registerModal = document.getElementById("registerModal");

const loginButton = document.getElementById("loginButton");
const registerButton = document.getElementById("registerButton");

function openModal(modal) {
  modal.style.display = "flex"; // matches the CSS centering
}

function closeModal(modal) {
  modal.style.display = "none";
}

// Open modals
loginButton.onclick = () => openModal(loginModal);
registerButton.onclick = () => openModal(registerModal);

// Close when clicking outside the modal content
window.onclick = (event) => {
  if (event.target === loginModal) closeModal(loginModal);
  if (event.target === registerModal) closeModal(registerModal);
};

