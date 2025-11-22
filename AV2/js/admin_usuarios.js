document.addEventListener('DOMContentLoaded', function () {
    carregarUsuarios();
});

function carregarUsuarios() {
    fetch('../php/listar_usuarios.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('listaUsuarios');
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center">Nenhum usuário cadastrado</td></tr>';
                return;
            }

            data.forEach(usuario => {
                const tr = document.createElement('tr');

                const dataNascimento = usuario.data_nascimento ?
                    new Date(usuario.data_nascimento + 'T00:00:00').toLocaleDateString('pt-BR') :
                    'Não informado';

                const tipoUsuario = usuario.identificador === 'A' ? 'Administrador' : 'Usuário';

                tr.innerHTML = `
                    <td>${usuario.id}</td>
                    <td>${usuario.nome}</td>
                    <td>${usuario.email}</td>
                    <td>${dataNascimento}</td>
                    <td>${tipoUsuario}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="abrirModalEdicao(${usuario.id})">
                            Editar
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="excluirUsuario(${usuario.id}, '${usuario.nome}')">
                            Excluir
                        </button>
                    </td>
                `;

                tbody.appendChild(tr);
            });
        })
        .catch(error => {
            console.error('Erro ao carregar usuários:', error);
            alert('Erro ao carregar a lista de usuários');
        });
}

function abrirModalEdicao(id) {
    fetch(`../php/editar_usuario.php?id=${id}`)
        .then(response => response.json())
        .then(usuario => {
            if (usuario.error) {
                alert(usuario.error);
                return;
            }

            document.getElementById('editUsuarioId').value = usuario.id;
            document.getElementById('editNome').value = usuario.nome;
            document.getElementById('editEmail').value = usuario.email;
            document.getElementById('editDataNascimento').value = usuario.data_nascimento || '';
            document.getElementById('editIdentificador').value = usuario.identificador || 'U';

            const modal = new bootstrap.Modal(document.getElementById('modalEditarUsuario'));
            modal.show();
        })
        .catch(error => {
            console.error('Erro ao carregar dados do usuário:', error);
            alert('Erro ao carregar dados do usuário');
        });
}

function salvarEdicao() {
    const id = document.getElementById('editUsuarioId').value;
    const nome = document.getElementById('editNome').value;
    const email = document.getElementById('editEmail').value;
    const dataNascimento = document.getElementById('editDataNascimento').value;
    const identificador = document.getElementById('editIdentificador').value;

    if (!nome || !email) {
        alert('Nome e e-mail são obrigatórios');
        return;
    }

    const formData = new FormData();
    formData.append('id', id);
    formData.append('nome', nome);
    formData.append('email', email);
    formData.append('data_nascimento', dataNascimento);
    formData.append('identificador', identificador);

    fetch('../php/atualizar_usuario.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);

                const modal = bootstrap.Modal.getInstance(document.getElementById('modalEditarUsuario'));
                modal.hide();

                carregarUsuarios();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Erro ao atualizar usuário:', error);
            alert('Erro ao atualizar usuário');
        });
}

function excluirUsuario(id, nome) {
    if (!confirm(`Tem certeza que deseja excluir o usuário "${nome}"?\n\nEsta ação não pode ser desfeita.`)) {
        return;
    }

    const formData = new FormData();
    formData.append('id', id);

    fetch('../php/excluir_usuario.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                carregarUsuarios();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Erro ao excluir usuário:', error);
            alert('Erro ao excluir usuário');
        });
}
