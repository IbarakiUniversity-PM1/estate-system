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
	public function logout()
	{
		$loginUser=$this->Auth->user();
		$this->log("[ログアウト成功] ".$loginUser["name"], 'logout');
		$this->redirect($this->Auth->logout());
	}

	/**
	 * パスワード再発行
	 */
	public function forget()
	{
		//タイトルをセットする
		$this->set("title_for_layout", "パスワード再発行");
	}

	public function forgetComplete()
	{
		if ($this->request->is('post')) {
			$this->Administrator->id=$this->request->data["Administrator"]["e_mail_address"];
			$result=$this->Administrator->read();
			if(0<count($result)){
				//メールを送信する
				$email = new CakeEmail('gmail');
				// フォーマット
				$email->emailFormat('text');
				$k=array_keys($email->from());
				$v=array_values($email->from());
				$from=array($v[0],$k[0]);
				$email->to($result['Administrator'][0]['e_mail_address']);
				$email->subject('パスワード再発行');
				// テンプレートファイル
				$email->template('forget');
				// テンプレートに渡す変数
				$email->viewVars(
					array(
						"name" => $result['Administrator']['name'],
						"url" => "",
						"from"=> $from
					)
				);
				$email->send();
			}else{
				$this->Flash->set("一致するメールアドレスがありませんでした");
			}
		}
		//タイトルをセットする
		$this->set("title_for_layout", "パスワード再発行");
	}
}
