<?php
	
	ob_start();
	@session_start();

	require_once('../model/DB.php'); 	
	require_once('../util/util.php'); 	
	require_once('../util/email/config.php');
	
	if($_REQUEST['acao'] == "Salvar")	
	{
		
		// novo pedido
		if(!$_REQUEST['id_pedido']){
			$p_pedido['id_loja']     = $_REQUEST['loja'];
			$p_pedido['id_situacao'] = "8";
			$p_pedido['id_usuario']  = $_REQUEST['p']['id_usuario'];
			
			DB::salvar("pedido",$p_pedido);				
			$pu['id_pedido'] = DB::ultimoId("pedido");
		}
		else {
		// add item - lista item
		
			$pu['id_pedido'] = $_REQUEST['id_pedido'];
		}
		$pu['id_item'] = $_REQUEST['p']['id_item'];	
		$pu['tamanho'] = $_REQUEST['p']['tamanho'];	
		$pu['quantidade'] = $_REQUEST['p']['quantidade'];	
		
		DB::salvar("lista_item",$pu);		
				
		
		header("location: ".$_REQUEST['pagina'].".php?id=".$pu['id_pedido']."&msg=".$msg."&".$_REQUEST['retorno']);	
	
	
	}
	
	///============================================
	// REMOVER PEDIDO - ITEM
	//==============================================
	
	if($_REQUEST['acao'] == "REMOVER")	
	{
		
		// novo pedido
		$pu['id_pedido'] = $_REQUEST['id_pedido'];
		
		DB::excluir("lista_item",$_REQUEST['id']);		
				
		
		header("location: ".$_REQUEST['pagina'].".php?id=".$pu['id_pedido']."&msg=".$msg."&".$_REQUEST['retorno']);	
	
	
	}
	
	// ============================================================
	// Enviar e-mail pedido pentente
	
	if($_REQUEST['acao'] == "PEDIDO_PENDENTE")	
	{
		
		// novo pedido
		if($_REQUEST['id_pedido']){
			
			$p_pedido['id_situacao'] = "1";
			
			DB::atualizar("pedido",$p_pedido, $_REQUEST['id_pedido']);				
					
			
		
		
		
		$pedido = DB::procurar("pedido",$_REQUEST['id_pedido']);
		
		$msg = "<table class='bordasimples' border='1' width='708'>
  <thead>
    <tr>
      <th width='118'><div align='left'>N&ordm; PEDIDO</div></th>
      <th width='293'><div align='left'>".$pedido['id']."
      </div></th>
      <th colspan='3'>&nbsp;</th>
      </tr>
    <tr>
      <th width='118'><div align='left'>DATA</div></th>
      <th width='293'><div align='left'>".formataDataHora($pedido['data'])." 
      </div></th>
      <th colspan='3'>&nbsp;</th>
      </tr>
    <tr>
      <th width='118'><div align='left'>SITUA&Ccedil;&Atilde;O</div></th>
      <th width='293'><div align='left'>PENDENTE</div></th>
      <th colspan='3'>&nbsp;</th>
      </tr>
    <tr>
      <th colspan='2'>ITEM</th>
      <th width='130'>TAMANHO</th>
      <th width='147'>QUANTIDADE</th>     
    </tr>
  </thead>";

	// listar
		
	$pn['id_pedido']['valor'] = $pedido['id'];
	$pn['id_pedido']['tipo'] = "=";
	
		
	$lista = DB::listar("lista_item",$pn,"order by id desc");
	
	
	foreach((array)$lista as $l_item){
	
	$item = DB::procurar("item",$l_item['id_item']);
	
	
  $msg .= "<tr>
    <td colspan='2'><div align='center'>".$item['nome']."</div></td>
    <td><div align='center'>". $l_item['tamanho']."</div></td>
    <td><div align='center'>". $l_item['quantidade']."</div></td>   
  </tr>";
	
	
	}
$msg .= "</table>";

		
		//echo $msg;
		
		$emailADM = DB::procurarPeloCampo("empresa","nivel","ADM");
		
		//echo "PEDIDO PENDENTE <br> ".$msg. " - <br> ".$_SESSION['email']." <br>".$_SESSION['nome']."<br>".$emailADM['email']."<br>".$emailADM['nome']."<hr>";	
		sendMail("PEDIDO PENDENTE",$msg, $_SESSION['email'],$_SESSION['nome'], $emailADM['email'], $emailADM['nome']);			
		//echo "<br>";
		//sendMail("PEDIDO PENDENTE",$msg, $_SESSION['email'],$_SESSION['nome'], "anuncie@melhordoacre.com.br", $emailADM['nome']);			
			//	echo "<br>";
		//sendMail("PEDIDO PENDENTE",$msg, $_SESSION['email'],$_SESSION['nome'], "neyvo@tjac.jus.br", $emailADM['nome']);			
		
		//echo("<hr>enviando e-mail para: ".$emailADM['email']);
		header("location: ".$_REQUEST['pagina'].".php?".$_REQUEST['retorno']);	
		
		}
	
	
	}

	
?>