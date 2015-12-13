<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package        app.Controller
 * @link        http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
	/**
	 * @var array 扱うコンポーネントのリスト
	 */
	public $components = array(
		'DebugKit.Toolbar', //TODO:本番環境にアップロードする際にコメントアウトする
		'Flash',
		'MyFlash',
		'Date',
		'Auth' => array(
			'loginAction' => array(
				'controller' => 'Administrator',
				'action' => 'login'
			),
			'loginRedirect' => array(
				'controller' => 'EstateView',
				'action' => 'estateList'
			),
			'logoutAction' => array(
				'controller' => 'Administrator',
				'action' => 'logout'
			),
			'logoutRedirect' => array(
				'controller' => 'EstateView',
				'action' => 'estateList'
			),
			'authError' => '管理者としてログインする必要があります',
			'authenticate' => array(
				'Form' => array(
					'userModel' => 'Administrator',
					'passwordHasher' => 'Blowfish',
					'fields' => array(
						'username' => 'name',
						'password' => 'password'
					)
				)
			)
		)
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
		$this->set("loginUser",$this->Auth->user());
	}
}
