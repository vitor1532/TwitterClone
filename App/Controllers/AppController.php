<?php

	namespace App\Controllers;

	//recursos do miniFramework
	use MF\Controller\Action;
	use MF\Model\Container;

	class AppController extends Action {

		public function timeline() {

			$this->validaAutenticacao();

			//recuperação dos tweets
			$tweet = Container::getModel('Tweet');

			$tweet->__set('id_usuario', $_SESSION['id']);

			$tweets = $tweet->getAll();

			$this->view->tweets = $tweets;

			/*echo '<pre>';
			print_r($tweets);
			echo '</pre>';*/

			$this->render('timeline');

		}

		public function tweet() {

			$this->validaAutenticacao();

			$tweet = Container::getModel('Tweet');

			$tweet->__set('tweet', $_POST['tweet']);

			$tweet->__set('id_usuario', $_SESSION['id']);

			$tweet->salvar();

			header('Location: /timeline');

		}

		public function quem_seguir() {

			$this->validaAutenticacao();

			echo '<br><br><br><br><br><br>';

			$pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';

			echo 'Pesquisando por: '.$pesquisarPor;

			if($pesquisarPor != '') {

				$usuario = Container::getModel('Usuario');

				$usuario->__set('nome', $pesquisarPor);
				$usuarios = $usuario->getAll();

				echo '<pre>';
				print_r($usuarios);
				echo '</pre>';

			}

			$this->render('quemSeguir');

		}

		public function validaAutenticacao() {

			session_start();

			$id = $_SESSION['id'];
			$nome = $_SESSION['nome'];

			if(!isset($id) || $id == '' || !isset($nome) || $nome == '') {
				header('Location: /?login=erro');
			}

		}

	}

?>