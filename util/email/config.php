<?php
	function sendMail($assunto,$msg,$remetente,$nomeRemetente,$destino,$nomeDestino){
	require_once('class.phpmailer.php'); //Include pasta/classe do PHPMailer
	$mail = new PHPMailer(); //INICIA A CLASSE
	$mail->IsSMTP(); //Habilita envio SMPT
	$mail->SMTPAuth = true; //Ativa email autenticado
	$mail->SMTPDebug = true;
	$mail->Host = "mail.neyvo.in"; //Servidor de envio
	$mail->SMTP_PORT = "465"; //Porta de envio
	$mail->SMTPSecure = "TLS";
	
	$mail->Username = 'carteiro@neyvo.in'; //email para smtp autenticado
	$mail->Password = 'sedex2011'; //seleciona a porta de envio
	
	$mail->From = $remetente; //remtente
	$mail->FromName = $nomeRemetente; //remtetene nome
	$mail->IsHTML(true);
	$mail->Subject = $assunto; //assunto
	$mail->Body = $msg; //mensagem
	$mail->AddAddress($destino,$nomeDestino); //email e nome do destino
	if(!$mail->Send()){
	 return '<span>Erro ao enviar, favor entre em contato pelo e-mail anuncie@melhordoacre.com.br !</span>';
	}else{
	  return '<span  style="color: red;">Mensagem enviada com sucesso!</span>';
	  //header("location: / ");
	}
}?>