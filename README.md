# Laravel 9 API REST com autenticação Sanctum

# Sobre, anotações e etc

Este projeto foi baseado em um tutorial do youtube e tem como objetivo o estudo e prática do desenvolvimento de API's com o Laravel 9. Meu objetivo com as anotações foi explicar para mim mesmo, de forma clara, sobre o projeto feito a partir dos 2 videos e como eu desenvovi ele.

Não removi nenhum arquivo de view, ou outros não utilizados nesse projeto.

**Link da playlist (video 1)**

**https://www.youtube.com/watch?v=LD0m-CEw1d4**

**Link da playlist (video 2)**

[**https://www.youtube.com/watch?v=qOH0mxcd0Ec**](https://www.youtube.com/watch?v=qOH0mxcd0Ec)

#
# **Requisitos**

O projeto foi feito utilizando php 8, composer, Laravel9 e mysql (ultima versão)

O php precisa estar instalado → [https://www.php.net/manual/pt\_BR/install.php](https://www.php.net/manual/pt_BR/install.php)

O composer precisa estar instalado para executar o projeto → https://getcomposer.org/download/

O mysql precisa estar instalado, ou pelo menos algum banco de dados ( o tutorial em video mostra como configurar o banco) → [https://dev.mysql.com/downloads/installer/](https://dev.mysql.com/downloads/installer/)

# Instalação

- Baixe o projeto, usando o comando de terminal no repositorio indicado:

**git clone**  **https://github.com/viniciusalvessouza/API\_Laravel9\_sanctum.git**

  - ou baixando o arquivo zip, ou outro dos metodo possiveis
- No diretorio do projeto execute o seguinte comando:

**composer install**

# Execução do projeto

No terminal, no diretorio do arquivo, digite o seguinte comando:

**php artisan serve**

A partir dai ele executara um servidor local com o Laravel funcionando


# Parte 1

Existe uma checklist, e nessa parte estamos seguindo a checklist que está disponível em:

[**https://candied-gooseberry-205.notion.site/API-REST-LARAVEL-9-22de6e2693d74dd1a43beee4e1711bb8**](https://candied-gooseberry-205.notion.site/API-REST-LARAVEL-9-22de6e2693d74dd1a43beee4e1711bb8)

![Shape1](RackMultipart20230111-1-cf56xx_html_637d9868a4e92af.gif)

![](RackMultipart20230111-1-cf56xx_html_db695a2e79797d91.png)_Figura 1: Cheklist do projeto (feita pelo autor do video)_

Vamos percorrer o passo a passo da figura 1

OBS: o que eu já fiz mas não expliquei na playlist eu vou explciar depois de ter terminado tudo e arrumado o texto

  
## Cheklist de ambiente

- Instalar php (já foi)
- Instalar composer já foi)
- Instalar Visual Studio (já foi)
- Instalar Dbvear (acho q vi esse em outro curso, mas não sei )
- Instalar **Isomnia** (esse eu vi em outro curso)

  
## Cheklist de preparação do Projeto

- Criar o projeto
  - **composer create-project laravel/laravel api**
- Iniciar o Servidor de desenvolvimento
  - **cd api/**
  - **php artisan serve**
- Acompanhe o video para ficarmos juntos (assistir o video)

Eu tenho que configurar o banco de dados no arquivo **.env**

No video ele usa o xampp, vou testar com docker.

**OFF TOPIC –**  **INICIO**** :**

Instruções para instalar o mysql no docker

- dar um pull da isso, usando **docker pull mysql**
- mandar o docker rodar em uma porta, usando **docker run -p 3306:3306 --name banco\_API -e MYSQL\_ROOT\_PASSWORD=root -d mysql**
  - o **3306:3306** significa que a porta 3306 do meu computador representa a porta 3306 do container
  - **banco\_API** é o nome do banco
- Com o comando **docker ps** eu vejo o banco rodando.

**Referencia:**

[**https://www.youtube.com/watch?v=XP-O4VqqDCg**](https://www.youtube.com/watch?v=XP-O4VqqDCg)

**OFF TOPIC –**  **FIM**

Encerrando o off topic e a configuração do arquivo **.env** (só mudar os valores das varias do mysql, bem facil de ver pra mim que já sei hehehe, a gente parte para criar uma model, usando o comando:

**php artisan make:model Product --migration**

Esse comando já cria a migration e a model que estão respetivamente em:

**databases/migration/2023\_01\_02\_195822\_create\_products\_table.php**

**app/Models/Products.php**

associando de forma correta, como por exemplo, usando o nome no plural para a tabela, enquanto o nome fica no singular na model (eu botei no singular, ele só acrescentou um 's' no fim).

Agora vamos para a migrate criada. Nela vamos inserir os seguintes campos:

**string('name');**

**string('slug');**

**string('description')-\>nullable;**

**sdecimal('price',5,2);**

E após isso usar o comando de migrate:

**php artisan migrate**

**OFF TOPICS:** Funcionou a conexão com o container docker

Agora vamos para as rotas de autenticação ( **routes/auth.php** ). Já existe uma rota padrão para o users (o users no laravel já vem quase todo configurado) com a autenticação do **Sanctum**

Vou criar uma rota products, com uma mensagem só para testar.

O **isomnia** que vai ser usado agora é igual o postman, serve para testar API's

O computador travou e não pude registrar o horario do video em que parei, imagino que por volta dos 6 minutos

Testei a rota [**http://127.0.0.1:8000/api/products**](http://127.0.0.1:8000/api/products) e funcionou, tanto no **postman** quanto no navegador (o tipo de rota é como verbo get)

Acho que os **endpoints** , são as rotas mesmo

Funcionando o teste, vamos criar uma controller usando o comando do artisan:

**php artisan make:controller Products --api**

Dessa forma ele já cria os **endpoints** automaticamente, uma beleza, alem da controller chamada Products. Ela fica no arquivo **app/http/Controllers/Products.php**

Uso a controller na rota **/Products** , com o metodo index, na controller uso a model criada para o banco e mando mostrar tudo com esse comando:

**return Products::all();**

Lembrando que o **Products** na controller é a chamada de:

**use App\Models\Products;**

O próximo passo é criar uma rota post para inserir elementos, para isso vou priemrio criar a post com a function direto na rota, depois faço o processo na controller.

O teste deu erro pois por padrao o **eloquent** do Laravel impede esse tipo de envio de dados, como se fosse um envio em massa, para evitar isso eu vou na **model\Products** e faço a seguinte alteração, para liberar os campos editaveis:

**protected $fillable = [**

**'name','slug','description','price'**

**];**

Deu erro, vou continuar amanha

**Error:**

ErrorException: array\_flip(): Can only flip string and integer values, entry skipped in file /home/vinicius/vinicius/programação/php/CURSOS/Laravel 9 API REST com autenticação Sanctum/pratica/api/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Concerns/GuardsAttributes.php on line 250

Quando mudei o valor do price para um inteiro, ele deu um outro erro.

Tudo se resolveu, foi um erro de digitação na camada model. Eu coloquei no $fillable o que devia ter posto no create, quando na verdade era pra por só os campos.

Agora vou passar para o controller, vai para o metodo store, ali vou usar o comando:

**$request→validate([**

**'name'=\>'required',**

**'slug'=\>'required',**

**'price'=\>'required',**

**]);**

Depois o comando create, da model:

return **Products::create($request→all() );**

Pausando em 17:14, testei no postman e consegui enviar uma entrada

Consegui postar com o postman, e se eu deixo um campo errado ele retirna um jason de erro

Configurei o header, com as caracteristicas :

**Content-type : multipart/form-data**

**Accept : application/json**

Tenho que aprender melhor sobre os **header's**

Voltando ao Laravel vamos mexer no medoto show da controller, criando um return simples:

**return Product::find($id);**

Esse comando retorna a busca pela chave primaria da inha tabela definida na model

Agora ao update. O processo das rotas não muda nada, a não ser o metodo, que vai ser **put** e o metodo update da controller, que vai ter o seguinte comando

**$product = Product::findOrFail($id);**

**$product→update($request→all());**

**return $product;**

No postman eu faço um caminho, com as configurações iguais ao create, mas usando o metodo put e a rota do show (quase um frankstein).

**"É como se eu criasse um registro em cima de um registro que já existe, mas só alterando algumas partes ou tudo" - Souza Vinicius**

Tava dando erro no postman, mas eu devia ter mudado o body para x-www-form-urlencode

Passei trabalho para testar o body do put, LEMBRAR DISSO NO FUTURO

Vou criar uma nova rota e controller para pesquisar por nome o produto chamada **search**

Nao vou me estender demais, mas funcionou de forma direta, com o where()→get()


# Parte 2

Agora vamos as autenticações, usando o pacote **Laravel/Sanctum** , que já vem com o Laravel 9.

É um sistema de autenticação leve, para SPA (single page applications), aplicativos moveis e API's baseadas em tokem (fala la na documentação do sanctum no laravel). O Sistema de token é inspirado no token do github.

Vamos gerar o token de API.

Tendo o sanctum instalado, devemos publicar a configuração do sanctum e os arquivos de migrations, usando o comando do artisan, **vendor:publish** , o arquivos de configuração, fica na pasta de **config**. O comando para fazer tudo isso é:

**php artisan vendor:publish –provider="Laravel\Sanctum\SanctumServiceProvider"**

Deu um erro:

Call to undefined function Termwind\ValueObjects\mb\_strimwidth()

Correção:

~~**https://medium.com/@justin.nam0909/call-to-undefined-function-termwind-valueobjects-mb-strimwidth-as-you-install-laravel-sanctum-c9b6654d2977**~~

Nao funcionou

Atualizei o sanctum e não mudou nada (de 3.0.1 para 3.1.0)

Estou tentando instalar a biblioteca mbstring e ver se vai funcionar. FUNCIONOU

Passo a passo da solução:

1. instalo o mbstring usando o comando de instalação conforme a minha versão do php:

- sudo apt-get install php8.1-mbstring

1. No arquivo **etc/php/php/8.1/cli/php.ini** , eu libero o acesso da recém instalada biblioteca mbstring, tirando o **";"** da biblioteca na parte onde são listadas as bibliotecas usadas e a função que não existia passa a existir pois faz parte dessa **bilioteca** (lib para quem prefere inglês)
2. OBS: Caso a instalação realmente funcione, será criado o arquivo **/etc/php/8.1/mods-available/mbstring.ini. S** e o arquivo não estiiver lá ou na pasta correspondente de modulos do php, apache, servidor, ou o que for, na versão ou no sistema operacional usado (no caso eu uso linux), então não foi instalado corretamente.
3. ATUALIZAÇÃO POSTERIOR: quando eu chamo o php ele diz q a mbstring já esta sendo chamada, talvez eu deva recomentar o mbstring no arquivo

Para usar o **Sanctum** em um **SPA** , eu devo descomentar uma linha no arquivo **app/Http/Kernel.php** , na variavel **$api**.

Agora vamos criar rotas seguras, vamos para **routes/api.php** e vamos apagar as rota padrao do sanctum para criar um grupo de rotas que vao usar S **anctum**. Dentro desse grupo, vou pegar algumas rotas e permitir acesso apenas a quem estiver autenticado (vou colocar algumas das rotas feitas no grupo). Coloquei as rotas com **put, post e delete**.

Quando eu tento usar uma dessas rotas seguras, eu recebo um **json** de retorno, com:

**{'message':'Unauthenticated.'}**

Agora crio um controller para as autenticações:

**php artisan make:controller AuthController**

Crio o method register que recebe um parametro **Request**. Faço o **$request→validade([])** do 'login da API', crio um usuario, usando o **User::create([])** (classe que já existe no Laravel9). Depois parto pro token, a partir do user criado (coloco o user create em um variavel), eu uso o **method createToken** , dessa forma:

**$token = $user→createToken('primeiroToken')→plainTextToken;**

Crio uma variavel de resposta, que passa um array com o user e o token e faço um:

**return response($response,201);**

O **response()** é usado para respostas e o 201 representa o codigo http da resposta (existe uma longa tabela sobre isso na internet)

Agora testamos se da pra fazer um user no **Isomnia** (postman, porque é o que estou usando). A ideia é criar um post de usuario.

Campos usados:

**name**

**e-mail**

**password**

**password\_confirmation**

Eu segui o video, mas notei que não ia funcionar porque não tinha rota.

Crio a rota para o method register da controller que criei.

Fiz a teste e me gerou um token e a response foi essa (baseado nos valores passados:

**{**

**"user"**** : {**

**"name"**** : ****"Fake Nome da Silva" ****,**

**"email"**** : ****"fakeemail.dev@gmail.com" ****,**

**"updated\_at"**** : ****"2023-01-11T13:00:58.000000Z" ****,**

**"created\_at"**** : ****"2023-01-11T13:00:58.000000Z" ****,**

**"id"**** : **** 1**

**},**

**"token"**** : {**

**"accessToken"**** : {**

**"name"**** : ****"primeiroToken" ****,**

**"abilities"**** : [**

**"\*"**

**],**

**"expires\_at"**** : **** null ****,**

**"tokenable\_id"**** : **** 1 ****,**

**"tokenable\_type"**** : ****"App\\Models\\User" ****,**

**"updated\_at"**** : ****"2023-01-11T13:00:59.000000Z" ****,**

**"created\_at"**** : ****"2023-01-11T13:00:59.000000Z" ****,**

**"id"**** : **** 1**

**},**

**"plainTextToken"**** : ****"1|rFEvAwe9giITzeibkPgtWFPjECgfGTVvcjS8tN9a"**

**}**

**}**

Dessa vez deixei colorido para destacar mesmo. Ele esta funcionado e não permite e-mails repetidos, por causa das configurações do **$request→validate([]);**

Após criar o user, devo aprender a usar o token gerado. No postam, eu devo colocar na barra authentication e usar um bear token, e copiar o token de resposta que eu recebi,aquele **plainTextToken.** É meio obvio mas vale lembrar: O token é exclusivo por usuario, então esse token de exemplo na verdade funciona de verdade e eu não devo compartilhar ele nunca com ninguém. OBS: O token foi alterado, apesar de nesse caso não ter sido necessario pois a API não esta sendo executada em lugar nenhum e eu ter apagado os tokens de usuario.

Funcionou lindamente, falta descobrir como eu usaria o header em um form de verdade hehehe

Vamos criar um **method login** na minha **AuthController**. Esse method, vai:

- Validar o request usando o **$request-\>validate([])**;
- Testar se o e-mail pertence a algum user, usando o **User::Where('',$var)-\>first();**
- Testar se a senha do usuario confere com a do request, usando o **Hash::check($entrada, $hashado)**;
- Fazer a parte de **token** igual ao **method regster()** e retornar o reponse

Agora a rota do login da mesma forma que fiz sempre e depois parto para o **Isomnia** ( postman) e faço um post na rota de login

Agora para o **logout()** que vai ser feito da seguinte forma:

- **auth()→user()→tokens()→delete();**
- **mensagem de retorno**
  - **Esse comando destroi todos os tokens, tem como destruir só algum(ns)**

Agora os tokens criados anteriormente serão destruidos no acesso da rota que vamos criar para isso, como sempre testaremos no **isomnia** (postman)

PROBLEMA: A FUNÇÃO **auth()→user()→tokens()→delete();** esta dando erro, eu não consigo acessar o usuario do token por aqui

Passei um trabalhão porque eu tentei dar logout em uma rota que não estava no no grupo de autenticação, dai não ia nunca, vou colocar a rota de logout dentro do grupo de auth e tudo se resolve

**Referência:**

[https://laravel.com/docs/9.x/sanctum](https://laravel.com/docs/9.x/sanctum)
