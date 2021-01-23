<?php

namespace App\Controllers;
use App\Libraries\DtsspLib;
use App\Models\SiteModel;

class DtsspCtrl extends BaseController
{
	public $dt;
	public function __construct()
	{
		$params=array(
		'table' => 'tbl_members',
		'primary_key' => 'id',
		'columns' => array('id','name','email'),
		'where' => array()
		);
		$this->dt = new DtsspLib($params);
		//$this->load->helper('url');
		//$this->load->view('home');
	}

	public function index()
	{
		/*$this->load->library('datatables_server_side', array(
			'table' => 'customer',
			'primary_key' => 'customer_id',
			'columns' => array('first_name', 'last_name', 'email'),
			'where' => array()
		));

		$this->datatables_server_side->process();
		*/
		$this->dt->process();
	}


}


?>