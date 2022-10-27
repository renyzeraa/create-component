<?php
/*
 * Criar classe PrototipoNovo para passar seus m�todos e atributos iniciais, que ir�o definir o prototibo base e inicial, esse ser� o Componente 2
 */
class PrototipoNovo extends Prototipo {   
    private $section;
    private $nome;
    private $data;
    private $numero;
    private $titulo;
    private $tituloBotao;
    private $permiteNegativo;
    private $checkbox;
    private $select;
    
    public function __construct($section, $nome) {      
        $this->section = $section;
        $this->nome = $nome;
        $this->permiteNegativo = false;
    }
    
    /*
     * Getters e Setters
     */
    
    /*
     * Section
     */
    
    public function getSection() {
        return $this->section;
    }

    public function setSection($section) {
        $this->section = $section;
    }
    
    /*
     * Nome
     */
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    /**
     * Retorna a data
     * @return String
     */
    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }
    
    /*
     * Numero
     */
    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }
    
    /*
     * Titulo
     */
    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    
    /*
     * Titulo botao
     */
    public function getTituloBotao() {
        return $this->tituloBotao;
    }

    public function setTituloBotao($tituloBotao) {
        $this->tituloBotao = $tituloBotao;
    }
    
    /*
     * Permite negativo
     */
    public function getPermiteNegativo() {
        return $this->permiteNegativo;
    }

    public function setPermiteNegativo($permiteNegativo){
        $this->permiteNegativo = $permiteNegativo;  
    }
    
    /*
     * Checkbox
     */
    public function getCheckbox() {
        return $this->checkbox;
    }

    public function setCheckbox($checkbox) {
        $this->checkbox = $checkbox;
    }
    
    /*
     * Select
    */
    public function getSelect() {
        return $this->select;
    }

    public function setSelect($select) {
        $this->select = $select;
    }
    
    /*
     * Valida no PHP os dados recebidos do usuario
     */
    public function validaDados($json) {
        if(!isset($json) && $json){
            throw new Exception('Json não foi setado');
        }

        if (!isset($json['valorNum']) || !isset($json['valorData'])) {
            throw new Exception("Existe algum campo vazio");
        }

        $dataInformada = date_parse($json['valorData']);
        $dataMinima = date_parse('01/01/2000');
        $dataMaxima = date_parse('31/12/2100');

        if($dataInformada < $dataMinima) {
            throw new Exception('Data informada invalida, data minima permitida: 01/01/2000');
        } else if($dataInformada > $dataMaxima) {
            throw new Exception('Data informada invalida, data maxima permitida: 31/12/2100');
        }

        if ($this->permiteNegativo == false && $json['valorNum'] < 0) {
            throw new Exception('O valor informado deve ser positivo, tente novamente');
        }

        if (!is_numeric($json['valorNum']) || !preg_match('/^\d+$/', $json['valorNum'])) {
            throw new Exception('O valor informado deve ser um numero inteiro positivo, tente novamente');
        }
    }
    
    /*
     * Se os dados forem v�lidos, serao definidos em suas propriedades
     */
    public function setValor($json) {
        parent::setValor($json);
        $this->setSelect($json['valorSelect']);
        $this->setCheckbox($json['valorCheckbox']);
       
    }
    
    /*
     * Fun��o recebe um c�digo Javascript que sera passado para o PHP interpretar
     */
    public function getScript() {
        return 'var componente = new PrototipoNovo('.json_encode(strip_tags($this->getTitulo())).', '.json_encode(strip_tags($this->getTituloBotao())).', '.json_encode($this->getPermiteNegativo()).');'
               . 'componente.appendTo("#'.$this->getSection().'")';
    }
    
    /*
     * Fun��o que gera o resultado
     */
    
    public function getResultado($json) {
        $data = $this->getData();
        $valor = $this->getNumero();
        $Data = new DateTime($data);
       
        $checkbox = $this->getCheckbox();
        $select = $this->getSelect();
        
        if($select == 'Dia'){
           $select = 'day';
        }
        if($select == 'Mes'){
           $select = 'month';
        }
        if($select == 'Ano'){
           $select = 'year';
        }
        
        $checkbox ? ($operator = '-') : ($operator = '+');

        $resultado = $Data->modify($operator.$valor.$select)->format('d/m/Y'); 
        return $resultado;
    }
}