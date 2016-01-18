<?php 

class DB {
	
	
	
	public static function conexao(){
		$conn = pg_connect("host='localhost' port=5432 dbname='nsvbinfo_evsdb' user='nsvbinfo_uevs' password='sucesso@2015'");	
		
		return $conn;
	}
	
	public static function total($tabela){

		$conn = DB::conexao();
		
		$SQL = "select count(*) as total from ".$tabela." where excluido = 'N' and ativo = 'S' ";
		
		$SQL = pg_query($conn, $SQL) or die(pg_last_error($conn));	
		
		
		$r = pg_fetch_array($SQL);
		return $r["total"];
		
	}
	
	public static function totalAgenda($id_agenda){

		$conn = DB::conexao();
		
		$SQL = "select count(*) as total from pessoa where id_agenda = ".$id_agenda." and excluido = 'N' and ativo = 'S' ";
		
		$SQL = pg_query($conn, $SQL) or die(pg_last_error($conn));	
		
		
		$r = pg_fetch_array($SQL);
		return $r["total"];
		
	}
		public static function procurarTitular($valor){
		
		$conn = DB::conexao();
		$SQL = "SELECT * FROM pessoa where tipo = 'PROFISSIONAL' and excluido = 'N' and id_agenda = '".$valor."' ";
		$SQL = pg_query($conn, $SQL) or die(pg_last_error($conn));	
		
		
		$r = pg_fetch_array($SQL);
		return $r;
	}
	
	
	public static function procurar($tabela,$id){
		
		$conn = DB::conexao();
		$SQL = "SELECT * FROM ".$tabela." where id = $id ";
		$SQL = pg_query($conn, $SQL) or die(pg_last_error($conn));	
		
		
		$r = pg_fetch_array($SQL);
		return $r;
	}
	public static function procurarTV($tabela,$id){
		
		$conn = DB::conexao();
		$SQL = "SELECT * FROM ".$tabela." where id = $id and tv = 'S' ";
		$SQL = pg_query($conn, $SQL) or die(pg_last_error($conn));	
		
		
		$r = pg_fetch_array($SQL);
		
		
		if(DB::procurarPeloCampo("pedido","id_situacao",$id))		
			return $r;
		else
			return "";
	}
	public static function procurarPeloCampo($tabela,$campo,$valor){
		
		$conn = DB::conexao();
		$SQL = "SELECT * FROM ".$tabela." where ".$campo." = '".$valor."' ";
		$SQL = pg_query($conn, $SQL) or die(pg_last_error($conn));	
		
		
		$r = pg_fetch_array($SQL);
		return $r;
	}
	
	public static function salvar($tabela,$param){

		$conn = DB::conexao();
		
		if($param){
			$keys = array_keys($param);			
			//return $param;
			$and = 0;
			$campos = " ";
			foreach($keys as $k){
				if($param[$k] == "")
					continue;				
				if($and == 1)
					$campos .= ", ";
				$and = 1;
				$campos .= $k."";	
			
			}
			$keys = array_keys($param);			
			//return $param;
			$and = 0;
			$valores = " ";
			foreach($keys as $k){
				if($param[$k] == "")
					continue;
				if($and == 1)
					$valores .= ", ";
				$and = 1;
				$valores .= "'".$param[$k]."'";	
			
			}
		
		}		
		$SQL = "insert into ".$tabela." (".$campos.") values (".$valores.")";
		
		pg_query($conn, $SQL);
		
		return pg_last_error($conn);
		
	}
	public static function atualizar($tabela,$param,$id){

		$conn = DB::conexao();
		
		if($param){
			$keys = array_keys($param);			
			//return $param;
			$and = 0;
			$campos = " ";
			foreach($keys as $k){
				if($param[$k] == "")
					continue;	
				if($and == 1)
					$campos .= ", ";
				$and = 1;
				$campos .= $k." = '".$param[$k]."'";	
			
			}
		
		}		
		$SQL = "update ".$tabela." set ".$campos." where id = ".$id." ";
		
		//return $SQL;
		
		pg_query($conn, $SQL);
		
		return pg_last_notice($conn);
		
	}
	public static function excluir($tabela,$id){

		$conn = DB::conexao();
		
		$SQL = "delete from ".$tabela." where id = ".$id." ";
		
		//return $SQL;
		
		return pg_query($conn, $SQL);
		
	}
public static function listarSQL($SQL){

		$conn = DB::conexao();
		
		
		
		
		$SQL = pg_query($conn, $SQL);
		
		$i = 0;
		while($r = pg_fetch_array($SQL)){
			$lista[$i] = $r;
			$i++;
		}
		
		return $lista;
		
	
	}
	public static function listar($tabela,$param,$ordem){

		$conn = DB::conexao();
		
		if($param){
			$keys = array_keys($param);			
			//return $param;
			$and = 0;
			$extra = "where ";
			foreach($keys as $k){
				if($and == 1)
					$extra .= " and ";
				$and = 1;
				
				if($param[$k]['tipo'] == "between")
					$extra .= $k." ".$param[$k]['tipo']." '".$param[$k]['valor1']."' and '".$param[$k]['valor2']."' ";	
				else
					$extra .= $k." ".$param[$k]['tipo']." '".$param[$k]['valor']."' ";	
			
			}
		
		}		
		$SQL = "SELECT * FROM ".$tabela." ".$extra." ".$ordem;
		
		if($ordem == "debug")
			return $SQL;
		
		$SQL = pg_query($conn, $SQL);
		
		$i = 0;
		while($r = pg_fetch_array($SQL)){
			$lista[$i] = $r;
			$i++;
		}
		
		return $lista;
		
	
	}

