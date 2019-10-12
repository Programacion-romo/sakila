<?php
	require_once("../modeloAbstractoDB.php");
	class tiendas extends ModeloAbstractoDB {
        private $store_id;
        private $manager_staff_id;
        private $address_id;
		private $last_update;
		//private $city_id;

	function __construct() {
			//$this->db_name = '';
	}
       
    public function getStore_id()
        {
                return $this->store_id;
        }
 
    public function getManager_staff_id()
        {
                return $this->manager_staff_id;
        }

    public function getAddress_id()
        {
                return $this->Address_id;
        }
		
	public function getLast_update()
		{
			return $this->last_update;
		}

	/*public function getCity_id()
        {
                return $this->city_id;
        }*/


		public function consultar($store_id='') {
			if($store_id !=''):
				$this->query = "
				SELECT store_id, manager_staff_id, address_id, last_update
				FROM store
				WHERE store_id = '$store_id' order by store_id
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
            SELECT us.store_id, 
                    up.first_name, 
                    up.last_name,
                    td.address,
                    t.city,
                    us.last_update
                    FROM store as us 
                    inner join staff as up 
                    ON (us.manager_staff_id = up.staff_id)
                    inner join address as td
					ON (us.address_id = td.address_id)
					inner join city as t
       				ON (td.city_id = t.city_id)
					order by us.store_id 
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}
		
		public function nuevo($datos=array()) {
			if(array_key_exists('store_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;

				$manager_staff_id= utf8_decode($manager_staff_id);
				//$last_name= utf8_decode($last_name);
				$this->query = "
					INSERT INTO store 
					(store_id, manager_staff_id, address_id, last_update)
					VALUES
					(NULL, '$manager_staff_id', '$address_id', NULL)
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