// Função para detectar se o select está aberto ou não
let selectElement = document.getElementById('user-role');
let arrowButton = document.getElementById('arrow-btn');

selectElement.addEventListener('focus', function () {
    // Adiciona a classe que faz o botão subir quando o select for clicado
    arrowButton.classList.add('opened');
});

selectElement.addEventListener('blur', function () {
    // Remove a classe que faz o botão voltar para baixo quando o select perde o foco
    arrowButton.classList.remove('opened');
});

// Alternativa ao clique para mudar a seta para cima ou para baixo
function updateArrow() {
    if (selectElement.value !== "") {
        arrowButton.classList.add('opened');
    } else {
        arrowButton.classList.remove('opened');
    }
}

