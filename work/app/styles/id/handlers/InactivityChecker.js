
const inactivityTimeout = 900000;

const resetInactivityTimer = () => {
  clearTimeout(window.inactivityTimer);
  window.inactivityTimer = setTimeout(logoutUser, inactivityTimeout);
};

const logoutUser = () => {
  window.location.href = '/index.php';
};

const updateSessionActivity = () => {
  fetch('/controllers/updateSessionActivity.php', {
    method: 'POST',
    credentials: 'include',
  });
};

['mousemove', 'keydown'].forEach(eventType => {
  document.addEventListener(eventType, () => {
    resetInactivityTimer();
    updateSessionActivity();
  });
});

resetInactivityTimer();