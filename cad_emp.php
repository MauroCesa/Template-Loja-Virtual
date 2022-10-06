<?php
include "authCheck.php";
//Arquivo de Configuração com Banco de Dados
include "assets/src/cfg.php";

//Recebimento do POST do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  //recebe os campos do form
  $cnpj = $_POST['cnpj'];
  $nomeEmp = $_POST['nomeEmp'];
  $endereco = $_POST['endereco'];
  $email = $_POST['email'];
  $whatsapp = $_POST['whatsapp'];
  $facebook = $_POST['facebook'];
  $instagram = $_POST['instagram'];
  $twitter = $_POST['twitter'];
  $horarioAberto = $_POST['horarioAberto'];
  $horarioFechado = $_POST['horarioFechado'];

  //Executar o teste com echo para verificar se o form esta passando dados corretamente.
  //echo "$nomeCat";




  //Início do upldoad do arquivo.
  $target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Checando se é uma imagem real ou fake.
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Renomeia o arquivo para gravação.

function pegaExtensao($arquivo){
  $ext = explode('.',$arquivo);
  $ext = array_reverse($ext);
  return ".".$ext[0]; 
}
function pegaSomenteNome($arquivo){
  $nome = pathinfo($arquivo);
  return $nome['filename'];
}
function nomeAleatorio($arquivo){
  $extensao    = pegaExtensao($arquivo);
  $somenteNome = pegaSomenteNome($arquivo);
  //$rand	       = rand(0, 99999);
  //ou
  $rand = sha1($somenteNome.time());
  //return $somenteNome.$rand.$extensao;
  return $rand.$extensao;
}


$target_file = $target_dir . nomeAleatorio($_FILES["fileToUpload"]["name"]);

$file_name = explode("/", $target_file);

$uploadOk = 1;

// Checando o tamanho do arquivo.
if ($_FILES["fileToUpload"]["size"] > 10000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Verificando extesões de arquivos permitidas.
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Verificando se o marcado $uploadOk foi setado para 0 (falha no processo de verificação).
if ($uploadOk == 0) {
  echo "Desculpe, seu arquivo não foi carregado.";
// Se tudo estiver ok o arquivo será carregado.
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //echo "O arquivo ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " foi carregado com sucesso.";
  } else {
    echo "Desculpe, encontramos um erro ao carregar o seu arquivo.";
  }
}
//Fim do upload do arquivo.

$novaEmp = "UPDATE `empresa` SET `cnpj`='$cnpj',`nomeEmp`='$nomeEmp', `logo`='$file_name[1]',`endereco`='$endereco',`email`='$email',`whatsapp`='$whatsapp',`facebook`='$facebook',`instagram`='$instagram',`twitter`='$twitter',`horarioAberto`='$horarioAberto',`horarioFechado`='$horarioFechado' WHERE id = 1";

  $atualizaEmp = mysqli_query($con,$novaEmp);
}

//Busca as produtos no Banco de Dados
$consultaEmp = "SELECT * FROM `empresa`;";
$resultList = mysqli_query($con,$consultaEmp);
$rowList = mysqli_fetch_array($resultList);

//Busca as categorias no Banco de Dados
$consultaCat = "SELECT * FROM `categorias`;";
$resultListCat = mysqli_query($con,$consultaCat);
$rowList = mysqli_fetch_array($resultListCat);

?>

<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    
    <title>PHP + Banco de Dados</title>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
  </head>
  <body>
  
  
<header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">Sobre</h4>
          <p class="text-muted">Este modelo foi projetado para o Senac na UC de PHP + Banco de Dados.</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Contatos</h4>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white">21 97307-3353</a></li>
            <li><a href="#" class="text-white">leonardo@lksistemas.com.br</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="#" class="navbar-brand d-flex align-items-center">
       <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-filetype-php" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.295.185.522Zm4.48 2.666V11.85h-.79v1.626H4.153V11.85h-.79v3.999h.79v-1.714h1.682v1.714h.79Zm.703-3.999h1.6c.288 0 .533.06.732.179.2.117.354.276.46.477.105.201.158.427.158.677 0 .25-.054.476-.161.677-.106.199-.26.357-.463.474a1.452 1.452 0 0 1-.733.173H8.12v1.342h-.791V11.85Zm2.06 1.714a.795.795 0 0 0 .084-.381c0-.227-.061-.4-.184-.521-.123-.122-.294-.182-.513-.182h-.66v1.406h.66a.794.794 0 0 0 .375-.082.574.574 0 0 0 .237-.24Z"/>
