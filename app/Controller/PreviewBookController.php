<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('Sanitize', 'Utility');

class PreviewBookController extends AppController
{
    /**
     * @var array 扱うモデルのリスト
     */
    public $helpers = array(
        "Html",
        "Form",
        "Flash"
    );
    /**
     * @var array 扱うモデルのリスト
     */
    public $uses = array(
        "Estate",
        "EstateAgent"
    );

    /**
     * 物件予約画面
     * @param null $estate_id 物件ID
     */
    public function book($estate_id = null)
    {
        //タイトルを設定
        $this->set("title_for_layout", "内見予約画面");

        //引数estate_idから物件情報を読み込む
        if ($this->request->is('get')) {
            $this->Estate->id = $estate_id;
            $this->set('estate', $this->Estate->read());
        }
    }

    /**
     * 送信確認画面
     */
    public function confirm()
    {
        // サニタイズの応急処置(非推奨)
        $this->request->data = Sanitize::clean($this->request->data);

        //タイトルを設定
        $this->set("title_for_layout", "送信確認画面");
    }

    /**
     * 送信完了画面
     */
    public function complete()
    {
		// サニタイズの応急処置(非推奨)
		$this->request->data = Sanitize::clean($this->request->data);

		if (isset($this->request->data['submit'])) {
			//物件idから物件情報を取得
			$this->Estate->id = $this->request->data['PreviewBook']['estate_id'];
			$estate = $this->Estate->read();

			//物件情報から不動産業者のE-Mailアドレスを取得
			$this->EstateAgent->id = $estate['Estate']['estate_agent_id'];
			$agent = $this->EstateAgent->read();

			//メールを送信する
			$email_ = new CakeEmail('gmail');
			// フォーマット
			$email_->emailFormat('text');

			//不動産業者
			$email=clone $email_;
			$email->replyTo($this->request->data['PreviewBook']['email_address'],$this->request->data['PreviewBook']['user_name']);
			$email->to($agent['EstateAgent']['e_mail_address']);
			$email->subject('内見予約のお知らせ');
			// テンプレートファイル
			$email->template('agent');
			// テンプレートに渡す変数
			$email->viewVars(
				array(
					"agent_name" => $agent['EstateAgent']['name'],
					"user_name" => $this->request->data['PreviewBook']['user_name'],
					"email_address" => $this->request->data['PreviewBook']['email_address'],
					"tel_number" => $this->request->data['PreviewBook']['tel_number'],
					"estate_name" => $estate["Estate"]["name"],
					"preview_date" =>
						array(
							$this->request->data['PreviewBook']["preview_date_1"],
							$this->request->data['PreviewBook']["preview_date_2"],
							$this->request->data['PreviewBook']["preview_date_3"]
						)
				)
			);
			$email->send();

			//利用者
			$email=clone $email_;
			$email->to($this->request->data['PreviewBook']['email_address']);
			$email->subject('内見予約完了');
			// テンプレートファイル
			$email->template('user');
			// テンプレートに渡す変数
			$email->viewVars(
				array(
					"user_name" => $this->request->data['PreviewBook']['user_name'],
					"estate_name" => $estate["Estate"]["name"],
					"preview_date" =>
						array(
							$this->request->data['PreviewBook']["preview_date_1"],
							$this->request->data['PreviewBook']["preview_date_2"],
							$this->request->data['PreviewBook']["preview_date_3"]
						)
				)
			);
			$email->send();
		} else if (isset($this->request->data['cancel'])) {
			//'book'アクション(内見予約画面)へリダイレクト
			$this->redirect(array('action' => 'book'));
		}

        //タイトルを設定
        $this->set("title_for_layout", "送信完了画面");
    }
}
