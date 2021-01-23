  $(document).ready(function() {
     var base_url = "http://localhost:8080/ci4dt";
     
     var $sspDTbl = $('#ssp-datatable')
     var table = $sspDTbl.DataTable({
        serverSide: true,
        scrollY: "300px",
        scrollX: true,
        processing:true,
        scrollCollapse: true,
        'ajax': {
           'url': base_url + '/sspdtctrl/ssp2',
           'dataSrc': ''
        },
        /*'columnDefs': [
            {
	            'targets': 0,
	            'searchable': false,
	            'orderable': false,
	            'width': '1%',
	            'className': 'dt-body-center',
	            'render': function (data, type, full, meta){
	            return '<input type="checkbox">';
	            }
            },
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
            
        ],*/
        'columns': [
			    {'data':'id'},
			    {'data':'name'},
			    {'data':'email'},
			    {'data':'mobile'},
			    {'data':'designation'},
			    {'data':'gender'},
			    {'data':'status'}
			    /*/
           { 'data': '' },
           { 'data': 0 },
           { 'data': 1 },
           { 'data': 2 },
           { 'data': 3 },
           { 'data': 4 },
           { 'data': 5 },
           { 'data': 6 },
           { 'data': '' }*/
           
		    ]
     });
     
     $sspDTbl.on("click", ".edit", function(){
     var data = table.row($(this).closest('tr')).data();
     alert(data[0]);
     });
});
  
  function editId(id){alert('edit id no. '+id)}
  function deleteId(id){alert('delete id no. '+id)}
  