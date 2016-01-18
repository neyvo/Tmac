<?php



require 'email/config.php';



$titulo = "MelhordoAcre.com.br";



function erro($id_erro){
    
    
    $msg = "";
    
    if($id_erro == '1')
    {
        $msg = "Usuário/Senha inválido";
    }    
        
        
    return $msg;
    
}


function dia($data) {

	$ano =  substr("$data", 0, 4);

	$mes =  substr("$data", 5, -3);

	$dia =  substr("$data", 8, 9);
	
	return $dia;
}

function add_date($mask,$givendate,$day=0,$mth=0,$yr=0) {
      $cd = strtotime($givendate);
      $newdate = date($mask, mktime(date('h',$cd),
    date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
    date('d',$cd)+$day, date('Y',$cd)+$yr));
      return $newdate;
              }


function mes($data) {



	$mes =  substr("$data", 5, -3);

	switch($mes) {

		case"1": $mes = "Janeiro"; break;

		case"2": $mes = "Fevereiro";   break;

		case"3": $mes = "Março";  break;

		case"4": $mes = "Abril";  break;

		case"5": $mes = "Maio";   break;

		case"6": $mes = "Junho";    break;
		
		case"7": $mes = "Julho"; break;

		case"8": $mes = "Agosto";   break;

		case"9": $mes = "Setembro";  break;

		case"10": $mes = "Outubro";  break;

		case"11": $mes = "Novembro";   break;

		case"12": $mes = "Dezembro";    break;

	}
	
	return $mes;
}



function dinheiro($valor){

	return number_format($valor, 2, ',', '.');	

}





function enviarEmail($assunto,$msg, $deEmail, $deNome, $paraEmail,$paraNome){

	

	sendMail($assunto,$msg,$deEmail,$deNome,$paraEmail,$paraNome);

}



function hoje($f){

	return date($f);	

}


function segundaSexta($data) {

	$ano =  substr("$data", 0, 4);

	$mes =  substr("$data", 5, -3);

	$dia =  substr("$data", 8, 9);



	$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );
	
	$resultado = false;



	switch($diasemana) {

		case"0": $resultado = false;       break;

		case"1": $resultado = true; break;

		case"2": $resultado = true;   break;

		case"3": $resultado = true;  break;

		case"4": $resultado = true;  break;

		case"5": $resultado = true;   break;

		case"6": $resultado = false;        break;

	}



	return $resultado;

}

function verificadiasemana($data,$k) {

	$ano =  substr("$data", 0, 4);

	$mes =  substr("$data", 5, -3);

	$dia =  substr("$data", 8, 9);



	$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );
	$resultado = false;

	if($diasemana == $k){
	
		$resultado = true;
	}
	else{
		$resultado = false;
	
	}

	return $resultado;

}


function diasemana($data) {

	$ano =  substr("$data", 0, 4);

	$mes =  substr("$data", 5, -3);

	$dia =  substr("$data", 8, 9);



	$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );



	switch($diasemana) {

		case"0": $diasemana = "Domingo";       break;

		case"1": $diasemana = "Segunda-Feira"; break;

		case"2": $diasemana = "Terça-Feira";   break;

		case"3": $diasemana = "Quarta-Feira";  break;

		case"4": $diasemana = "Quinta-Feira";  break;

		case"5": $diasemana = "Sexta-Feira";   break;

		case"6": $diasemana = "Sabado";        break;

	}



	return $diasemana;

}



function formataDataRSS($data){

	

		$mes = substr($data,5,2);

		$dia = substr($data,8,2);

		$ano = substr($data,0,4);

		$hora = substr($data,11,2);

		$minuto = substr($data,14,2);

		$segundo = substr($data,17,2);

		

		return date(DATE_RSS,mktime($hora,$minuto,$segundo,$mes,$dia,$ano));

	

	}

function formataDataHora($data){

	

		$mes = substr($data,5,2);

		$dia = substr($data,8,2);

		$ano = substr($data,0,4);

		$hora = substr($data,11,2);

		$minuto = substr($data,14,2);

		$segundo = substr($data,17,2);

		if($data == '')

			return "";

		

		return $dia.'/'.$mes.'/'.$ano.' '.$hora.':'.$minuto.':'.$segundo;

	

	}

	function formataData($data){

	

		$mes = substr($data,5,2);

		$dia = substr($data,8,2);

		$ano = substr($data,0,4);

		if($data == '')

			return "";

		

		return $dia.'/'.$mes.'/'.$ano;

	

	}



function convertDataHoraPData($data){

	

		$mes = substr($data,5,2);

		$dia = substr($data,8,2);

		$ano = substr($data,0,4);

		$hora = substr($data,11,2);

		$minuto = substr($data,14,2);

		$segundo = substr($data,17,2);

		if($data == '')

			return "";

		return $dia.'/'.$mes.'/'.$ano;

	

	}

