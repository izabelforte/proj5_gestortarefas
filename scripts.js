
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
