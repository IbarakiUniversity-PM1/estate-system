<?php

class AdministratorController extends AppController
{
	/**
	 * @var array 扱う根本的のリスト
	 */
	public $components = array(
		'Auth' => array(
			'loginAction' => array('action' => 'login'),
			'loginRedirect' => array(
				'controller' => 'EstateView',
				'action' => 'estateList'
			),
			'logoutAction' => array('action' => 'logout'),
			'logoutRedirect' => array(
				'controller' => 'EstateView',
				'action' => 'estateList'
			),
			'authError' => '管理者としてログインする必要があります',
			'authenticate' => array(
				'Form' => array(
					'userModel'=>'Administrator',
					'fields' => array(
						'username' => 'name',
						'password' => 'password'
					),
					'passwordHasher' => 'Blowfish'
				)
			)
		)
	);

	/**
	 * 管理者登録
	 */
	public function register()
	{
		if ($this->request->is('post')) {
			$this->Administrator->create();
			if ($this->Administrator->save($this->request->data)) {
				$this->redirect(array("action" => "login"));
			} else {
				debug($this->Estate->validationErrors);
			}
		}
		//タイトルをセットする
		$this->set("title_for_layout", "管理者登録");
	}

	/**
	 * ログイン
	 */
	public function login()
	{
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirectUrl());
			}else{
				$this->Flash->set('ユーザ名もしくはパスワードに誤りがあります');
			}
		}
		//タイトルをセットする
		$this->set("title_for_layout", "ログイン");
	}

	/**
	 * ログアウト
	 */
	public function logout() {
		$this->redirect($this->Auth->logout());
	}
}
