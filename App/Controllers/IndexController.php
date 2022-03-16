<?php

	namespace App\Controllers;

	//recursos do miniFramework
	use MF\Controller\Action;
	use MF\Model\Container;

	//os models


    class IndexController extends Action {

        //public $caminho='../App/Views/index/';

		public function index() {

			
            $this->render('index');
		}

	}

?>