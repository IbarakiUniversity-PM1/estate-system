<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('Sanitize', 'Utility');

class PreviewBookController extends AppController
{
    public $helpers = array(
        "Html",
        "Form",
        "Flash",

    );

    public $components = array('Session');
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
    public function book($estate_id = null, $str_dates = null) {
        //タイトルを設定
        $this->set("title_for_layout", "内見予約画面");

        $this->Estate->id = $estate_id;
        $estate = $this->Estate->read();

        //引数estate_idから物件情報を読み込む
        if ($this->request->is('get')) {

            // 存在しない詳細画面を表示した際の処理
            if(!$estate){
                throw new NotFoundException(__('404 Not Found'));
            }

            //全ての部屋が契約済みな物件について、非表示フラグを立てる
            if(!$estate["Estate"]["hide_flag"]) {
                $isHide = true;
                for ($i = 0; $isHide && $i < count($estate["EstateRoom"]); $i++) {
                    if (!$estate["EstateRoom"][$i]["contracted_flag"]) {
                        $isHide = false;
                    }
                }
                if ($isHide) {
                    $estate["Estate"]["hide_flag"] = 1;
                }
            }

            // 非表示物件の詳細画面を表示した際の処理
            $loginUser=$this->Auth->user();
            if($estate["Estate"]["hide_flag"] && empty($loginUser)) {
                throw new NotFoundException(__('404 Not Found'));
            }

            if($this->Session->check('previewbook_return')){
                /* 正しくリダイレクトされてるときの処理 */
                $data_return = $this->Session->read('previewbook_return');

                //エスケープ文字をメタ文字に変換
                $user_name_meta = $data_return['PreviewBook']['user_name'];
                $user_name_meta = str_replace("&amp;lt;", "<", $user_name_meta);
                $user_name_meta = str_replace("&amp;gt;", ">", $user_name_meta);
                $user_name_meta = str_replace("&amp;quot;", '"', $user_name_meta);
                $user_name_meta = str_replace("&amp;nbsp;", " ", $user_name_meta);
                $user_name_meta = str_replace("&amp;copy;", "©", $user_name_meta);

                $this->set('data_return', $data_return);
                $this->set('user_name_meta', $user_name_meta);
                $this->set('estate', $estate);

                if(isset($str_dates)){
                    $preview_dates = explode(",", $str_dates);
                    $this->set('preview_dates', $preview_dates);
                }else{
                    $preview_dates = explode(",", "".","."".","."");
                    $this->set('preview_dates', $preview_dates);
                }

                $isDefault = false;
                $this->set('isDefault', $isDefault);

            }else{
                /* データが無いときの処理 */
                $this->Estate->id = $estate_id;
                $this->set('estate', $this->Estate->read());

                $isDefault = true;
                $this->set('isDefault', $isDefault);

            }
        }

        if ($this->request->is('post')) {
            if (isset($this->request->data['submit'])) {
                $this->loadModel('PreviewBook');
                $this->PreviewBook->set($this->request->data);

                $isDefault = true;
                $this->set('isDefault', $isDefault);

                if ($this->PreviewBook->validates()) {
                    // 正しい場合のロジック
                    $this->Session->write('previewbook_content', $this->request->data);
                    return $this->redirect(array('action' => 'confirm'));
                } else {
                    // 正しくない場合のロジック
                    $errors = $this->PreviewBook->validationErrors;
                    $this->Estate->id = $this->request->data['PreviewBook']['estate_id'];
                    $this->set('estate', $this->Estate->read());
                }
            }else if (isset($this->request->data['cancel'])){
                    return $this->redirect(array('controller' => 'EstateView', 'action' => 'detail', $this->request->data['PreviewBook']['estate_id']));
            }
        }
    }

    /**
     * 送信確認画面
     */
    public function confirm()
    {
        //タイトルを設定
        $this->set("title_for_layout", "送信確認画面");

        if($this->Session->check('previewbook_content')){
            /* 正しくリダイレクトされてるときの処理 */
             // サニタイズの応急処置(非推奨)
            $data = Sanitize::clean($this->Session->read('previewbook_content'));
            $this->set('data', $data);
        }else{
            /* データが無いときの処理 */
        }
    }

    /**
     * 送信完了画面
     */
    public function complete()
    {
        // サニタイズの応急処置(非推奨)
        $this->request->data = Sanitize::clean($this->request->data);

        if (isset($this->request->data['submit'])) {
                        //debug($this->request->data);
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
            $k=array_keys($email_->from());
            $v=array_values($email_->from());
            $from=array($v[0],$k[0]);

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
                        ),
                    "from"=> $from
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
                        ),
                    "from"=> $from
                )
            );
            $email->send();
        } else if (isset($this->request->data['cancel'])) {
            //'book'アクション(内見予約画面)へリダイレクト
                        $str_dates = $this->request->data['PreviewBook']["preview_date_1"].",".
                                    $this->request->data['PreviewBook']["preview_date_2"].",".
                                    $this->request->data['PreviewBook']["preview_date_3"];
                        $this->Session->write('previewbook_return', $this->request->data);
            $this->redirect(array('action' => 'book', $this->request->data['PreviewBook']['estate_id'], $str_dates));
        }

        //タイトルを設定
        $this->set("title_for_layout", "送信完了画面");
    }
}
