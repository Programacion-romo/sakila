<?php
	require_once("modeloAbstractoDB.php");
	class direcciones extends ModeloAbstractoDB {
        private $address_id;
        private $address;
        private $address2;
        private $district;
        private $city_id;
        private $postal_code;
        private $phone;
        private $last_update;

	function __construct() {
			//$this->db_name = '';
	}
       
    
    public function getAddress_id(){
                return $this->address_id;
    }

    public function getAddress(){
                return $this->address;
    }

    public function getAddress2(){
                return $this->address2;
    }

    public function getDistrict(){
                return $this->district;
    }

    public function getCity_id(){
                return $this->city_id;
    }

    public function getPostal_code(){
                return $this->postal_code;
    }
   
    public function getPhone(){
                return $this->phone;
    }

    public function getLast_update(){
                return $this->last_update;
    }

    


		public function consultar($address_id='') {
			if($address_id !=''):
				$this->query = "
				SELECT address_id, address, address2, district, city_id, postal_code, phone, last_update
				FROM address
				WHERE address_id = '$address_id' order by address_id
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
            SELECT c.address_id, c.address, c.address2, c.district, m.city, c.postal_code, c.phone, c.last_update
			FROM address as c inner join city as m
            ON (c.city_id = m.city_id) order by address_id 
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}

		public function listaDireccion() {
			$this->query = "
			SELECT address_id, address
			FROM address as m order by address
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		
		public function nuevo($datos=array()) {
			if(array_key_exists('address_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;

				$address= utf8_decode($address);
				//$address2= utf8_decode($address2);
				//$district= utf8_decode($district);
				$this->query = "
					INSERT INTO address 
					(address_id, address, address2, district, city_id, postal_code, phone, last_update)
					VALUES
					(NULL, '$address', '$address2','$district','$city_id','$postal_code','$phone', NULL)
					";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}
		
		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$address= utf8_decode($address);
			$this->query = "
			UPDATE address
            SET address='$address',
            address2='$address2',
            district='$district',
            city_id='$city_id',
            postal_code='$postal_code',
            phone='$phone'
			WHERE address_id = '$address_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($address_id='') {
			$this->query = "
            DELETE FROM address 
            WHERE address_id = '$address_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}

           
	}
?>