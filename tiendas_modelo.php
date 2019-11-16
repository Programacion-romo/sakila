<?php
	require_once("modeloAbstractoDB.php");
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
                return $this->address_id;
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
      CONCAT( up.first_name, ' ',
       up.last_name) AS Empleado,
       td.address,
       t.city,
       us.last_update
       From store as us
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
		
		public function listaTienda() {
			$this->query = "
			Select store_id 
				From store as c 
				Order by store_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		
		public function nuevo($datos=array()) {
			if(array_key_exists('store_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;

				$staff_id= utf8_decode($staff_id);
				//$last_name= utf8_decode($last_name);
				$this->query = "
					INSERT INTO store 
					(store_id, manager_staff_id, address_id, last_update)
					VALUES
					(NULL, '$staff_id', '$address_id', NULL)
					";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}
		
		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$this->query = "
			UPDATE store
            SET manager_staff_id='$staff_id',
			address_id='$address_id'
			WHERE store_id = '$store_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($store_id='') {
			$this->query = "
            DELETE FROM store 
            WHERE store_id = '$store_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}

	}
?>