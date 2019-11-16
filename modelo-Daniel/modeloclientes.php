<?php
	require_once("modeloAbstractoDB.php");
	class clientes extends ModeloAbstractoDB {
        private $customer_id;
        private $store_id;
		private $first_name;
        private $last_name;
        private $email;
		private $address_id;
        private $active;
        private $create_date;
		private $last_update;				

		function __construct() {
			//$this->db_name = '';
		}
       
    	public function getcustomer_id(){
            return $this->customer_id;
		}        
    	public function getstore_id(){
            return $this->store_id;
		}		
		public function getfirst_name(){
			return $this->first_name;
		}
		public function getlast_name(){
            return $this->last_name;
		}        
    	public function getemail(){
            return $this->email;
		}		
		public function getaddress_id(){
			return $this->address_id;
		}		
		public function getactive(){
            return $this->active;
		}        
    	public function getcreate_date(){
            return $this->create_date;
		}		
		public function getlast_update(){
			return $this->last_update;
		}		

		public function consultar($customer_id='') {
			if($customer_id !=''):
				$this->query = "
				SELECT customer_id, store_id, first_name, last_name, email, address_id, active, create_date, last_update
				FROM customer 
				WHERE customer_id = '$customer_id'
				order by customer_id
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
			SELECT customer_id, store_id, first_name, last_name, email, address_id, active, create_date, last_update
			FROM customer
			order by customer_id
			";			
			$this->obtener_resultados_query();
			return $this->rows;			
		}

		public function listaclientes() {
			$this->query = "
			SELECT first_name
			FROM customer 
			order by first_name
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		
		public function nuevo($datos=array()) {
			if(array_key_exists('customer_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
					INSERT INTO customer 
					(customer_id, store_id, first_name, last_name, email, address_id, active, create_date, last_update)
					VALUES
					(NULL, '$store_id', '$first_name', '$last_name', '$email', '$address_id', '$active', NOW(), NOW())
					";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}
		
		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;			
			$last_name= utf8_decode($last_name);
			$email= utf8_decode($email);
			$this->query = "
			UPDATE customer
			SET store_id = '$store_id', 
			first_name = '$first_name', 
			last_name = '$last_name', 
			email = '$email', 
			address_id = '$address_id', 
			active = '$active'
			WHERE customer_id = '$customer_id' 
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($customer_id='') {
			$this->query = "
			DELETE FROM customer 
			WHERE  customer_id = '$customer_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>