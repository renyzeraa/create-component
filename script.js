// script.js

// criar primeiro component

$('document').ready(function(){
    $('#btn1').on('click', ajaxComponente);
    $('#btn2').on('click', ajaxComponenteNovo);
});

function ajaxComponente() {
// Retorna a inicialização do componente 1, o passa o processo criarComponente via GET
    $.ajax({
        url: "http://localhost/treinamento/index.php",
        method: "GET",
        data: 'processo=criarComponente&id=componente'
    }).done(function (resultado) {
        localStorage.setItem('resultado', resultado);
        $('#componente').append(resultado);
    });
}
 
function ajaxResultadoComponente (valor, data, permiteNegativo) {
// Retorna o resultado do componente 1, passa o processo criarResultado via POST
    $.ajax({
        url: "http://localhost/treinamento/index.php?processo=criarResultado",
        method: "POST",
        data: {dados: JSON.stringify(
                    {valorNum: valor, 
                    valorData: data ,
                    valorPermiteNegativo: permiteNegativo})}
    }).done(function (resultado) {
        $('.container').empty();
        $('.container').append(resultado);   
});
    
}

function ajaxResultadoComponente2 (valor, data, permiteNegativo ,select ,checkbox ) {
// Retorna o resultado do componente 2, passa o processo criarResultado via POST
    $.ajax({
        url: "http://localhost/treinamento/index.php?processo=criarResultadoNovo",
        method: "POST",
        data: {dados: JSON.stringify(
                    {valorNum: valor,  
                    valorData: data , 
                    valorPermiteNegativo: permiteNegativo, 
                    valorCheckbox: checkbox, 
                    valorSelect: select})}
    }).done(function (resultado) {
        $('.container').empty();
        $('.container').append(resultado);  
    });    
}

function ajaxComponenteNovo() {
// Retorna a inicialização do componente 2, o passa o processo criarComponente via GET
    $.ajax({
        url: "http://localhost/treinamento/index.php",
        method: "GET",
        data: 'processo=criarComponente2&id=componente'
    }).done(function (resultado) {
        localStorage.setItem('resultado', resultado);     
        $('#componente').append(resultado);
    });   
}

// Função para sarvar os dados localStorage
//componente 1

// se tiver o valor, ira colocar direto no html
localStorage.resultado ? $('#componente').append(localStorage.resultado) : ' ';
localStorage.numero ? $('#input_num').val(localStorage.numero) : ' ';
localStorage.data ? $('#input_dat').val(localStorage.data): ' ';   
localStorage.select ? $('#select').val(localStorage.select): ' ';     

// mandar os dados para o localstorage
const salvarDados = function (){
    const inputNum = $('#input_num').val();
    const inputDat = $('#input_dat').val();
    
    // componente 2
    const select = $('#select').val();
    
    localStorage.setItem('numero', inputNum);
    localStorage.setItem('data', inputDat);
    
    // componente 2
    localStorage.setItem('select', select);
    
};

// pegar o valor em mudança
document.onchange = salvarDados;