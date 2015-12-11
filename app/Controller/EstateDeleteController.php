<?php
class EstateDeleteController extends AppController{
	/**
	 * @var array 扱うヘルパーのリスト
	 */
	public $helpers = array(
		"Html",
		"Form",
		"Flash",
		"UploadPack.Upload"
	);
	/**
	 * @var array 扱うモデルのリスト
	 */
	public $uses = array(
		"Estate",
		"EstateAgent",
		"EstateTradingAspect",
		"EstateStructure",
		"EstateType",
		"EstateTvType",
		"EstateInternetType",
		"EstatePicture"
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny();
	}

	/**
	 * 物件削除
	 * @param null $estate_id 物件ID
	 */
	public function delete($estate_id = null)
	{
		if ($this->request->is('post') && $estate_id!=null) {
			$isFail=!$this->Estate->delete($estate_id);
			if(!$isFail){
				foreach($this->EstatePicture->find("list",array("fields"=>"EstatePicture.estate_picture_id","conditions"=>"EstatePicture.estate_id=".$estate_id)) as $e){
					if(!$this->EstatePicture->delete($e)){
						$isFail=true;
						break;
					}
				}
			}
			if($isFail){
				$this->Flash->set("正常に物件を削除できませんでした。");
			}
			$this->redirect(array('controller' => 'EstateRegistration', 'action' => 'index'));
		}
	}
}
