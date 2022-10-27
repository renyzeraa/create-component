## Treinamento Front-End

```
Para execultar o projeto necessita de um servidor, pode ser XAMPP ou Apache
```

1 - Iniciar um projeto.
2 - Criar um arquivo HTML.
3 - Adicionar um botão e seus atributos.
Ao clicar neste botão deverá ser criado o componente 1.
4 - Crie um arquivo JS para a criação dos componentes.
5 - Crie o primeiro componente.
6 - Adicione ao componente seus atributos e seus métodos
7 - Esse primeiro componente será composto pelos seguintes
campos:
- Um título.
- Outro campo para informar um valor que será somado
a data informada.
- Um campo para informar uma data entre os anos de
2000 e 2100.
- Um botão para trazer o resultado.
- Antes de exibir o resultado, os dados
devem ser validados
- Uma pequena área para o resultado.
8 - Deve ser informado se o valor a ser somado pode
ser negativo ou não.
9 - Crie um arquivo sass para os estilos.
10 - Crie um arquivo PHP.
11 - Crie uma classe que irá representar o componente
criado, com os mesmos metodos atributos.
12 - Crie um novo arquivo JS, será o script para funções.
13 - Neste arquivo crie uma função ajax para iniciar o
componente 1. Esta função deve ser chamada ao clicar
botão criado inicialmente.
14 - Esta função deverá passar para o PHP, via GET, um
JSON informando o processo
15 - Crie um novo arquivo PHP, este irá receber os dados.
16 - Neste, verifique se o processo está setado, se não
estiver, inicie o html, se estiver, inicie o componente
via getScript.
- O método getScript deve estar presente na
clesse criada para o componente no PHP, ela deve retornar
um script que será adicionado a área do componente.
17 - Adicione o retorno do ajax a área do componente.
18 - Adicione outra função ajax para gerar o resultado,
esta deve ser chamada ao clicar no botão do componente,
deve validar os dados e adicionar o resultado abaixo do
botão.
18 - A função deve passar para o PHP, via POST, um objeto
JSON com os dados informados.
20 - Agora crie mais um componente, este deve estender do
primeiro, porém deve adicionar:
```
- Um campo que permite o usuário decidir se quer
subtrair.
- Um campo para selecionar o que deseja incrementar
	- Será possivel selecionar DIA, MÊS e ANO

```
21 - Salve localmente qual foi o ultimo componente aberto,
ao abrir a pagina, o componente deve se iniciar
automaticamente, caso exista algum dado salvo e seus valores.