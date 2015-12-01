<?php
App::uses('CakeEmail', 'Network/Email');

class PreviewbookController extends AppController {
    /**
     * @var array 扱うモデルのリスト
     */
    public $helpers = array("Html", "Form", "Flash");
    
    /**
     * @var array
     */
    public $uses = array(
        "Estate",
        "EstateAgent"
    );
    
    public function book($id = null){
        //タイトルを設定
        $this->set("title_for_layout", "内見予約画面");
        
        //引数estate_idから物件情報を読み込む
        if($this->request->is('get')){
            $this->Estate->id = $id;
            $this->set('estate', $this->Estate->read());
        }
        
    }
    
    public function confirm(){
        //タイトルを設定
        $this->set("title_for_layout", "送信確認画面");
        
        if(isset($this->request->data['submit'])){
            //物件idから物件情報を取得
            $this->Estate->id = $this->request->data['Previewbook']['estate_id'];
            $estate = $this->Estate->read();
            
            //物件情報から不動産業者のE-Mailアドレスを取得
            $this->EstateAgent->id = $estate['Estate']['estate_agent_id'];
            $agent = $this->EstateAgent->read();
            $email_agent = $agent['EstateAgent']['e_mail_address'];
            
            //メールを送信する
//            $email = new CakeEmail('gmail');
//            $email->from( array('kougakuhudousan@gmail.com' => 'Sender'));
//            $email->to($email_agent);
//            $email->subject('メールタイトル');
//            $email->send('本文');
            
            //'complete'アクション(送信完了画面)へリダイレクト
            $this->redirect(array('action' => 'complete'));
        }else if(isset($this->request->data['cancel'])){
            //'book'アクション(内見予約画面)へリダイレクト
            $this->redirect(array('action' => 'book'));
        }
    }
    
    public function complete(){
        //タイトルを設定
        $this->set("title_for_layout", "送信完了画面");
        
        
    }
    
}