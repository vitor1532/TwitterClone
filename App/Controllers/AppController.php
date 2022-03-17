<?php

	namespace App\Controllers;

	//recursos do miniFramework
	use MF\Controller\Action;
	use MF\Model\Container;

	class AppController extends Action {

		public function timeline() {

			session_start();
			$id = $_SESSION['id'];
			$nome = $_SESSION['nome'];

			if($id != '' && $nome != '') {

				$this->render('timeline');

			} else {
				header('Location: /?login=erro');
			}


			

			

		}

	}

?>