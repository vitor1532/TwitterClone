<?php

	namespace App;

    use MF\Init\Bootstrap;

	class Route extends Bootstrap {

		protected function initRoutes() {

			$routes['home'] = [
				'route' => '/',
				'controller' => 'indexController',
				'action' => 'index'
			];
			$routes['sobre_nos'] = [
				'route' => '/sobre_nos',
				'controller' => 'indexController',
				'action' => 'sobreNos'
			];
			$routes['contato'] = [
				'route' => '/contato',
				'controller' => 'indexController',
				'action' => 'contato'
			];
			$routes['teste'] = [
				'route' => '/teste',
				'controller' => 'indexController',
				'action' => 'teste'
			];

			$this->setRoutes($routes);

		}

	}

?>