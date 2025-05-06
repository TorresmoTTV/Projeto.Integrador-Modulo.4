document.addEventListener('DOMContentLoaded', () => {
    const linhas = document.querySelectorAll('.linha-tecnico');

    linhas.forEach(linha => {
        linha.addEventListener('click', function () {
            const idTecnico = this.getAttribute('data-id');
            const nome = this.getAttribute('data-nome');
            const email = this.getAttribute('data-email');
            const cpf = this.getAttribute('data-cpf');
            const telefone = this.getAttribute('data-telefone');
            const usuario = this.getAttribute('data-usuario');
            const senha = this.getAttribute('data-senha');

            document.querySelector('input[name="id_tecnico"]').value = idTecnico;
            document.querySelector('input[name="nome"]').value = nome;
            document.querySelector('input[name="email"]').value = email;
            document.querySelector('input[name="cpf"]').value = cpf;
            document.querySelector('input[name="telefone"]').value = telefone;
            document.querySelector('input[name="usuario"]').value = usuario;
            document.querySelector('input[name="senha"]').value = senha;

            document.querySelector('button[type="submit"]').textContent = 'Editar Técnico';
            document.querySelector('input[name="acao"]').value = 'editarConfirmado';
        });
    });
});
