document.addEventListener('DOMContentLoaded', function () {
    carregarUsuarios();
});

function carregarUsuarios() {
    fetch('../php/listar_usuarios.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('listaUsuarios');
            tbody.innerHTML = '';

            data.forEach(usuario => {
                const dataNascimento = usuario.data_nascimento ?
                    new Date(usuario.data_nascimento + 'T00:00:00').toLocaleDateString('pt-BR') : 'Não informado';

                const tipoUsuario = usuario.identificador === 'A' ? 'Administrador' : 'Usuário';

                tbody.innerHTML += `
                    <tr>
                        <td>${usuario.id}</td>
                        <td>${usuario.nome}</td>
                        <td>${usuario.email}</td>
                        <td>${dataNascimento}</td>
                        <td>${tipoUsuario}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="abrirModalEdicao(${usuario.id})">Editar</button>
                            <button class="btn btn-sm btn-danger" onclick="excluirUsuario(${usuario.id}, '${usuario.nome}')">Excluir</button>
                        </td>
                    </tr>
                `;
            });
        });
}

function abrirModalEdicao(id) {
    fetch(`../php/editar_usuario.php?id=${id}`)
        .then(response => response.json())
        .then(usuario => {
            document.getElementById('editUsuarioId').value = usuario.id;
            document.getElementById('editNome').value = usuario.nome;
            document.getElementById('editEmail').value = usuario.email;
            document.getElementById('editDataNascimento').value = usuario.data_nascimento || '';
            document.getElementById('editIdentificador').value = usuario.identificador || 'U';

            new bootstrap.Modal(document.getElementById('modalEditarUsuario')).show();
        });
}

function salvarEdicao() {
    const formData = new FormData();
    formData.append('id', document.getElementById('editUsuarioId').value);
    formData.append('nome', document.getElementById('editNome').value);
    formData.append('email', document.getElementById('editEmail').value);
    formData.append('data_nascimento', document.getElementById('editDataNascimento').value);
    formData.append('identificador', document.getElementById('editIdentificador').value);

    fetch('../php/atualizar_usuario.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('modalEditarUsuario')).hide();
                carregarUsuarios();
            }
        });
}

function excluirUsuario(id, nome) {
    if (!confirm(`Excluir o usuário "${nome}"?`)) return;

    const formData = new FormData();
    formData.append('id', id);

    fetch('../php/excluir_usuario.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) carregarUsuarios();
        });
}
