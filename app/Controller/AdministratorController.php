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
		if (!$isEffective || $this->request->is('post')) {
			if($isEffective){
				$this->Administrator->create();
			}
			$list=$this->Administrator->find("list",array("conditions"=>array("Administrator.name"=>$this->request->data["Administrator"]["name"])));
			if (!$isEffective || (count($list)==0 && $this->Administrator->save($this->request->data))) {
				$this->redirect(array("action" => "login"));
			} else {
				$this->MyFlash->set_validation_error($this->Administrator->validationErrors);
				if(0<count($list)){
					$this->Flash->set("その管理者IDは既に使われています");
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
		if ($this->request->is('post')) {
			$result=$this->Administrator->find("all",array("conditions"=>"Administrator.e_mail_address='".$this->request->data["Administrator"]["e_mail_address"]."'"));
			if(0<count($result)){
				//メールを送信する
				$email = new CakeEmail('gmail');
				// フォーマット
				$email->emailFormat('text');
				$k=array_keys($email->from());
				$v=array_values($email->from());
				$from=array($v[0],$k[0]);
				$email->to($result[0]['Administrator']['e_mail_address']);
				$email->subject('パスワード再発行');
				// テンプレートファイル
				$email->template('forget');
				// テンプレートに渡す変数
				$email->viewVars(
					array(
						"name" => $result[0]['Administrator']['name'],
						"url" => "",
						"from"=> $from
					)
				);
				$email->send();
				$this->redirect(array("action"=>"complete"));
			}else{
				$this->Flash->set("一致するメールアドレスがありませんでした");
			}
		}
		//タイトルをセットする
		$this->set("title_for_layout", "パスワード再発行");
	}

	public function complete()
	{
		//タイトルをセットする
		$this->set("title_for_layout", "送信完了");
	}
}
