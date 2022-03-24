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

		public function tweet() {

			session_start();
			$id = $_SESSION['id'];
			$nome = $_SESSION['nome'];

			if($id != '' && $nome != '') {

				$tweet = Container::getModel('Tweet');

				$tweet->__set('tweet', $_POST['tweet']);

				$tweet->__set('id_usuario', $_SESSION['id']);

				$tweet->salvar();

				header('Location: /timeline');

			} else {
				header('Location: /?login=erro');
			}

		}

	}

?>