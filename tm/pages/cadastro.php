<?php
  ob_start();
  @session_start();
	
	// logout
		$_SESSION['id_usuario'] = "";
		$_SESSION['id_cadastro'] = "";
		$_SESSION['nome_usuario'] = "";
		$_SESSION['login'] = "";
		$_SESSION['perfil'] = "";
		
		@session_destroy();
	
?>
<?php include "../util/util.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tenis de Mesa - ACRE - CADASTRO</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
       
        <div class="row">
            
            <div class="col-md-4 col-md-offset-4">
                
                <div class="login-panel panel panel-default">
                    <center><h3><a href="index.php">Tenis de Mesa Acre - v1.0</a></h3></center>
                    <div class="panel-heading">
                        <h3 class="panel-title">Cadastro de Atleta</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="../controller/processaCadastro.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input class="form-control" placeholder="Nome Completo" name="p[nome]" type="text" autofocus required>                                  
                                </div>
                                <div class="form-group">
                                    <label>Data de Nascimento</label>
                                    <input class="form-control" placeholder="Data de Nascimento" name="p[data_nascimento]" type="date" required>                                  
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input class="form-control" placeholder="E-mail" name="p[email]" type="email" required>
                                </div>
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <input class="form-control" placeholder="Telefone" name="p[telefone]" type="text" required>
                                </div>
                                <div class="form-group">
                                    <label>Senha</label>
                                    <input class="form-control" placeholder="Senha" name="p[senha]" type="password" value="" required >
                                </div>
                                
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block">Enviar</button>
                                <input type="hidden" name="acao" value="Salvar" />
                            </fieldset>
                        </form>
                        <hr>
 <?php if($_REQUEST['erro']) { ?>
                        <div class="alert alert-danger">
                                <?= erro($_REQUEST['erro']) ?>
                            </div>
 <?php } ?>

                    </div>
                </div>
            </div>
        </div>
        
        <center>Desenvolvido por <a href="http://nsvb.info">NSVB Tecnologia - 2016</a></center>
        
    </div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
