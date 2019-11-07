<?php
    require_once("modeloAbstractoDB.php");
	
    class peliculas extends ModeloAbstractoDB {
		private $film_id;
		private $title;
		private $description;
		private $release_year;
		private $language_id;
		private $original_language_id;
		private $rental_duration;
		private $rental_rate;
		private $length;
		private $replacement_cost;
		private $rating;
		private $special_features;
		private $last_update;
		
		function __destruct() {
			//unset($this);
		}

		public function getFilm_id()
		{
				return $this->film_id;
		}
		public function getTitle()
		{
				return $this->title;
		}
		public function getDescription()
		{
				return $this->description;
		}
		public function getRelease_year()
		{
				return $this->release_year;
		}
		public function getLanguage_id()
		{
				return $this->language_id;
		}
		public function getOriginal_language_id()
		{
				return $this->original_language_id;
		}
		public function getRental_duration()
		{
				return $this->rental_duration;
		}
		public function getRental_rate()
		{
				return $this->rental_rate;
		}
		public function getLength()
		{
				return $this->length;
		}
		public function getReplacement_cost()
		{
				return $this->replacement_cost;
		}
		public function getRating()
		{
				return $this->rating;
		}
		public function getSpecial_features()
		{
				return $this->special_features;
		}
		public function getLast_update()
		{
				return $this->last_update;
		}

		public function consultar($film_id='') {
			if($film_id !=''):
				$this->query = "
				SELECT film_id, title, description, release_year,
				language_id, original_language_id, rental_duration,
				rental_rate, length, replacement_cost, rating,
				special_features, last_update
				FROM film
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
			SELECT film_id, title, description, release_year,
				c.language_id, co.name, c.original_language_id, rental_duration,
				rental_rate, length, replacement_cost, rating,
				special_features, c.last_update
				FROM film as c
				 inner join language as co on (c.language_id=co.language_id) 
                 order by film_id
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}
		public function listapeliculas() {
			$this->query = "
			SELECT film_id, title, description, release_year,
				language_id, original_language_id, rental_duration,
				rental_rate, length, replacement_cost, rating,
				special_features, last_update
				FROM film as c order by film_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		public function listapeliculas1() {
			$this->query = "
			SELECT film_id, title, description, release_year,
				language_id, original_language_id, rental_duration,
				rental_rate, length, replacement_cost, rating,
				special_features, last_update
				FROM film as c order by film_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		public function listapeliculas2() {
			$this->query = "
			SELECT film_id, title, description, release_year,
				language_id, original_language_id, rental_duration,
				rental_rate, length, replacement_cost, rating,
				special_features, last_update
				FROM film as c order by film_id
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		
		public function nuevo($datos=array()) {
			if(array_key_exists('film_id', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$title= utf8_decode($title);
				$this->query = "
					INSERT INTO film
					(film_id, title, description, release_year,
					language_id, original_language_id, rental_duration,
					rental_rate, length, replacement_cost, rating,
					special_features, last_update)
					VALUES
					(NULL, '$title',
					 '$description',
					 '$release_year',
					 '$language_id',
					  NULL,
					 '$rental_duration',
					 '$rental_rate',
					 '$length',
					 '$replacement_cost',
					 '$rating',
					 '$special_features',
					  NULL)
					";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}
		
		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$title= utf8_decode($title);
			$this->query = "
			UPDATE film
			SET title='$title',
			description='$description',
			release_year='$release_year',
			language_id='$language_id',
		
			rental_duration='$rental_duration',
			rental_rate='$rental_rate',
			length='$length',
			replacement_cost='$replacement_cost',
			
			last_update='$last_update'
			WHERE film_id = '$film_id'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($film_id='') {
			$this->query = "
			DELETE FROM film
			WHERE film_id = '$film_id'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		
	}
?>