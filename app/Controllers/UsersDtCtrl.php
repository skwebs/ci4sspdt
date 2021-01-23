<?php

namespace App\Controllers;
use App\Models\SspDtModel;

class UsersDtCtrl extends BaseController
{
    public function __construct()
    {
        $this->db = db_connect();
    }
	
	public function lists(){
		return view("users/view_usersdt");
	}
	
	
	public function serverSideDataForDatatable(){
	    $draw = intval($this->request->getPostGet("draw"));
	    $start = intval($this->request->getPostGet("start"));
	    $length = intval($this->request->getPostGet("length"));
	    $order = $this->request->getPostGet("order");
	    $search= $this->request->getPostGet("search");
	    $search = $search['value'];
	    //$length = 1;
	    
	    // data ordering
	    $dir='';$col=0;
		if(!empty($order)){
            foreach($order as $o){
                $col = $o['column'];
                $dir = strtoupper($o['dir']);
            }
        }
        if($dir != "ASC" && $dir != "DESC"){
            $dir = "DESC";
        }
        
        
	    $valid_columns = array(
		    0=>'id',
		    1=>'name',
		    2=>'email',
		    3=>'mobile',
		    4=>'designation',
		    5=>'gender',
		    6=>'status'
	    );
	    
	    
	    // Created Builder Instance
	    $builder = $this->db->table("tbl_members");
	    
	    /* 
	    | * Each function resets builder query so 
	    | * created separate query Blocks
	    |
	    | * Block 1 => Count All Rows
	    | * Block 2 => Count Filtered Rows
	    | * Block 3 => Get Requested Data
	    */
	    
	    // * Block 1 => Count All Rows -----------------------------------------------------
	    $totalRows = intVal($builder->countAllResults());  // Produces an integer, like 25
	    //builder query reseted
	    
	    // * Block 2 => Count Filtered Rows ---------------------------------------
		//$search ='London';
        if(!empty($search)){
            $x=0;
            foreach($valid_columns as $sterm){
                if($x==0){
                    $builder->like($sterm,$search);
                }else{
                    $builder->orLike($sterm,$search);
                }
                $x++;
            }                 
        }
        
		if(!isset($valid_columns[$col])){
            $order = null;
        }else{
            $order = $valid_columns[$col];
        }
        if($order !=null){
		    $builder->orderBy($order,$dir);
	    }
	    
	    $filteredRows = intVal($builder->countAllResults());  // Produces an integer, like 25
	    //builder query reseted
	    
	    

        // * Block 3 => Get Requested Data ---------------------------------------
        if(!empty($search)){
            $x=0;
            foreach($valid_columns as $sterm){
                if($x==0){
                    $builder->like($sterm,$search);
                }else{
                    $builder->orLike($sterm,$search);
                }
                $x++;
            }                 
        }
        
		if(!isset($valid_columns[$col])){
            $order = null;
        }else{
            $order = $valid_columns[$col];
        }
        if($order !=null){
		    $builder->orderBy($order,$dir);
	    }
	    
	    if($length !== -1){
	    $builder->limit($length,$start);
	    }
	    
	    $data = array();
	    foreach($builder->get()->getResult() as $r){
	    $data[] = $r;   
	    }
	    
	    $output = array(
		    "draw" => $draw,
		    "recordsTotal" =>$totalRows,
		    //"recordsFiltered" =>$totalRows,
		    "recordsFiltered" => $filteredRows,
		    "data" => $data
	    );
	    
	    //echo $this->db->getLastQuery();
	    //echo '<pre>';
	    //print_r($output);
	    //var_dump($output);
	    
	    return $this->response->setJSON($output);
	}

}


?>