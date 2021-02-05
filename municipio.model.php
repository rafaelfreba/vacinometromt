<?php
	
	class MunicipioModel{

		private $id;
		private $nome;
		private $id_map;
		private $populacao;
		private $qtde_doses_recebidas;
		private $qtde_doses_aplicadas;

		public function __get($atributo){
			return $this->$atributo;
		}

		public function __set($atributo, $valor){
			$this->$atributo = $valor;
		}

	}//class

?>