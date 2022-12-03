
document.querySelector('#btn-adicionar').addEventListener('click',() => {
    inserirCategoria();
});

lerDados();

function lerDados() {
    fetch('http://localhost/mercadinho/backend.php?acao=listarCategoria')
    .then((response) => {
        if (response.status != 200){
            throw new Error('Não autorizado');
        } else {
            return response.json();
        }
    })
    .then((data) => {
        let html = '';
        data.forEach(categoria => {
            html+= `<tr><td>${categoria.id}</td><td>${categoria.nome}</td>
            <td><button type='button' class='btn btn-danger' onclick='excluirCategoria(${categoria.id})'>excluir</button>
            <button type='button' class='btn btn-danger' onclick='editarCategoria(${categoria.id})'>editar</button></td></tr>`;
        });
        document.querySelector('#tabela > tbody').innerHTML = html;
    })
    .catch(error => {
        alert(error.message);
    });
}

function inserirCategoria() {
    let categoria = {
        nome: document.querySelector('#nome').value
    };
    
    fetch('http://localhost/mercadinho/backend.php?acao=inserirCategoria', {
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

    
    fetch('http://localhost/mercadinho/backend.php?acao=editarCategoria&id='+id, {
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
    fetch('http://localhost/mercadinho/backend.php?acao=excluirCategoria&id='+id)
    .then((response) => response.json())
    .then((data) => {
        if (data.sucesso) {
            lerDados();
        } else {
            alert('Não é possivel excluir essa categoria. Verifique se ela está vinculada a um produto.');
        }
    });

}
