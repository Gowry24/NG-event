document.addEventListener('DOMContentLoaded', () => {
    const loginBtn = document.getElementById('loginBtn');
  
    
    loginBtn.addEventListener('click', () => {
      alert('Login button clicked! Redirecting to the login page...');

      window.location.href = 'login.html'; 
    });
  });
  