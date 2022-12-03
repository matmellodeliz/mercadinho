
document.querySelector('#btn-adicionar').addEventListener('click',() => {
    inserirProduto();
});

lerDados();
lerCategoria();


function lerDados() {
    fetch('http://localhost/mercadinho/backend.php?acao=listarProdutos')
    .then((response) => response.json())
    
    .then((data) => {
        let html = '';
        data.forEach(produto => {
            html+= `<tr><td>${produto.id}</td><td>${produto.nome}</td><td>${produto.preco}</td><td>${produto.nome_categoria}</td>
            <td><button type='button' class='btn btn-danger' onclick='excluirProduto(${produto.id})'>excluir</button>
            <button type='button' class='btn btn-danger' onclick='editarProduto(${produto.id})'>editar</button></td></tr>`;
        });
        document.querySelector('#tabela > tbody').innerHTML = html;
    });
}

function lerCategoria() {
    fetch('http://localhost/mercadinho/backend.php?acao=listarCategoria')
    .then((response) => response.json())
    .then((data) => {
        let html = '';
        data.forEach(categoria => {
            html+= `<option value='${categoria.id}'>${categoria.nome}</option>`;
        });
        document.querySelector('#categoria').innerHTML = html;
    });
}


function inserirProduto() {
    let produto = {
        nome: document.querySelector('#nome').value,
        preco: document.querySelector('#preco').value,
        categoria: document.querySelector('#categoria').value
    };
    
    fetch('http://localhost/mercadinho/backend.php?acao=inserirProduto', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(produto)
    })
    .then((response) => response.json())
    .then((resultado) => {
        if (resultado.sucesso) {
            lerDados();
            lerCategoria();
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


function excluirProduto(id) {
    fetch('http://localhost/mercadinho/backend.php?acao=excluirProduto&id='+id)
    .then((response) => response.json())
    .then((data) => {
        if (data.sucesso) {
            lerDados();

        } else {
            alert('impossivel excluir');
        }
    });

}
function editarProduto(id) {
    let produto = {
        nome: document.querySelector('#nome').value,
        preco: document.querySelector('#preco').value,
        categoria: document.querySelector('#categoria').value
    };

    
    fetch('http://localhost/mercadinho/backend.php?acao=editarProduto&id='+id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(produto)
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

