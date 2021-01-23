<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
   <title>DataTables Server Side Ci4</title>
   <style type="text/css">
      table.DTFC_Cloned thead,
      table.DTFC_Cloned tfoot {
         background-color: white
      }

      div.DTFC_Blocker {
         background-color: white
      }

      div.DTFC_LeftWrapper table.dataTable,
      div.DTFC_RightWrapper table.dataTable {
         margin-bottom: 0;
         z-index: 2
      }

      div.DTFC_LeftWrapper table.dataTable.no-footer,
      div.DTFC_RightWrapper table.dataTable.no-footer {
         border-bottom: none
      }

      table.dataTable.display tbody tr.DTFC_NoData {
         background-color: transparent
      }


      th,
      td {
         white-space: nowrap;
      }


      /*=======================*/

      .sk-btn {
         box-sizing: border-box;
         display: inline-block;
         min-width: 1.5em;
         padding: .5em 1em;
         margin-left: 2px;
         text-align: center;
         text-decoration: none !important;
         cursor: pointer;
         *cursor: hand;
         color: #333 !important;
         border: 1px solid transparent;
         border-radius: 2px
      }

      .sk-btn.sk-btn-light,
      .sk-btn.sk-btn-light:hover {
         color: #333 !important;
         border: 1px solid #979797;
         background-color: white;
         background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, white), color-stop(100%, #dcdcdc));
         background: -webkit-linear-gradient(top, white 0%, #dcdcdc 100%);
         background: -moz-linear-gradient(top, white 0%, #dcdcdc 100%);
         background: -ms-linear-gradient(top, white 0%, #dcdcdc 100%);
         background: -o-linear-gradient(top, white 0%, #dcdcdc 100%);
         background: linear-gradient(to bottom, white 0%, #dcdcdc 100%)
      }

      .sk-btn.disabled,
      .sk-btn.disabled:hover,
      .sk-btn.disabled:active {
         cursor: default;
         color: #666 !important;
         border: 1px solid transparent;
         background: transparent;
         box-shadow: none
      }

      .sk-btn.sk-btn-dark {
         color: white !important;
         border: 1px solid #111;
         background-color: #585858;
         background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #585858), color-stop(100%, #111));
         background: -webkit-linear-gradient(top, #585858 0%, #111 100%);
         background: -moz-linear-gradient(top, #585858 0%, #111 100%);
         background: -ms-linear-gradient(top, #585858 0%, #111 100%);
         background: -o-linear-gradient(top, #585858 0%, #111 100%);
         background: linear-gradient(to bottom, #585858 0%, #111 100%)
      }

      .sk-btn:active {
         outline: none;
         background-color: #2b2b2b;
         background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #2b2b2b), color-stop(100%, #0c0c0c));
         background: -webkit-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
         background: -moz-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
         background: -ms-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
         background: -o-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
         background: linear-gradient(to bottom, #2b2b2b 0%, #0c0c0c 100%);
         box-shadow: inset 0 0 3px #111
      }

      /*===================*/
      div.dataTables_wrapper {
         width: 100%;
         margin: 0 auto;
      }

    
      .actBtn {
         background:red;
      }
      .actBtn:before{
      content:"";
      position:absolute;
      width:300px;
      height:30px;
      top:0;
      left:0;
      }
   </style>
</head>

<body>
   <div class="container-fluid py-5">
      <div class="card">
         <div class="card-header text-muted text-center h4">Users List</div>
         <div class="card-body">
            <table id="ssp-datatable" class="display nowrap table table-striped table-border" style="width:100%">
               <thead>
                  <tr>
                     <!--<th>Select</th>-->
                     <th>ID</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Mobile</th>
                     <th>Designation</th>
                     <th>Gender</th>
                     <th>Status</th>
                     <th>Created_At</th>
                     <th>Updated_At</th>
                     <th>Deleted_At</th>
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody>
               </tbody>
               <tfoot>
                  <tr>
                     <!--<th>Select</th>-->
                     <th>ID</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Mobile</th>
                     <th>Designation</th>
                     <th>Gender</th>
                     <th>Status</th>
                     <th>Created_At</th>
                     <th>Updated_At</th>
                     <th>Deleted_At</th>
                     <th class="text-center">Action</th>
                  </tr>
               </tfoot>
            </table>
         </div>
      </div>
   </div>
   <a href="data-layout" >Ssp Class</a><br><br>
   
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal">
  Launch static backdrop modal
</button>

<!-- Modal -->
<div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Update Modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="update-form" >
	        <div class="form-group" >
		        <input class="form-control mb-3 disabled" id="id" type="number" value="12"  readonly>
	        </div>
	        <div class="form-group" >
	        <input class="form-control mb-3" type="text" id="name" placeholder="Name" >
	        </div>
	        <div class="form-group" >
	        <input class="form-control mb-3" type="email" id="email" placeholder="Email" >
	        </div>
	        <div class="form-group" >
	        <input class="form-control mb-3" type="tel" id="mobile" placeholder="Mobile" >
	        </div>
	        <div class="form-group" >
	        <input class="form-control mb-3" type="text" id="desig" placeholder="Designation" >
	        </div>
	        
			<select class="form-select mb-3" aria-label="Gender">
			  <option selected>Select Gender</option>
			  <option value="male">Male</option>
			  <option value="female">Female</option>
			  <option value="gender">Other</option>
			</select>
			
			<select class="form-select mb-3" aria-label="Default select example">
			  <option selected>Select Status</option>
			  <option value="1">Active</option>
			  <option value="0">Inactive</option>
			</select>
	        
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>

   <!-- Optional JavaScript; choose one of the two! -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
   <!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>
   <script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>
   <!-- Option 2: Separate Popper and Bootstrap JS -->
   <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
   <script src="public/assets/usersdt.js?<?=time();?>"></script>
</body>

</html>