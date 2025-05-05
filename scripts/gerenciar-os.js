document.addEventListener('DOMContentLoaded', () => {
    const linhas = document.querySelectorAll('.linha-os');

    linhas.forEach(linha => {
        linha.addEventListener('click', function () {
            const idOs = this.getAttribute('data-id');
            const condicao = this.getAttribute('data-condicao');
            const descricao = this.getAttribute('data-descricao');
            const linkUnboxing = this.getAttribute('data-linkunboxing');
            const dataInicio = this.getAttribute('data-datainicio');
            const dataFim = this.getAttribute('data-datafim');
            const cliente = this.getAttribute('data-cliente');
            const tecnico = this.getAttribute('data-tecnico');

            document.querySelector('input[name="id_os"]').value = idOs;
            document.querySelector('input[name="condicao"]').value = condicao;
            document.querySelector('textarea[name="descricao"]').value = descricao;
            document.querySelector('input[name="linkUnboxing"]').value = linkUnboxing;
            document.querySelector('input[name="dataCriacao"]').value = dataInicio;
            document.querySelector('input[name="dataFinalizacao"]').value = dataFim;
            document.querySelector('input[name="cliente"]').value = cliente;
            document.querySelector('input[name="tecnico"]').value = tecnico;

            document.querySelector('button[type="submit"]').textContent = 'Editar OS';
            document.querySelector('input[name="acao"]').value = 'editarConfirmado';
        });
    });
});
