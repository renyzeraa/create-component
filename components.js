// componentes.js

// primeiro componente

function Prototipo(tituloTexto, permiteNegativo){
    
    this.obj = $('<article>').addClass('prototipo_um');
    this.permiteNegativo = permiteNegativo;
    this.titulo = $('<h1>').text(tituloTexto).addClass('titulo');
    this.valor = $('<input>')
            .attr({
            type: 'number',
            placeholder:'N',
            id: 'input_num'});
    this.data = $('<input>')
            .attr(
           {type: 'date', 
            min:'2000-01-01', 
            max:'2100-12-31',
            id: 'input_dat'});
    this.botao = $('<button>')
            .attr({type:'submit'})
            .text('Resultado')
            .addClass('botao')
            .on('click', function(){
                try {
                    this.validaDados();
                    this.ajaxResultadoComponente();
                } catch (e) {
                    window.alert(e);
                }              
            }.bind(this));
    this.container = $('<p>').addClass('container');
    
    this.obj.append(this.titulo,this.valor,this.data,this.botao, this.container );   
};

// setters ============================

Prototipo.prototype.setValor = function (valor) {
    this.valor.val(valor);
};

Prototipo.prototype.setData = function (data) {
    this.data.val(data);
};

Prototipo.prototype.setPermiteNegativo = function (permiteNegativo) {
    this.permiteNegativo = permiteNegativo;
};

Prototipo.prototype.appendTo = function (obj) {
    obj = $(obj);
    obj.empty();
    obj.append(this.obj);
};

Prototipo.prototype.ajaxResultadoComponente = function () {
    ajaxResultadoComponente(this.valor.val(), this.data.val());
};



// Função que valida os dados no Front-End

Prototipo.prototype.validaDados = function () {
    var data = this.data.val();
    var valorNum = this.valor.val();    
    var valor = parseInt(this.valor.val());
    var dataInformada = new Date(data);
    if ((this.permiteNegativo == false) && (valor < 0)) {
        throw ('Valor invalido,permitido apenas numeros positivos');
    } else if (!data || !valorNum) {
        throw ('Nenhum campo pode estar vazio, tente novamente');
    } else if (dataInformada.getFullYear() < 2000 || dataInformada.getFullYear() > 2100) {
        throw ('Data Invalida, informe uma data entre 2000 e 2100');
    } else if (valor != valorNum) {
        throw ('Valor inválido, permitido apenas números inteiros');
    }  
};

/*
 *  Passa a heranca dos metodos para o novo objeto
 */

PrototipoNovo.prototype = new Prototipo();
PrototipoNovo.prototype.constructor = PrototipoNovo;

// componente 2 ====================

function PrototipoNovo(){
    Prototipo.apply(this, arguments);
    
    this.obj = $('<article>').addClass('prototipo_dois');
    this.labelCheck = $('<label>').text('Deseja subtrair este valor');
    this.checkbox = $('<input>').attr({
        type: 'checkbox', 
        name: 'subtrair', 
        id: 'checkbox'});
    this.labelSelect = $('<label>').text('Incrementar');
    this.select = $('<select>').attr({name:'select', id: 'select'}).addClass('select');
    this.option1 = $('<option>').attr({value: 'Dia'}).text('Dia');
    this.option2 = $('<option>').attr({value: 'Mes'}).text('Mes');
    this.option3 = $('<option>').attr({value: 'Ano'}).text('Ano');
    this.div = $("<div>").addClass('select-content') ;
    this.botao1 = $('<button>')
            .attr({type:'submit'})
            .text('Resultado')
            .addClass('botao1')
            .on('click', function(){
                try {
                    this.validaDados();
                    this.ajaxResultadoComponente2();
                } catch (e) {
                    window.alert(e);
                }              
            }.bind(this));
    this.select.append(  
        this.option1,
        this.option2,
        this.option3); 
    
    this.div.append(
        this.labelCheck,
        this.checkbox,
        this.labelSelect,
        this.select,
    ); 
    
    this.obj.append(
        this.titulo,
        this.valor,
        this.div,
        this.data,
        this.botao1, 
        this.container 
     ); 
}

PrototipoNovo.prototype.ajaxResultadoComponente2 = function () {
    const checkbox = $('#checkbox').is(':checked');
    ajaxResultadoComponente2(
            this.valor.val(), 
            this.data.val(), 
            this.permiteNegativo = false ,
            this.select.val(),
            checkbox);
};