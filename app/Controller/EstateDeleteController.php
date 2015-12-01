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

	/**
	 * 物件削除
	 * @param null $estate_id 物件ID
	 */
	public function delete($estate_id = null)
	{
		if ($this->request->is('get')) {
			throw new NotFoundException();
		}

		if ($this->Estate->delete($estate_id, $cascade = true)) {
//			$this->Flash->success(__('The post with id: %s has been deleted.', h($estate_id)));
		} else {
//			$this->Flash->error(__('The post with id: %s could not be deleted.', h($estate_id)));
		}

		$this->redirect(array('controller' => 'estateregistration', 'action' => 'index'));
	}
}
