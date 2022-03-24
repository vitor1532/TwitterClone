<?php

	namespace App\Controllers;

	//recursos do miniFramework
	use MF\Controller\Action;
	use MF\Model\Container;

	//os models


    class IndexController extends Action {

        //public $caminho='../App/Views/index/';

		public function index() {

			$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
			
            $this->render('index');
		}

		public function inscreverse() {

			$this->view->usuario = [
					'nome' => '',
					'email' => '',
					'senha' => ''
				];

			$this->view->erroCadastro = false;

			$this->render('inscreverse');

		}

		public function registrar() {


			//receber os dados do formulário
			$usuario = Container::getModel('Usuario');

			$usuario->__set('nome', $_POST['nome']);
			$usuario->__set('email', $_POST['email']);
			$usuario->__set('senha', md5($_POST['senha']));



			//salvar no db a partir da instancia de $usuario
			if($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail()) == 0) {

				$usuario->salvar();

				$this->render('cadastro');

			}else {

				$this->view->usuario = [
					'nome' => $_POST['nome'],
					'email' => $_POST['email'],
					'senha' => $_POST['senha']
				];

				$this->view->erroCadastro = true;
				
				$this->render('inscreverse');

			}
			


			//echo '<pre>';
			//print_r($usuario);
			//echo '</pre>';


			//sucesso
			//$this->render('registrar');
			//erro

		}

	}

?>