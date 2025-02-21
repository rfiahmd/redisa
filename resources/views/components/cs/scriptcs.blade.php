  <script>
    function generateRandomPassword() {
      const characters = 'abcdefghijklmnopqrstuvwxyz1234567890';
      let password = '';
      for (let i = 0; i < 8; i++) {
        password += characters.charAt(Math.floor(Math.random() * characters.length));
      }
      document.getElementById('password').value = password;
      document.getElementById('password-verifikator').value = password;
    }

    generateRandomPassword();

    function togglePasswordInput(userId) {
      let passwordInput = document.getElementById('passwordInput' + userId);
      if (passwordInput) {
        passwordInput.style.display = passwordInput.style.display === 'none' ? 'block' : 'none';
      }
    }
  </script>
