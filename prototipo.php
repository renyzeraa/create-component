// prototipo.php
<?php

//PHP componente 1

/*
 * Criar classe Prototipo para passar seus m�todos e atributos iniciais, que ir�o definir o prototibo base e inicial, esse ser� o Componente 1
 */

class Prototipo {   
    private $section;
    private $nome;
    private $data;
    private $numero;
    private $titulo;
    private $tituloBotao;
    private $permiteNegativo;
    
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
     * Se os dados forem válidos, serao definidos em suas propriedades
     */
    
    public function setValor($json) {
        $this->validaDados($json);  
        $this->setNumero($json['valorNum']);
        $this->setData($json['valorData']);
    }
    
    /*
     * Fun��o recebe um c�digo Javascript que sera passado para o PHP interpretar
     */
    public function getScript() {
        return 'var componente = new Prototipo('.json_encode(strip_tags($this->getTitulo())).', '.json_encode(strip_tags($this->getTituloBotao())).', '.json_encode($this->getPermiteNegativo()).');'
               . 'componente.appendTo("#'.$this->getSection().'")';
    }
    
    /*
     * Fun��o que gera o resultado
     */
    public function getResultado($json) {
        $data = $this->getData();
        $valor = $this->getNumero();
        $Data = new DateTime($data);    
        $resultado = $Data->modify('+'.$valor.'day')->format('d/m/Y');
        return $resultado;
    }
}