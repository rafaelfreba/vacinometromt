<?php  
	
	//Classe de conexão
	class Conexao{
		
		private $host = "localhost";
		private $dbname = "mapa";
		private $user = "root";
		private $pass= "";
		

		public function conectar(){

			try{

				$conexao = new PDO("mysql:host=$this->host;dbname=$this->dbname","$this->user","$this->pass");
				
				$conexao->exec('set charset set utf8');

				return $conexao;   				

			}catch(PDOException $e){
				
				echo $e->getMessage();
				
				die("Erro de conexão ao SQL Server");

			}

		}//end conectar

	}//end Conexao 



?> 