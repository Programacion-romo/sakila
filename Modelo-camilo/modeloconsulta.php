<?php
    require_once("modeloAbstractoDB.php");
	
    class consulta extends ModeloAbstractoDB {
		private $film_id;
		private $category_id;
		private $last_update;
		
		function __construct() {
			//$this->db_category_id = '';
		}

		public function getFilm_id(){
			return $this->film_id;
		}

		public function getCategory_id(){
			return $this->category_id;
		}
		
		public function getLast_update(){
			return $this->last_update;
		}

		public function consultar($film_id='') {
			if($film_id !=''):
				$this->query = "
				SELECT film_id,category_id,last_update
				FROM film_category
				WHERE film_id = '$film_id' order by film_id
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
			
SELECT m.film_id, y.title, x.name, i.store_id, j.address, h.city
FROM film_category as m
inner join film as y on (m.film_id=y.film_id) 
inner join category as x on (m.category_id=x.category_id)
inner join inventory as i on (m.film_id=i.film_id)
inner join store as k on (i.store_id=k.store_id)
inner join address as j on (k.address_id=j.address_id)
inner join city as h on (j.city_id=h.city_id)
	 order by title
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}
		public function nuevo($datos=array()) {
			if(array_key_exists('film_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$category_id= utf8_decode($category_id);
				$this->query = "
					INSERT INTO query
					(film_id, category_id, store_id)
					VALUES
					('$film_id', '$category_id',$store_id)
					";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}
		
		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$category_id= utf8_decode($category_id);
			$this->query = "
			UPDATE query
			SET film_id='$film_id',
			category_id='$category_id'
			store_id='$store_id'
			WHERE film_id = '$film_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($film_id='') {
			$this->query = "
			DELETE FROM query 
			WHERE film_id = '$film_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
    ?>