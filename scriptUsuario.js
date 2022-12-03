
document.querySelector('#btn-adicionar').addEventListener('click',() => {
    inserirUsuario();
});

listarUsuarios();


function listarUsuarios() {
    fetch('http://localhost/mercadinho/backend.php?acao=listarUsuarios')
    .then((response) => response.json())
    .then((data) => {
        let html = '';
        data.forEach(usuario => {
            html+= `<tr>
            <td>${usuario.id}</td>
            <td>${usuario.nome}</td>
            <td>${usuario.funcao}</td>
            <td>${usuario.login}</td>
            <td>${usuario.senha}</td>
            <td><button type='button' class='btn btn-danger' onclick='editarUsuario(${usuario.id})'>Editar</button>
            <button type='button' class='btn btn-danger' onclick='excluirUsuario(${usuario.id})'>Excluir</button></td>
        </tr>`;
        });
        document.querySelector('#tabela > tbody').innerHTML = html;
    });
}


function inserirUsuario() {
    let usuario = {
        nome: document.querySelector('#nome').value,
        funcao: document.querySelector('#funcao').value,
        login: document.querySelector('#login').value,
        senha: document.querySelector('#senha').value
    };
    console.log(usuario);
    fetch('http://localhost/mercadinho/backend.php?acao=inserirUsuario', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(usuario)
    })
    .then((response) => response.json())
    .then((resultado) => {
        if (resultado.sucesso) {
            listarUsuarios();
        } else {
            alert('impossivel inserir');
        }
    });

}

function editarUsuario(id) {
    let usuario = {
        nome: document.querySelector('#nome').value,
        funcao: document.querySelector('#funcao').value,
        login: document.querySelector('#login').value,
        senha: document.querySelector('#senha').value
    };

    
    fetch('http://localhost/mercadinho/backend.php?acao=editarUsuario&id='+id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(usuario)
    })
    .then((response) => response.json())
    .then((resultado) => {
        if (resultado.sucesso) {
            listarUsuarios();
        } else {
            alert('impossivel editar');
        }
    });

}

function excluirUsuario(id) {
    fetch('http://localhost/mercadinho/backend.php?acao=excluirUsuario&id='+id)
    .then((response) => response.json())
    .then((data) => {
        if (data.sucesso) {
            listarUsuarios();
        } else {
            alert('impossivel excluir');
        }
    });

}

