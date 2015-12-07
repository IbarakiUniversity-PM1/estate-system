<?php

class AdministratorController extends AppController
{
	/**
	 * @var array 扱う根本的のリスト
	 */
	public $components = array('Session', 'Auth');

	/**
	 * アクションの前処理
	 */
	public function beforeFilter()
	{
		parent::beforeFilter();

		//未ログインでアクセスできるアクションを指定
		$this->Auth->allow('register', 'login');
	}

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
				$this->redirect(
					array(
						'controller' => 'EstateView',
						'action' => 'estateList'
					)
				);
			} else {
				$this->Flash->set('ログインに失敗しました。');
			}
		}
		//タイトルをセットする
		$this->set("title_for_layout", "ログイン");
	}
}
