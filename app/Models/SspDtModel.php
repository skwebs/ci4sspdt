<?php

namespace App\Models;

use CodeIgniter\Model;

class SspDtModel extends Model
{
	protected $table = 'tbl_members';

	protected $primaryKey = 'id';

	protected $allowedFields = ['name', 'email', 'mobile', 'designation', 'gender', 'status', 'created_at', 'updated_at', 'deleted_at'];
//----

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

//---


}

?>