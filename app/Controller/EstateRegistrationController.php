<?php

class EstateRegistrationController extends AppController{
	public $helpers = array("Html", "Form", "UploadPack.Upload"); //書いてあるといろいろ便利
	public $uses = array("Estate", "EstateAgent", "EstateTradingAspect", "EstateStructure", "EstateType",
		"EstateTvType", "EstateInternetType", "EstatePicture");


    public function register(){
        //レイアウトを切る
        $this->layout = "";

        //プルダウンメニュー作成(不動産業者)
		$estateAgentList = array("empty" => "なし");
		$estateAgents = $this->EstateAgent->find("all", array("fields" => array("estate_agent_id", "name")));
        foreach ($estateAgents as $estateAgent){
            $estateAgentList = array_merge($estateAgentList, array(
				(string)$estateAgent["EstateAgent"]["estate_agent_id"] => $estateAgent["EstateAgent"]["name"]
            ));
        }
		$this->set("estateAgentList", $estateAgentList);

        //プルダウンメニュー作成(取引態様)
		$estateTradingAspectList = array("empty" => "なし");
		$estateTradingAspects = $this->EstateTradingAspect->find("all", array("fields" => array("estate_trading_aspect_id", "name")));
        foreach ($estateTradingAspects as $estateTradingAspect){
            $estateTradingAspectList = array_merge($estateTradingAspectList, array(
				(string)$estateTradingAspect["EstateTradingAspect"]["estate_trading_aspect_id"] => $estateTradingAspect["EstateTradingAspect"]["name"]
            ));
        }
		$this->set("estateTradingAspectList", $estateTradingAspectList);

        // 構造
		$estateStructureList = array("empty" => "なし");
		$estateStructures = $this->EstateStructure->find("all", array("fields" => array("estate_structure_id", "name")));
        foreach ($estateStructures as $estateStructure){
            $estateStructureList = array_merge($estateStructureList, array(
				(string)$estateStructure["EstateStructure"]["estate_structure_id"] => $estateStructure["EstateStructure"]["name"]
            ));
        }
		$this->set("estateStructureList", $estateStructureList);

        // 部屋種別
		$estateTypeList = array("empty" => "なし");
		$estateTypes = $this->EstateType->find("all", array("fields" => array("estate_type_id", "name")));
        foreach ($estateTypes as $estateType){
            $estateTypeList = array_merge($estateTypeList, array(
				(string)$estateType["EstateType"]["estate_type_id"] => $estateType["EstateType"]["name"]
           ));
        }
		$this->set("estateTypeList", $estateTypeList);

        // インターネット回線
		$estateInternetTypeList = array("empty" => "なし");
		$estateInternetTypes = $this->EstateInternetType->find("all", array("fields" => array("estate_internet_type_id", "name")));
        foreach ($estateInternetTypes as $estateInternetType){
            $estateInternetTypeList = array_merge($estateInternetTypeList, array(
				(string)$estateInternetType["EstateInternetType"]["estate_internet_type_id"] => $estateInternetType["EstateInternetType"]["name"]
            ));
        }
		$this->set("estateInternetTypeList", $estateInternetTypeList);

        // テレビ
		$estateTvTypeList = array("empty" => "なし");
		$estateTvTypes = $this->EstateTvType->find("all", array("fields" => array("estate_tv_type_id", "name")));
        foreach ($estateTvTypes as $estateTvType){
            $estateTvTypeList = array_merge($estateTvTypeList, array(
				(string)$estateTvType["EstateTvType"]["estate_tv_type_id"] => $estateTvType["EstateTvType"]["name"]
        ));
        }
		$this->set("estateTvTypeList", $estateTvTypeList);

    }

	public function confirm()
	{

	}

	public function complete()
	{

	}

}

