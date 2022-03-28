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

			$usuario = Container::getModel('Usuario');
			$usuario->__set('id', $_SESSION['id']);

			$this->view->infoUser = $usuario->getInfoUser();
			$this->view->totalTweets = $usuario->getTotalTweets();
			$this->view->totalSeguindo = $usuario->getTotalSeguindo();
			$this->view->totalSeguidores = $usuario->getTotalSeguidores();

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

			$pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';

			$usuarios = [];

			if($pesquisarPor != '') {

				$usuario = Container::getModel('Usuario');

				$usuario->__set('nome', $pesquisarPor);
				$usuario->__set('id', $_SESSION['id']);
				$usuarios = $usuario->getAll();

			}

			$usuario = Container::getModel('Usuario');
			$usuario->__set('id', $_SESSION['id']); 

			$this->view->infoUser = $usuario->getInfoUser();
			$this->view->totalTweets = $usuario->getTotalTweets();
			$this->view->totalSeguindo = $usuario->getTotalSeguindo();
			$this->view->totalSeguidores = $usuario->getTotalSeguidores();

			$this->view->usuarios = $usuarios;

			$this->render('quemSeguir');

		}

		public function acao() {

			$this->validaAutenticacao();

			//acao
			$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

			//id_usuario (usuario que será seguido)
			$id_usuario_seguindo = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';

			$usuario = Container::getModel('Usuario');
			$usuario->__set('id', $id = $_SESSION['id']);

			if($acao == 'follow') {

				$usuario->followUser($id_usuario_seguindo);

			}else if ($acao == 'unfollow') {
				$usuario->unfollowUser($id_usuario_seguindo);
			}

			header('Location: /quem_seguir');

		}

		public function removerTweet() {
			
			$this->validaAutenticacao();

			$id = isset($_GET['id']) ? $_GET['id'] : '';

			$tweet = Container::getModel('Tweet');

			$tweet->__set('id', $id);

			$tweet->remover();

			header('Location: /timeline');

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