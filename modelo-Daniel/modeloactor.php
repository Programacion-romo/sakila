<?php
	require_once("modeloAbstractoDB.php");
	class Actor extends ModeloAbstractoDB {
        private $actor_id;
		private $first_name;
        private $last_name;
		private $last_update;				

	function __construct() {
			//$this->db_name = '';
	}
       
    public function getactor_id()
        {
            return $this->actor_id;
		}
		
	public function getfirst_name()
		{
			return $this->first_name;
		}

		public function getlast_name()
        {
            return $this->last_name;
		}
		
	public function getlast_update()
		{
			return $this->last_update;
		}		

		public function consultar($actor_id='') {
			if($actor_id !=''):
				$this->query = "
				SELECT actor_id, first_name, last_name, last_update
				FROM actor
				WHERE actor_id = '$actor_id'
				order by actor_id
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
			SELECT actor_id, first_name, last_name, last_update
			FROM actor 
			order by actor_id
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}
		
		public function nuevo($datos=array()) {
			if(array_key_exists('actor_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;

			//	$first_name= utf8_decode($first_name);
				$this->query = "
					INSERT INTO actor 
					(actor_id, first_name, last_name, last_update)
					VALUES
					(NULL, '$first_name', '$last_name', NOW())
					";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}
		
		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			/*$first_name= utf8_decode($first_name);
			$last_name= utf8_decode($last_name);*/
			$this->query = "
			UPDATE actor
			SET first_name = '$first_name', 
			last_name = '$last_name', 
			last_update = NOW()
			WHERE actor_id = '$actor_id' 
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($actor_id='') {
			$this->query = "
			DELETE FROM actor WHERE  actor_id = '$actor_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>