	public static function listarBuscaMelhor($tabela,$param,$ordem){

		$conn = DB::conexao();
		
		if($param){
			$keys = array_keys($param);			
			//return $param;
			$and = 0;
			$extra = "where ";
			foreach($keys as $k){
				if($and == 1)
					$extra .= " or ";
				$and = 1;
				
				if($param[$k]['tipo'] == "between")
					$extra .= $k." ".$param[$k]['tipo']." '".$param[$k]['valor1']."' and '".$param[$k]['valor2']."' ";	
				else
					$extra .= $k." ".$param[$k]['tipo']." '".$param[$k]['valor']."' ";	
			
			}
		
		}		
		$SQL = "SELECT * FROM ".$tabela." ".$extra." and situacao = 'A' ".$ordem;
		
		if($ordem == "debug")
			return $SQL;
		
		$SQL = pg_query($conn, $SQL);
		
		$i = 0;
		while($r = pg_fetch_array($SQL)){
			$lista[$i] = $r;
			$i++;
		}
		
		return $lista;
		
	
	}
	
	public static function atualizar2($tabela,$param,$id){

		$conn = DB::conexao();
		
		if($param){
			$keys = array_keys($param);			
			//return $param;
			$and = 0;
			$campos = " ";
			foreach($keys as $k){
				if($and == 1)
					$campos .= ", ";
				$and = 1;
				$campos .= $k." = '".$param[$k]."'";	
			
			}
		
		}		
		$SQL = "insert into ".$tabela." set ".$campos." ".$id." ";
		//echo $SQL;
		//return $SQL;
		
		return pg_query($conn, $SQL);
		
	}
	
	public static function ultimoId($tabela){

		$conn = DB::conexao();
		$SQL = "SELECT id FROM ".$tabela." order BY id desc limit 1";
		$SQL = pg_query($conn, $SQL);
		
		$r = pg_fetch_array($SQL);
		return $r['id'];
		
	}
	
	public static function verificaPermissao($id_usuario, $permissao){
		  $conn = DB::conexao();
		  $SQL = "select * from loja p, usuario_loja up where up.id_loja = p.id and up.id_usuario = '$id_usuario' and p.id = '$permissao' ";			
		  $SQL = pg_query($conn, $SQL);
		  if(pg_num_rows($SQL) > 0){
				return true;  
			}else{
				return false;
			}
		  
		
	}
	public static function verificaSituacao($id_usuario, $permissao){
		  $conn = DB::conexao();
		  $SQL = "select * from usuario_situacao where id_usuario = '$id_usuario' and id_situacao = '$permissao' ";			
		  $SQL = pg_query($conn, $SQL);
		  if(pg_num_rows($SQL) > 0){
				return true;  
			}else{
				return false;
			}
		  
		
	}
	public static function verificaSituacaoEncaminhar($id_usuario, $permissao){
		  $conn = DB::conexao();
		  $SQL = "select * from usuario_situacao_enviar where id_usuario = '$id_usuario' and id_situacao = '$permissao' ";			
		  $SQL = pg_query($conn, $SQL);
		  if(pg_num_rows($SQL) > 0){
				return true;  
			}else{
				return false;
			}
		  
		
	}
	public static function listarPermissao($id_usuario){
		  $conn = DB::conexao();
		  $SQL ="SELECT p.nome from perfil p, usuario_perfil up	where p.id = up.id_perfil and up.id_usuario = ".$id_usuario; 
		  
		  $SQL = pg_query($conn, $SQL);
		
		$i = 0;
		$p="";
		while($r = pg_fetch_array($SQL)){
			$p = $p." ".$r['nome']." -";
		}
		
		return $p;		
	}
	public static function limpaUsuarioPerfil($id_usuario){
		  $conn = DB::conexao();
		  $SQL = "delete from usuario_loja where id_usuario = ".$id_usuario;			
		  $SQL = pg_query($conn, $SQL);
		  
		  return true;
		
	}
	
	public static function limpeza($tabela, $id_usuario){
		  $conn = DB::conexao();
		  $SQL = "delete from ".$tabela." where id_usuario = ".$id_usuario;			
		  $SQL = pg_query($conn, $SQL);
		  
		  return true;
		
	}
	

	
	public function verificaEditalUsuario($id_edital,$id_usuario){
		 $conn = DB::conexao();
		  $SQL = "select * from edital_usuario
where id_edital = '$id_edital' and id_usuario = '$id_usuario' ";			
		  
		  $SQL = pg_query($conn, $SQL);
		  if(pg_num_rows($SQL) > 0){
				return true;  
			}else{
				return false;
			}
		
	}
	
	public function verificaIntegridade($objeto,$campo,$valor){
		$conn = DB::conexao();
		$sql = "SELECT * from ".$objeto." where ".$campo." = ".$valor;
		
		
		$sql = pg_query($conn, $sql);
		  if(pg_num_rows($sql) > 0){
				return true;  
			}else{
				return false;
			}
		
	
	}
	
	
	public static function listarTipo($tabela, $campo){

		$conn = DB::conexao();
		
		$SQL = "SELECT distinct(".$campo.") as ".$campo." from ".$tabela." ";
		
		$SQL = pg_query($conn, $SQL);
		
		$i = 0;
		while($r = pg_fetch_array($SQL)){
			$lista[$i] = $r;
			$i++;
		}
		
		return $lista;
		
	}

	public static function listarTipoGrupo($tabela, $campo, $grupo){

		$conn = DB::conexao();
		
		$SQL = "SELECT distinct(".$campo.") as ".$campo." from ".$tabela." where grupo ilike '%".$grupo."%'  ";
		
		$SQL = pg_query($conn, $SQL);
		
		$i = 0;
		while($r = pg_fetch_array($SQL)){
			$lista[$i] = $r;
			$i++;
		}
		
		return $lista;
		
	}

	
	
	
	
	
	
	
	
}
?>