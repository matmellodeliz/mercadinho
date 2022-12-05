
document.querySelector('#btn-adicionar').addEventListener('click',() => {
    inserirCategoria();
});

lerDados();


function lerDados() {
    fetch('http://localhost/mercadinho/backend.php?acao=listar')
    .then((response) => response.json())
    .then((data) => {
        let html = '';
        data.forEach(categoria => {
            html+= `<tr><td>${categoria.id}</td><td>${categoria.nome}</td>
            <td><button type='button' class='btn btn-danger' onclick='excluirCategoria(${categoria.id})'>excluir</button>
            <button type='button' class='btn btn-danger' onclick='editarCategoria(${categoria.id})'>editar</button></td></tr>`;
        });
        document.querySelector('#tabela > tbody').innerHTML = html;
    });
}

function inserirCategoria() {
    let categoria = {
        nome: document.querySelector('#nome').value
    };
    
    fetch('http://localhost/mercadinho/backend.php?acao=inserir', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(categoria)
    })
    .then((response) => response.json())
    .then((resultado) => {
        if (resultado.sucesso) {
            lerDados();
        } else {
            alert('impossivel inserir');
        }
    });

}

function editarCategoria(id) {
    let categoria = {
        nome: document.querySelector('#nome').value
    };

    
    fetch('http://localhost/mercadinho/backend.php?acao=editar&id='+id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(categoria)
    })
    .then((response) => response.json())
    .then((resultado) => {
        if (resultado.sucesso) {
            lerDados();
        } else {
            alert('impossivel editar');
        }
    });

}


function excluirCategoria(id) {
    fetch('http://localhost/mercadinho/backend.php?acao=excluir&id='+id)
    .then((response) => response.json())
    .then((data) => {
        if (data.sucesso) {
            lerDados();
        } else {
            alert('deu ruim');
        }
    });

}
