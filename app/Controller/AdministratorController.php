<?php

class AdministratorController extends AppController
{
	/**
	 * 管理者登録
	 */
	public function register()
	{
		//管理者登録を有効にするかどうか
		$isEffective=false;
		if (($isEffective && $this->request->is('post')) || !$isEffective) {
			if($isEffective){
				$this->Administrator->create();
			}
			if (($isEffective && $this->Administrator->save($this->request->data)) || !$isEffective) {
				$this->redirect(array("action" => "login"));
			} else {
				$this->MyFlash->set_validation_error($this->Administrator->validationErrors);
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
				$loginUser=$this->Auth->user();
				$this->log("[ログイン成功] ".$loginUser["name"], 'login');
				$this->redirect($this->Auth->redirectUrl());
			}else{
				$this->log("[ログイン失敗] ".$this->request->data["Administrator"]["name"], 'login');
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
		$loginUser=$this->Auth->user();
		$this->log("[ログアウト成功] ".$loginUser["name"], 'logout');
		$this->redirect($this->Auth->logout());
	}
}
