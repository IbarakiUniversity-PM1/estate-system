<?php

class AdministratorController extends AppController
{
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
				foreach ($this->Administrator->validationErrors as $k1 => $v1) {
					foreach ($v1 as $k2 => $v2) {
						foreach ($v2 as $v3) {
							$this->Flash->set($k1 . "." . $k2 . " : " . $v3);
						}
					}
				}
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
