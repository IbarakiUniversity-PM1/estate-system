<?php
class EstateDeleteController extends AppController{
    public $helpers = array("Html", "Form","Flash", "UploadPack.Upload"); //書いてあるといろいろ便利
    public $uses = array("Estate", "EstateAgent", "EstateTradingAspect", "EstateStructure", "EstateType",
        "EstateTvType", "EstateInternetType", "EstatePicture");



    public function delete($estate_id) {

        if ($this->request->is('get')){
            throw new MethodNotException();
        }

        if($this->Estate->delete($estate_id)){
//            $this->Flash->success(__('The post with id: %s has been deleted.', h($estate_id)));
        }else{
//            $this->Flash->error(__('The post with id: %s could not be deleted.', h($estate_id)));
        }

        return $this->redirect(array('controller' => 'estateregistration', 'action' => 'index'));
    }
}
