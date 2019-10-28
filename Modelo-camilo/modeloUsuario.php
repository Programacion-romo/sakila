<?php
    require_once("modeloAbstractoDB.php");
	
    class Usuario extends ModeloAbstractoDB {
        private $usua_codi;
        private $usua_user;
		private $usua_nomb;
		private $usua_foto;
        private $usua_pass;
        private $perso_cod;
		private $update_at;
		
		function __construct() {
			//$this->db_name = '';
		}

		public function getUsua_codi(){
			return $this->usua_codi;
		}

        
        public function getUsua_user(){
			return $this->usua_user;
		}

		public function getUsua_nomb(){
			return $this->usua_nomb;
		}

		public function getUsua_foto(){
			return $this->usua_foto;
		}
		
		public function getUsua_pass(){
			return $this->usua_pass;
        }
        
        public function getUdate_at(){
			return $this->update_at;
		}

		
		public function consultar($datos = array()) {
			
			$usuario = $datos['usuario'];
			$password = $datos['password'];
            $this->query = "
            SELECT usua_codi, usua_user, usua_pass, usua_nomb, usua_foto
			FROM tb_usuario 
			WHERE usua_user = '$usuario'
			";

            $this->obtener_resultados_query();
			
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		public function lista() {
			$this->query = "
			SELECT language_id, name, last_update
			FROM language 
			WHERE language_id  order by language_id
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}
        
        public function generarPassword($pass=""){
            $opciones = [
                'cost' => 12,
            ];
            
            $passwordHashed = password_hash($pass, PASSWORD_BCRYPT, $opciones);
            
            return $passwordHashed;
        }

		public function nuevo($datos=array()) {
			if(array_key_exists('usua_codi', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
                endforeach;
              
				$this->query = "
					INSERT INTO tb_usuario
					(usua_codi, usua_user, usua_nomb, usua_pass,perso_cod,update_at)
					VALUES
					(NULL, '$name', '$last_update',NOW())
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
			UPDATE language
			SET name='$name'
			WHERE language_id = '$language_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($language_id='') {
			$this->query = "
			DELETE FROM language
			WHERE language_id = '$language_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		function __destruct() {
			//unset($this);
		}
	}
?>