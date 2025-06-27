document.getElementById('btnCriarUsuario').addEventListener('click', () => {
  const email = document.getElementById('novoEmail').value;
  const password = document.getElementById('novaSenha').value;
  const nivelAcesso = document.getElementById('nivelAcesso').value;

  // Cria o usuário no Firebase
  firebase.auth().createUserWithEmailAndPassword(email, password)
    .then((userCredential) => {
      // Define claims customizados (ex: admin)
      return fetch('https://us-central1-SEU_PROJETO.cloudfunctions.net/setCustomClaims', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ 
          uid: userCredential.user.uid,
          isAdmin: (nivelAcesso === 'admin')
        })
      });
    })
    .then(() => {
      document.getElementById('statusCriacao').textContent = "Usuário criado com sucesso!";
    })
    .catch((error) => {
      document.getElementById('statusCriacao').textContent = `Erro: ${error.message}`;
    });
});