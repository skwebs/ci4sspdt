<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.css" />
   <title>DataTables Server Side Ci4</title>
   <style type="text/css">
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
      
      

   </style>
</head>

<body>

<div class="container-fluid mt-5">
   <div class="card">
      <div class="card-header text-muted text-center h4">Server Side Listing (Using SSP Library)</div>
      <div class="card-body">
         <table id="ssp-datatable" class="table table-striped table-border" style="width:100%">
            <thead>
               <tr>
                  <th>UserID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Designation</th>
                  <th>Gender</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
         </table>
      </div>
   </div>
</div>

   <!-- Optional JavaScript; choose one of the two! -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
   <!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>
   <!-- Option 2: Separate Popper and Bootstrap JS -->
   <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
   <script type="text/javascript">
      $(document).ready(function() {
         var base_url = "<?=base_url(); ?>";

         var $sspDTbl = $('#ssp-datatable')
         var table = $sspDTbl.DataTable({
            serverSide: true,
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            'ajax': {
               'url': base_url + '/site/ssp',
               'dataSrc': ''
            },
            'columnDefs': [
	            
	            {
	            'targets': -1,
	            'searchable': false,
	            'orderable': false,
	            'width': '1%',
	            'className': 'dt-body-center',
	            'render': function (data, type, full, meta){
	            return '<button class="edit btn btn-primary">Edit</button> ';
	            }
	            }
	            
            ],
            'columns': [
				   /* {'data':'id'},
				    {'data':'name'},
				    {'data':'email'},
				    {'data':'mobile'},
				    {'data':'designation'},
				    {'data':'gender'},
				    {'data':'status'}
				    */
               { 'data': 0 },
               { 'data': 1 },
               { 'data': 2 },
               { 'data': 3 },
               { 'data': 4 },
               { 'data': 5 },
               { 'data': 6 },
               //{ 'data': 7 },
               { 'data': '' }
               
			    ]
         });
         
         $sspDTbl.on("click", ".edit", function(){
         var data = table.row($(this).closest('tr')).data();
         alert(data[0]);
         });
		 /*
         $.ajax({
         url : base_url + "/site/ssp",
         method:"post",
         dataType : "json",
         success : function(res){
         console.log(JSON.stringify(res[0][0]));
         }
         });
         		   /*
         		    $("#ssp-datatable").dataTables({
         			    "pageLength":10,
         			    "order" : [],
         			    "ajax" : {
         				    url
         			    }
         		    });*/
      });
      
      function editId(id){alert('edit id no. '+id)}
      function deleteId(id){alert('delete id no. '+id)}
      
   </script>
</body>

</html>