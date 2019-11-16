<?php
	require_once("modeloAbstractoDB.php");
	class ciudades extends ModeloAbstractoDB {
        private $city_id;
        private $city;
        private $country_id;
        private $last_update;

	function __construct() {
			//$this->db_name = '';
	}
       
    public function getCity_id()
        {
                return $this->city_id;
        }
 
    public function getCity()
        {
                return $this->city;
        }

    public function getCountry_id()
        {
                return $this->country_id;
        }
		
	public function getLast_update()
		{
			return $this->last_update;
		}


		public function consultar($city_id='') {
			if($city_id !=''):
				$this->query = "
				SELECT city_id, city, country_id, last_update
				FROM city
				WHERE city_id = '$city_id' order by city_id
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
			SELECT c.city_id, city, m.country, c.last_update
            FROM city as c inner join country as m
            ON (c.country_id = m.country_id) order by city_id 
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}

		public function listaCiudad() {
			$this->query = "
			SELECT city_id, city
			FROM city as m order by city
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		
		public function nuevo($datos=array()) {
			if(array_key_exists('city_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;

				$city= utf8_decode($city);
				$this->query = "
					INSERT INTO city 
					(city_id, city, country_id, last_update)
					VALUES
					(NULL, '$city', '$country_id', NULL)
					";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}
		
		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$city= utf8_decode($city);
			$this->query = "
			UPDATE city
            SET city='$city',
            country_id='$country_id'
			WHERE city_id = '$city_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($city_id='') {
			$this->query = "
            DELETE FROM city 
            WHERE city_id = '$city_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}

	}
?>