<?php

	namespace App\Controllers;

	//recursos do miniFramework
	use MF\Controller\Action;
	use MF\Model\Container;

	//os models
	use App\Models\Produto;
	use App\Models\Info;
	use App\Models\Contato;

    class IndexController extends Action {

        //public $caminho='../App/Views/index/';

		public function index() {

			$produto = Container::getModel('Produto');

			$produtos = $produto->getProdutos();

			$this->view->dados = $produtos;

            //require_once $this->caminho.'index.phtml';
            $this->render('index', 'layout1');
		}

		public function sobreNos() {
            
            //instancia de conexão e model dinamica
			$info = Container::getModel('Info');

			$infos = $info->getInfo();

			$this->view->dados = $infos;
            $this->render('sobreNos', 'layout1');
		}

		public function contato() {
            
			//instancia de modelo e conexão
			$contato = Container::getModel('Contato');

			$contatos = $contato->getContatos();

			$this->view->dados = $contatos;
            $this->render('contato', 'layout2');
		}

		public function teste() {

			$produto = Container::getModel('Produto');

			$produtos = $produto->getProdutos();

			$this->view->dados = $produtos;

            //require_once $this->caminho.'index.phtml';
            $this->render('teste', 'layout1');

		}

	}

?>