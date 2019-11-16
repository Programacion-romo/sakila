<?php
	require_once("modeloAbstractoDB.php");
	class pagos extends ModeloAbstractoDB {
		private $payment_id;
		private $customer_id;
		private $staff_id;
		private $rental_id;
		private $amount;
        private $payment_date;
		private $last_update;				

	function __construct() {
			//$this->db_name = '';
	}
          
    public function getpayment_id()
		{
			return $this->payment_id;
		}

    public function getcustomer_id()
        {
            return $this->customer_id;
		}

    public function getstaff_id()
        {
            return $this->staff_id;
		}
		   
	public function getrental_id()
        {
            return $this->rental_id;
		}
		
	public function getamount()
		{
			return $this->amount;
		}

	public function getpayment_date()
        {
            return $this->payment_date;
		}
		
	public function getlast_update()
		{
			return $this->last_update;
		}	

	public function consultar($payment_id='') {
			if($payment_id !=''):
				$this->query = "
				SELECT payment_id, customer_id, staff_id, rental_id, amount, payment_date, last_update
				FROM payment
				WHERE payment_id = '$payment_id'
				order by payment_id
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
			SELECT p.payment_id, c.customer_id, s.staff_id, r.rental_id, p.amount, p.payment_date, p.last_update
			FROM payment as p 
			inner join customer as c ON (p.customer_id = c.customer_id) 
			inner join staff as s ON (p.staff_id = s.staff_id) 
			inner join rental as r ON (p.rental_id = r.rental_id) 
			order by payment_id
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}
		
		public function nuevo($datos=array()) {
			if(array_key_exists('payment_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
					INSERT INTO payment 
					(payment_id, customer_id, staff_id, rental_id, amount, payment_date, last_update)
					VALUES
					(NULL, '$customer_id', '$staff_id', '$rental_id', '$amount', '$payment_date', NOW())
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
			UPDATE payment
			SET staff_id = '$staff_id', 
			rental_id = '$rental_id', 
			amount = '$amount', 
			payment_date = '$payment_date', 
			last_update = NOW()
			WHERE payment_id = '$payment_id' 
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($payment_id='') {
			$this->query = "
			DELETE FROM payment 
			WHERE  payment_id = '$payment_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>