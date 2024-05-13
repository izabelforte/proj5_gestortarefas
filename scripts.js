
var infoExpanded = false;

function exibirAlerta(difference, texto) {
    var dias = parseInt(difference);
    if (infoExpanded && dias <= 3 && dias >= 0) {
        Swal.fire({
            title: "Tarefa próxima",
            text: texto,
            icon: "warning"
        });
    }
}

function expandirInfo(element, difference) {
    var infoContainer = element.querySelector('.info-container');
    if (infoContainer.style.display === 'none' || !infoContainer.style.display) {
        infoContainer.style.display = 'block';
        infoExpanded = true;
        // exibir o alerta apenas quando a informação é expandida
        exibirAlerta(difference, "Texto do alerta");
    } else {
        infoContainer.style.display = 'none';
        infoExpanded = false;
    }
}

function mostrarTarefas(element){
    var mostrarTar = document.querySelector('.list-tasks');
    const arrow = document.getElementById('seta')
    if (mostrarTar.style.display === 'none') {
        mostrarTar.style.display = 'block';
        arrow.classList.remove('bi-caret-down-fill');
        arrow.classList.add('bi-caret-up-fill');

    } else {
        mostrarTar.style.display = 'none';
        
        arrow.classList.remove('bi-caret-up-fill');
        arrow.classList.add('bi-caret-down-fill');
    }
}
