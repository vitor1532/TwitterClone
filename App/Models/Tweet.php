<?php

	namespace App\Models;

	use MF\Model\Model;

	class Tweet extends Model {

		private $id;
		private $id_usuario;
		private $tweet;
		private $data;

		public function __get($attr) {

			return $this->$attr;

		}

		public function __set($attr, $valor) {

			$this->$attr = $valor;

		}

		//salvar
		public function salvar() {

			$query = "
				INSERT INTO
					tweets(id_usuario, tweet)
				VALUES
					(?, ?)
			";

			$stmt = $this->db->prepare($query);
			$stmt->bindValue(1, $this->__get('id_usuario'));
			$stmt->bindValue(2, $this->__get('tweet'));
			$stmt->execute();

			return $this;

		}


		//recuperar

	}


?>