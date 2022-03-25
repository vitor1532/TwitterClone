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

		public function remover() {

			$query = "
				DELETE FROM
					tweets
				WHERE
					id = ?
			";

			$stmt = $this->db->prepare($query);
			$stmt->bindValue(1, $this->__get('id'));
			$stmt->execute();
			return true;

		}


		//recuperar
		public function getAll() {

			$query = "
				SELECT
					t.id, 
					t.id_usuario, 
					u.nome, 
					t.tweet, 
					DATE_FORMAT(t.data, '%d/%m/%Y %H:%i') AS data
				FROM 
					tweets AS t
						LEFT JOIN 
							usuarios AS u ON (t.id_usuario = u.id)
				WHERE 
					t.id_usuario = :id_usuario
						OR 
					t.id_usuario 
						IN 
							(
								SELECT
									id_usuario_seguindo
								FROM
									usuarios_seguidores
								WHERE
									id_usuario = :id_usuario
							)
				ORDER BY
					t.data DESC
			";

			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
			$stmt->execute();

			return $stmt->fetchAll(\PDO::FETCH_ASSOC);

		}

	}


?>