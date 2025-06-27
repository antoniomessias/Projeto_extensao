document.getElementById('loginBtn').addEventListener('click', () => {
  const email = document.getElementById('emailLogin').value;
  const password = document.getElementById('passwordLogin').value;

  firebase.auth().signInWithEmailAndPassword(email, password)
    .then(() => {
      // Verifica se o usuário é admin (opcional)
      firebase.auth().currentUser.getIdTokenResult()
        .then((idTokenResult) => {
          if (idTokenResult.claims.admin) {
            window.location.href = "admin/dashboard.php";
          } else {
            window.location.href = "home.php";
          }
        });
    })
    .catch((error) => {
      document.getElementById('errorLogin').textContent = error.message;
    });
});