</svg>
        <strong>PHP + Banco de Dados</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>

<main>



  <section class="py-5 text-center container">


<div class="container mt-3">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	  <div class="mb-3 row">
    
    <div class="col-12 mt-3">
      <label for="nomeModelo" class="form-label">Empresa</label>
      <input type="text" class="form-control" name="nomeEmp">
    </div>

    <div class="col-4 mt-3">
		  <label for="nomeModelo" class="form-label">E-mail</label>
		  <input type="text" class="form-control" name="email">
    </div>

    <div class="col-4 mt-3">
      <label for="nomeModelo" class="form-label">Localização</label>
		  <input type="text" class="form-control" name="endereco">
    </div>  

    <div class="col-4 mt-3">
      <label for="nomeModelo" class="form-label">CNPJ</label>
	  	<input type="text" class="form-control" name="cnpj"> 
    </div>  

    <div class="col-4 mt-3">
      <label for="nomeModelo" class="form-label">Whatsapp</label>
	  	<input type="text" class="form-control" name="whatsapp">
    </div>  

    <div class="col-4 mt-3">
      <label for="nomeModelo" class="form-label">Facebook</label>
	  	<input type="text" class="form-control" name="facebook">
    </div>  

    <div class="col-4 mt-3">  
      <label for="nomeModelo" class="form-label">Instagram</label>
	  	<input type="text" class="form-control" name="instagram">
    </div> 

    <div class="col-4 mt-3">  
      <label for="nomeModelo" class="form-label">Twitter</label>
	  	<input type="text" class="form-control" name="twitter">
    </div> 

    <div class="col-4 mt-3">  
      <label for="nomeModelo" class="form-label">Abertura</label>
	  	<input type="text" class="form-control" name="horarioAberto">
    </div> 

    <div class="col-4 mt-3">  
      <label for="nomeModelo" class="form-label">Fechamento</label>
	  	<input type="text" class="form-control" name="horarioFechado">
    </div> 

    <div class="col-12 mt-3 mb-3">
      <label for="nomeModelo" class="form-label">Imagem</label>
      <input type="file" id="fileToUpload" name="fileToUpload">
    </div> 

	  <div class="d-grid gap-2">
	  <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
	  
</form>
</div>  
  
<div class="container" >
<div class="row">
<div class="sm">
    <table class="table">
	  <thead>
		<tr>
		  <th scope="col">#</th>
		  <th scope="col">CNPJ</th>
          <th scope="col">Empresa</th>
          <th scope="col">Imagem</th>
          <th scope="col">Localização</th>
          <th scope="col">E-mail</th>
          <th scope="col">Whatsapp</th>
          <th scope="col">Facebook</th>
          <th scope="col">Instagram</th>
          <th scope="col">Twitter</th>
          <th scope="col">Abertura</th>
          <th scope="col">Fechamento</th>
		</tr>
	  </thead>
	  <tbody>
	  <?php $i = 1; if(mysqli_num_rows($resultList)>0){
                            //Irá separar o conteúdo do array em linhas
                            foreach ($resultList as $rowList){

                        ?>
        <tr>
            <th scope="row"><?php echo $i++ ?></th>
            <td><?php echo $rowList['cnpj']; ?></td>
            <td><?php echo $rowList['nomeEmp']; ?></td>
            <td><?php echo $rowList['logo']; ?></td>
            <td><?php echo $rowList['endereco']; ?></td>
            <td><?php echo $rowList['email']; ?></td>
            <td><?php echo $rowList['whatsapp']; ?></td>
            <td><?php echo $rowList['facebook']; ?></td>
            <td><?php echo $rowList['instagram']; ?></td>
            <td><?php echo $rowList['twitter']; ?></td>
            <td><?php echo $rowList['horarioAberto']; ?></td>
            <td><?php echo $rowList['horarioFechado']; ?></td>
            <td><img style="border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 150px;" src="uploads/<?php echo $rowList['logo']; ?>"></td>
        </tr>
        <?php
                     } //Fim do Loop do foreach.
                    } //Fim do if(mysqli_num_rows($resultList)).
                ?>   
                            
      
		
	
	  </tbody>
	</table>
	
</div>	


</div>
</div>
  </section>

  

</main>

<footer class="text-muted py-5">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#">Voltar para cima.</a>
      <br><a href="http://localhost:8080/lojasenac/cad_categoria.php">Categorias</a>
      <br><a href="http://localhost:8080/lojasenac/cad_produto.php">Produtos</a>
    </p>
    <p class="mb-1">Footer modelo</p>
    
  </div>
</footer>


    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>