<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Site2 extends BaseController
{
    public function __construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.class.new.php';
        $this->db = db_connect();
    }

    public function server_side_table_ssp_listing_layout()
    {
        return view("data");
    }










    public function ssp_ajax()
    //public function showEmployees()
    {
        $builder = $db->table("tbl_members");
        
        $draw = intval($this->getPost("draw"));
        $start = intval($this->getPost("start"));
        $length = intval($this->getPost("length"));
        $order = $this->getPost("order");
        $search= $this->getPost("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
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
        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }
        if($order !=null)
        {
            $builder->orderBy($order, $dir);
        }
        
        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sTerm)
            {
                if($x==0)
                {
                    $builder->like($sTerm,$search);
                }
                else
                {
                    $builder->orLike($sTerm,$search);
                }
                $x++;
            }                 
        }
        $builder->limit($length,$start);
        
        $totalRows = $builder->countAll();
        
        $data = array();
        foreach($builder->get()->getResult() as $rows)
        {

            $data[]= array(
                $rows->id,
                $rows->name,
                $rows->email,
                $rows->mobile,
                $rows->designation,
                $rows->gender,
                $rows->status,
                '<a href="#" class="btn btn-warning mr-1">Edit</a>
                 <a href="#" class="btn btn-danger mr-1">Delete</a>'
            );     
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $totalRows,
            "recordsFiltered" => $totalRows,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }












    function list_data_using_ssp_ajax()
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