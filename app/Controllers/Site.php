<?php

namespace App\Controllers;
use App\Models\SiteModel;
use App\Controllers\BaseController;

class Site extends BaseController
{
    public function __construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.class.new2.php';
        $this->db = db_connect();
    }

    public function server_side_table_ssp_listing_layout()
    {
        return view("data");
    }
    
    public function ssp_view(){
	    return view("view_ssp-cls-dt");
    }
    public function ssp_view2(){
    return view("ssp_view");
    }
    
    public function actionAjax(){
	    $id=$this->request->getPost("id");
	    $builder = $this->db->table("tbl_members");
	    $data = [
	    'name' => 'Satish Kumar',
	    'email'  => '00satish2015@gmail.com',
	    'mobile'  => 9973757920,
	    'designation'=>'Developer',
	    'gender'=>'male',
	    'status'=>1
	    ];
	    
	    //$builder->->delete($id);
	    //$builder->save([]);
    }

function delete($id)
    {
        $siteModel = new SiteModel();
        echo '<pre>';
        if(!$siteModel->where(['id'=>$id])->delete()){
        $error = $db->error();
        var_dump($error);
        };
        //$data = $siteModel->findAll();
		echo "<br><br>$id<br>".$this->db->getLastQuery()."<br><br>";

       //print_r($data);
        //return $this->response->redirect(site_url('/crud'));
    }

    public function ssp(){
	    
	    $builder = $this->db->table("tbl_members");
	    $totalRows = $builder->countAll();
	    $data = array();
	    foreach($builder->get()->getResult() as $r){
		    $data[] = array(
			    $r->id,
			    $r->name,
			    $r->email,
			    $r->mobile,
			    $r->designation,
			    $r->gender,
			    $r->status,
			    "<a class='sk-btn sk-btn-dark' onclick='editId(".$r->id.")'>Edit</a> <a class='sk-btn sk-btn-light' onclick='deleteId(".$r->id.")'>Delete</a>"
		    );
	    }
	    $response = array();
	    $response["status"] = true;
	    $response["aaData"] = $data;
	    //echo  json_encode($response);
	    //echo  json_encode($data);
	    return $this->response->setJSON($data);
	    //echo "<pre>";print_r($response);
	    //echo "<pre>";print_r($data);
	    
	    
	    
    }
    
public function ssp2(){
	    
	    $builder = $this->db->table("tbl_members");
	    $totalRows = $builder->countAll();
	    $data = array();
	    foreach($builder->get()->getResult() as $r){
		    $data[] = array(
			    $r->id,
			    $r->name,
			    $r->email,
			    $r->mobile,
			    $r->designation,
			    $r->gender,
			    $r->status,
		    );
	    }
	    $response = array();
	    $response["status"] = true;
	    $response["aaData"] = $data;
	    //echo  json_encode($response);
	    //echo  json_encode($data);
	    return $this->response->setJSON($data);
	    //echo "<pre>";print_r($response);
	    //echo "<pre>";print_r($data);
	    
	    
	    
}

    public function list_data_using_ssp_ajax()
    {
        // this is database details
        $dbDetails = array(
            "host" => $this->db->hostname,
            "user" => $this->db->username,
            "pass" => $this->db->password,
            "db" => $this->db->database,
        );

        $table = "tbl_members";

        //primary key
        $primaryKey = "id";

        $columns = array(
            array(
                "db" => "id",
                "dt" => 0,
            ),
            array(
                "db" => "name",
                "dt" => 1,
            ),
            array(
                "db" => "email",
                "dt" => 2,
            ),
            array(
                "db" => "mobile",
                "dt" => 3,
            ),
            array(
                "db" => "designation",
                "dt" => 4,
            ),
            array(
                "db" => "gender",
                "dt" => 5,
                "formatter" => function ($value, $row) {
                    return ucfirst($value);
                },
            ),
            array(
                "db" => "status",
                "dt" => 6,
                "formatter" => function ($value, $row) {
                    return $value == 1 ? "Active" : "Inactive";
                },
            )
            
        );

        echo json_encode(
            \SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }
}


?>