function convertDataHoraPHora($data){

	

		$mes = substr($data,5,2);

		$dia = substr($data,8,2);

		$ano = substr($data,0,4);

		$hora = substr($data,11,2);

		$minuto = substr($data,14,2);

		$segundo = substr($data,17,2);

		if($data == '')

			return "";

		return $hora;

	

	}

function convertDataHoraPMinuto($data){

	

		$mes = substr($data,5,2);

		$dia = substr($data,8,2);

		$ano = substr($data,0,4);

		$hora = substr($data,11,2);

		$minuto = substr($data,14,2);

		$segundo = substr($data,17,2);

		if($data == '')

			return "";

		return $minuto;

	

	}





function convertDataHoraMysql($data,$hora,$minuto){

	

		$mes = substr($data,3,2);

		$dia = substr($data,0,2);

		$ano = substr($data,6,4);

		

		if($data == '')

			return "";

		return $ano.'-'.$mes.'-'.$dia.' '.$hora.':'.$minuto.':00';

	

	}

function convertDataMysql($data){

	

		$mes = substr($data,3,2);

		$dia = substr($data,0,2);

		$ano = substr($data,6,4);

		

		if($data == '')

			return "";

		return $ano.'-'.$mes.'-'.$dia;

	

	}

function convertDataPostgreSQL($data){

	

		$mes = substr($data,3,2);

		$dia = substr($data,0,2);

		$ano = substr($data,6,4);

		

		if($data == '')

			return "";

		return $ano.'-'.$mes.'-'.$dia;

	

	}

	

function exportCSV($list){



//	$list = array (	'1,Neyvo,Java'	);

	if($list == "")

		return;

	$fp = fopen('export.csv','w');

		

	foreach($list as $line){

		fputcsv($fp,split(',',$line),';');

	}

	fclose($fp);

	

	



}

function exportSQL($list){



//	$list = array (	'1,Neyvo,Java'	);



	$fp = fopen('export.sql','w');

	fwrite($fp,$list);

	fclose($fp);

	

	



}

function exportPresencaSQL($list){



//	$list = array (	'1,Neyvo,Java'	);



	$fp = fopen('exportPresenca.sql','w');

	fwrite($fp,"insert into presenca(id,matricula,nome,evento,periodo,local) values ");

		

	foreach($list as $line){

		fwrite($fp,"(");

		fwrite($fp,$line);

		fwrite($fp,"),");

	}

	fwrite($fp,";");

	fclose($fp);

	

	



}	

   function stdToArray ($std) {  

        if(is_object($std)){  

            $arr = get_object_vars($std);  

        }else{  

            $arr = $std;  

        }  

      

       /* foreach($arr as $indice => $valor)  

        {  

           if(is_object($valor) || is_array($valor))  

           {  

               $arr[$indice] = objectToArray($valor);  

           }  

       } */ 

     

       return $arr;  

   }  



      function objectToArray ($object) {

        $arr = array();

         for ($i = 0; $i < count($object); $i++) {

         $arr[] = get_object_vars($object[$i]);

         }

         return $arr;

      }

	function mostraCPF($cpf){

		if($cpf == '')

			return "";

		$cpf2 = substr($cpf,0,3) .".".substr($cpf,3,3).".".substr($cpf,6,3)."-".substr($cpf,9,2);

		

		return $cpf2;

	

	}

	

	function validaCPF($cpf){

		

		if(strlen($cpf)>11)

			return false;

			

		$nulos = array("12345678909","11111111111","22222222222","33333333333",

               "44444444444","55555555555","66666666666","77777777777",

               "88888888888","99999999999","00000000000");

		

		/* Retira todos os caracteres que nao sejam 0-9 */

		$cpf = ereg_replace("[^0-9]", "", $cpf);

		

		/*Retorna falso se houver letras no cpf */

		if (!(ereg("[0-9]",$cpf)))

			return false;

		

		/* Retorna falso se o cpf for nulo */

		if( in_array($cpf, $nulos) )

			return false;

		

		/*Calcula o penúltimo dígito verificador*/

		$acum=0;

		for($i=0; $i<9; $i++) {

		  $acum+= $cpf[$i]*(10-$i);

		}

		

		$x=$acum % 11;

		$acum = ($x>1) ? (11 - $x) : 0;

		/* Retorna falso se o digito calculado eh diferente do passado na string */

		if ($acum != $cpf[9]){

		  return false;

		}

		/*Calcula o último dígito verificador*/

		$acum=0;

		for ($i=0; $i<10; $i++){

		  $acum+= $cpf[$i]*(11-$i);

		}  

		

		$x=$acum % 11;

		$acum = ($x > 1) ? (11-$x) : 0;

		/* Retorna falso se o digito calculado eh diferente do passado na string */

		if ( $acum != $cpf[10]){

		  return false;

		}  

		/* Retorna verdadeiro se o cpf eh valido */

		return true;

	}



?>