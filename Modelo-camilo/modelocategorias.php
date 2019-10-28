<?php
    require_once("modeloAbstractoDB.php");
	
    class categorias extends ModeloAbstractoDB {
		private $category_id;
		private $name;
		private $last_update;
		
		function __construct() {
			//$this->db_name = '';
		}

		public function getCategory_id(){
			return $this->category_id;
		}

		public function getname(){
			return $this->name;
		}
		
		public function getlast_update(){
			return $this->last_update;
		}

		public function consultar($category_id='') {
			if($category_id !=''):
				$this->query = "
				SELECT category_id, name, last_update
				FROM category
				WHERE category_id = '$category_id' order by category_id
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		public function lista() {
			$this->query = "
			SELECT category_id, name, last_update
			FROM category 
			WHERE category_id  order by category_id
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}
		
		public function nuevo($datos=array()) {
			if(array_key_exists('category_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$name= utf8_decode($name);
				$this->query = "
					INSERT INTO category
					(category_id, name, last_update)
					VALUES
					(NULL, '$name',null)
					";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}
		
		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$name= utf8_decode($name);
			$this->query = "
			UPDATE category
			SET name='$name'
			WHERE category_id = '$category_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($category_id='') {
			$this->query = "
			DELETE FROM category
			WHERE category_id = '$category_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>