<?php

class MunicipioService{

		private $conexao;
		private $municipio;

		public function __construct(Conexao $conexao, MunicipioModel $municipio){

			$this->conexao = $conexao->conectar();
			$this->municipio = $municipio;

		}

		public function recuperar(){

			$sql = "SELECT 
						id, 
						nome, 
						id_map, 
						populacao, 
						qtde_doses_recebidas, 
						qtde_doses_aplicadas, 
						FORMAT((qtde_doses_aplicadas * 100 / populacao),3) AS percentual_vacinada 
					FROM 
						municipios";
			$stmt = $this->conexao->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function getTotal(){

			$sql = "SELECT 
						REPLACE(FORMAT(SUM(populacao),0),',','.') AS total_populacao, 
						REPLACE(FORMAT(SUM(qtde_doses_recebidas),0),',','.') AS total_doses_recebidas, 
						REPLACE(FORMAT(SUM(qtde_doses_aplicadas),0),',','.') AS total_doses_aplicadas 
					FROM municipios";
			$stmt = $this->conexao->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

	}//end

?>