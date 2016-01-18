<?php 
class DB {
	public static function conexao(){
		//$conn = pg_connect("host='localhost' port=5432 dbname='neyvocom_agenda' user='neyvocom_user_agenda' password='agenda@2015'");	
                $conn = @mysql_connect('localhost', 'root', '');      
                mysql_select_db('neyvocom_tt', $conn);
		return $conn;
	}
        
        public static function fechaConexao($conn){
              mysql_close($conn);
        }


       
	
	public static function totalAgenda($id_agenda){

		$conn = DB::conexao();
		
		$SQL = "select count(*) as total from pessoa where id_agenda = ".$id_agenda." and excluido = 'N' and ativo = 'S' ";
		
		$SQL = mysql_query($SQL);	
		
		
		$r = mysql_fetch_array($SQL);
		return $r["total"];
		
	}
		public static function procurarTitular($valor){
		
		$conn = DB::conexao();
		$SQL = "SELECT * FROM pessoa where tipo = 'PROFISSIONAL' and excluido = 'N' and id_agenda = '".$valor."' ";
		$SQL = mysql_query($SQL);	
		
		
		$r = mysql_fetch_array($SQL);
		return $r;
	}
	
	
	public static function procurar($tabela,$id){
		
		$conn = DB::conexao();
		$SQL = "SELECT * FROM ".$tabela." where id = $id ";
		$SQL = mysql_query($SQL);
		
		
		$r = mysql_fetch_array($SQL);
		return $r;
	}
	
	public static function procurarPeloCampo($tabela,$campo,$valor){
		
		$conn = DB::conexao();
		$SQL = "SELECT * FROM ".$tabela." where ".$campo." = '".$valor."' ";
		$SQL = mysql_query($SQL);	
		
		
		$r = mysql_fetch_array($SQL);
		return $r;
	}
	
	public static function salvar($tabela,$param){

		$conn = DB::conexao();
		$campos = "";
                $valores = "";
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
		
		mysql_query($SQL);
		
                return $SQL;
		//return mysql_insert_id();
		
	}
	public static function atualizar($tabela,$param,$id){

		$conn = DB::conexao();
                $campos = "";
		
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
		
		$SQL = mysql_query($SQL);
		
		return $SQL;
		
	}
	public static function excluir($tabela,$id){

		$conn = DB::conexao();
		
		$SQL = "update ".$tabela." set excluido = 'S' where id = ".$id." ";
		
		//return $SQL;
		
		return mysql_query($SQL);
		
	}
	public static function listarSQL($SQL){

		$conn = DB::conexao();
							
		$SQL = mysql_query($SQL);
		
		$i = 0;
		while($r = mysql_fetch_array($SQL)){
			$lista[$i] = $r;
			$i++;
		}
		
		return $lista;
		
	
	}
	public static function listar($tabela,$param,$ordem){

		$conn = DB::conexao();
		$extra = "";
                $lista = "";
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
                else {
		
		$SQL = mysql_query($SQL);
		
		$i = 0;
		while($r = mysql_fetch_array($SQL)){
			$lista[$i] = $r;
			$i++;
		}
		
		return $lista;
                }
	
	}
	public static function ultimoId($tabela){

		$conn = DB::conexao();
		$SQL = "SELECT id FROM ".$tabela." order BY id desc limit 1";
		$SQL = pg_query($conn, $SQL);
		
		$r = pg_fetch_array($SQL);
		return $r['id'];
		
	}
}
?>