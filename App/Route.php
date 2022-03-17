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

			$routes['inscreverSe'] = [
				'route' => '/inscreverse',
				'controller' => 'indexController',
				'action' => 'inscreverse'

			];

			$routes['registrar'] = [
				'route' => '/registrar',
				'controller' => 'indexController',
				'action' => 'registrar'

			];

			$routes['autenticar'] = [
				'route' => '/autenticar',
				'controller' => 'AuthController',
				'action' => 'autenticar'

			];

			$routes['sair'] = [
				'route' => '/sair',
				'controller' => 'AuthController',
				'action' => 'sair'

			];

			$routes['timeline'] = [
				'route' => '/timeline',
				'controller' => 'AppController',
				'action' => 'timeline'

			];
			
			$this->setRoutes($routes);

		}

	}

?>