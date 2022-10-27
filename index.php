// index.php
<meta charset="UTF-8"> 
<?php

        include_once './prototipo.php';
        include_once './prototiponovo.php';
        //Imprimir na tela o conteudo do HTML

        $processo = isset($_GET['processo']) ? $_GET['processo']: null;

        // se não não receber um processo, vai abrir o HTML, 
        // se receber um processo irá executar
        if(!$processo) {
            include_once 'index.html';
        } else {
            switch ($processo) {
                case 'criarComponente':
                    $componente = new Prototipo('componente', 'botao');
                    $componente->setTitulo('Componente 1');
                    echo '<script>'.$componente->getScript().'</script>';
                    $id = $_GET['id'];
                    break;
                case 'criarComponente2':
                    $componente = new PrototipoNovo('componente', 'botao');
                    $componente->setTitulo('Componente 2');
                    echo '<script>'.$componente->getScript().'</script>';
                    $id = $_GET['id'];
                    break;
                case 'criarResultado':          
                    $componente = new Prototipo('componente', 'botao');
                    $dados = isset($_POST['dados']) ? $_POST['dados']: null;
                    if(is_string($dados)) {
                       $json = json_decode($dados, true);
                       $componente->setValor($json);
                       echo $componente->getResultado($json);
                    }
                    break;
                case 'criarResultadoNovo':          
                    $componente = new PrototipoNovo('componente', 'botao');
                    $dados = isset($_POST['dados']) ? $_POST['dados']: null;
                    if(is_string($dados)) {
                       $json = json_decode($dados, true);
                       $componente->setValor($json);
                       echo $componente->getResultado($json);
                    }
                    break;
            }           
}