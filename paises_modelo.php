<?php
	require_once("modeloAbstractoDB.php");
	class paises extends ModeloAbstractoDB {
        private $country_id;
        private $country;
		private $last_update;

	function __construct() {
			//$this->db_name = '';
	}
       
    public function getCountry_id()
        {
            return $this->country_id;
		}
        
    public function getCountry()
        {
                return $this->country;
		}
		
	public function getLast_update()
		{
			return $this->last_update;
		}


		public function consultar($country_id='') {
			if($country_id !=''):
				$this->query = "
				SELECT country_id, country, last_update
				FROM country
				WHERE country_id = '$country_id' order by country_id
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
			SELECT country_id, country, last_update
			FROM country 
			  order by country_id
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}

		public function listaPais() {
			$this->query = "
			SELECT country_id, country
			FROM country as m order by country
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}


		
		public function nuevo($datos=array()) {
			if(array_key_exists('country_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;

			//	$country= utf8_decode($country);
				$this->query = "
					INSERT INTO country 
					(country_id, country, last_update)
					VALUES
					(NULL, '$country', NULL)
					";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}
		
		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$country= utf8_decode($country);
			$this->query = "
			UPDATE country
			SET country='$country'
			WHERE country_id = '$country_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($country_id='') {
			$this->query = "
			DELETE FROM country WHERE  country_id = '$country_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>