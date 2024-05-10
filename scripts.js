
var infoExpanded = false;

function exibirAlerta(texto) {
    if (infoExpanded) {
        Swal.fire({
            title: "Tarefa próxima",
            text: texto,
            icon: "warning"
        });
    }
}

function expandirInfo(element) {
    var infoContainer = element.querySelector('.info-container');
    if (infoContainer.style.display === 'none' || !infoContainer.style.display) {
        infoContainer.style.display = 'block';
        infoExpanded = true;
        // exibir o alerta apenas quando a informação é expandida
        exibirAlerta("Texto do alerta");
    } else {
        infoContainer.style.display = 'none';
        infoExpanded = false;
    }
}
