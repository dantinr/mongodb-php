<?php

require_once "vendor/autoload.php";



class MongoTest
{

	protected $mongo_client;
	protected $collection;

	public function __construct($db,$collection)
	{
		$this->mongo_client = new MongoDB\Client();
		//$this->collection = $this->mongo_client->$db->$collection;
		//$this->mongo_client->selectDatabase($db);
		$this->collection = $this->mongo_client->selectCollection($db,$collection);
	}


	/**
	 * 列出所有 数据库
	 * @return \MongoDB\Model\DatabaseInfoIterator
	 */
	public function listDb()
	{
		return $this->mongo_client->listDatabases();
	}


	/**
	 * 查询一条记录
	 * @param string $id
	 * @return array|null|object
	 */
	public function findOne(string $id)
	{
		$where = ["id"=>$id];
		return $this->collection->findOne($where);
	}


	/**
	 * 获取多条记录
	 * @param $order_id
	 * @return mixed
	 */
	public function find(string $master_order_id)
	{
		$where = ['master_order_id'=>$master_order_id];
		$fields = ['id'=>1,'order_sub_id'=>1,'order_id'=>1,'master_order_id'=>1];		// 获取字段
		return $this->collection->find($where,['projection'=>$fields]);
	}






}

echo '<hr>';
$db = 'sjb';
$collection = 'order_info';
$m = new MongoTest($db,$collection);
$dbs = $m->listDb();
//echo '<pre>';print_r($dbs);echo '</pre>';echo '<hr>';


//查询一条记录
$one = $m->findOne(4);		// string id
//echo '<pre>';print_r($one);echo '</pre>';echo '<hr>';

//查询多条记录
$order_id = '1806111901477567';
$many = $m->find($order_id);echo '<hr>';

foreach($many as $k=>$v){
	echo '<pre>';print_r($v);echo '</pre>';
}







