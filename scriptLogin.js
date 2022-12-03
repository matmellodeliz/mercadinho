document.querySelector("#btn-login").addEventListener('click',() => {
    verificarUsuario();
})

function verificarUsuario(){
    usuario = {
        login: document.querySelector('#login').value,
        senha: document.querySelector('#senha').value
    }
    fetch('http://localhost/mercadinho/backend.php?acao=verificarUsuario', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(usuario)
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.sucesso) {

        } else {
            alert('erro de login');
        }
    });




    
}