<?php

	namespace App\Models;

	use MF\Model\Model;

	class Contato extends Model {

		public function getContatos() {
			
			$query = "select nome, email, telefone
				from tb_contatos
			";
			return $this->db->query($query)->fetchAll();
		}
	}

?>