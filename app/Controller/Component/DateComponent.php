<?php

/**
 * SQlite用タイムスタンプと『Y/m/d』形式の日付文字列の相互変換を行うコンポーネント
 */
class DateComponent extends Component
{
	/**
	 * @var int 重み
	 */
	private $weighting = 1000;

	/**
	 * 各メソッドを実行前に行なう動作
	 */
	private function beforeRun()
	{
		date_default_timezone_set("Asia/Tokyo"); //タイムゾーンを設定
	}

	/**
	 * 今日からの相対的な日付をSQlite用タイムスタンプに変換する
	 * @param $modify string 相対的な日付
	 * @return int SQlite用タイムスタンプ
	 */
	public function toTimestampModify($modify)
	{
		$this->beforeRun();
		$dateTime=new DateTime();
		return $dateTime->modify($modify)->getTimestamp()*$this->weighting;
	}

	/**
	 * 『Y/m/d』形式の日付文字列をSQlite用タイムスタンプに変換する
	 * @param $string string 日付文字列(『Y/m/d』形式)
	 * @return int SQlite用タイムスタンプ
	 */
	public function toTimestamp($string)
	{
		$this->beforeRun();
		$dateTime=new DateTime($string);
		return $dateTime->getTimestamp()*$this->weighting;
	}

	/**
	 * SQlite用タイムスタンプを『Y/m/d』形式の日付文字列に変換する
	 * @param $time_stamp int SQlite用タイムスタンプ
	 * @return string 日付文字列(『Y/m/d』形式)
	 */
	public function toString($time_stamp)
	{
		$this->beforeRun();
		$dateTime=new DateTime();
		return $dateTime->setTimestamp($time_stamp/$this->weighting)->format("Y/m/d");
	}
}
