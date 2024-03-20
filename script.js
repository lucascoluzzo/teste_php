requests('listarProdutos', preencherTabela);
requests('listarCategorias', preencherSelect);
var btnAddProduto = document.getElementById('btnAddProduto');
if (btnAddProduto) {
    btnAddProduto.addEventListener('click', function() {
        document.getElementById('formAddProduto').reset();
        showModal('modalAdd');
    });
}

var btnAddCategoria = document.getElementById('btnAddCategoria');
if (btnAddCategoria) {
    btnAddCategoria.addEventListener('click', function() {
        document.getElementById('formAddCategoria').reset();
        showModal('modalAddCategoria');
    });
}

var btnEdit = document.getElementById('btnEdit');
if (btnEdit) {
    btnEdit.addEventListener('click', function() {
        showModal('modalEdit');
    });
}

var btnDelete = document.getElementById('btnDelete');
if (btnDelete) {
    btnDelete.addEventListener('click', function() {
        showModal('modalDelete');
    });
}

document.getElementsByClassName('close')[0].addEventListener('click', closeModal);

window.addEventListener('click', function(event) {
    var modalAdd = document.getElementById('modalAdd');
    var modalEdit = document.getElementById('modalEdit');
    var modalDelete = document.getElementById('modalDelete');
    
    if (event.target == modalAdd || event.target == modalEdit || event.target == modalDelete) {
        closeModal();
    }
});

function showModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = 'block';
}

function closeModal() {
    var modals = document.querySelectorAll('.modal');
    modals.forEach(function(modal) {
        modal.style.display = 'none';
    });
}

function requests(funcao, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'api.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            // alert(xhr.responseText);
            var data = JSON.parse(xhr.responseText);
            callback(data);
        } else {
            console.error('Erro ao buscar categorias:', xhr.status);
        }
    };
    xhr.send(encodeURI('funcao='+funcao));
}

function preencherSelect(dados) {
    var selects = document.getElementsByClassName('categorias');
    selects = Array.from(selects);

    selects.forEach(function(select) {
        select.innerHTML = '';

        var defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = 'Selecione uma categoria';
        select.appendChild(defaultOption.cloneNode(true));

        if (Array.isArray(dados)) {
            dados.forEach(function(categoria) {
                var option = document.createElement('option');
                option.value = categoria.id;
                option.textContent = categoria.nome;
                select.appendChild(option.cloneNode(true));
            });
        } else {
            console.error('Erro: os dados recebidos não são um array.');
        }
    });
};


function preencherTabela(itens) {
    var tbody = document.querySelector('#itemTable tbody');
    tbody.innerHTML = '';

    itens.forEach(function(item) {
        var tr = document.createElement('tr');
        var tdId = document.createElement('td');
        tdId.textContent = item.id;

        var tdDescricao = document.createElement('td');
        tdDescricao.textContent = item.descricao;

        var tdPreco = document.createElement('td');
        tdPreco.textContent = item.preco;

        var tdCategoria = document.createElement('td');
        tdCategoria.textContent = item.nome;

        var tdEditar = document.createElement('td');
        var btnEditar = document.createElement('button');
        btnEditar.textContent = 'Editar';
        btnEditar.setAttribute('id', 'btnEdit');
        btnEditar.addEventListener('click', function() {
            showModal('modalEdit');
            document.getElementById('idProduto').value = item.id;
            document.getElementById('descricaoEdit').value = item.descricao;
            document.getElementById('precoEdit').value = item.preco;
            document.getElementById('categoriaEdit').value = item.id_categoria;
            console.log('Editar item:', item.id);
        });

        var tdExcluir = document.createElement('td');
        var btnExcluir = document.createElement('button');
        btnExcluir.textContent = 'Excluir';
        btnExcluir.setAttribute('id', 'btnExcluir');
        btnExcluir.addEventListener('click', function() {
            var funcao = 'apagarProduto';
            var itemId = item.id;
            var formData = new FormData();
            formData.append('funcao', funcao);
            formData.append('id', itemId);
            sendBackend(formData);
            console.log('Excluir item:', item.id);
        });

        tdEditar.appendChild(btnEditar);
        tdExcluir.appendChild(btnExcluir);

        tr.appendChild(tdId);
        tr.appendChild(tdDescricao);
        tr.appendChild(tdPreco);
        tr.appendChild(tdCategoria);
        tr.appendChild(tdEditar);
        tr.appendChild(tdExcluir);
        tbody.appendChild(tr);
    });
}

function sendBackend(dados){
    fetch('api.php', {
        method: 'POST',
        body: dados
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro ao enviar os dados para o backend');
        }
        return response.json();
    })
    .then(data => {
        console.log('Resposta do backend:', data);
    })
    .catch(error => {
        console.error('Erro:', error);
    });

    location.reload();
}

document.getElementById('formAddProduto').addEventListener('submit', function(e) {
    e.preventDefault();

    var formData = new FormData(this);

    sendBackend(formData);
});

document.getElementById('formAddCategoria').addEventListener('submit', function(e) {
    e.preventDefault();

    var formData = new FormData(this);

    sendBackend(formData);
});

document.getElementById('formEdit').addEventListener('submit', function(e) {
    e.preventDefault();

    var formData = new FormData(this);

    sendBackend(formData);
});