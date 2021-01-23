/*$(document).ready(function() {
    var base_url = "http://localhost:8080/ci4dt";
    var actBtn = '<button class="view btn btn-outline-dark"><i class="fa fa-eye"></i></button> ';
    actBtn += '<button class="update btn btn-outline-primary"><i class="fa fa-pencil"></i></button> ';
    actBtn += '<button class="delete btn btn-outline-danger"><i class="fa fa-trash"></i></button> ';
    
    var actBtn2 = '<div class="btn-group" role="group" aria-label="Action Button">';
    actBtn2 += '<button type="button" class="view btn btn-outline-primary"><i class="fa fa-eye"></i></button>';
    actBtn2 += '<button type="button" class="update btn btn-outline-primary"><i class="fa fa-pencil"></i></button>';
    actBtn2 +=' <button type="button" class="delete btn btn-outline-primary"><i class="fa fa-trash"></i></button></div>';
    
    
    var $sspDTbl = $('#ssp-datatable')
    var table = $sspDTbl.DataTable({
        //stateSave: true,
        //fixedColumns: true,
        //fixedColumns: {rightColumns: 1},
        "scrollX": true,
        "processing": true,
        "serverSide": true,
        "order" : [],
        "ajax": base_url + '/dtsspctrl' ,
		
        "columns": [
            {'data':'id'},
            {'data':'name'},
            {'data':'email'}
        ]
    } );



	var $updateModal=$("#updateModal");
	$sspDTbl.on("click", ".update", function(){
	var data = table.row($(this).closest('tr')).data();
	
	$updateModal.modal("show")
	$updateModal.on("shown.bs.modal",function(){
	$("#id").val(data["id"]);
	$("#name").val(data["name"]);
	$("#email").val(data["email"]);
	$("#mobile").val(data["mobile"]);
	$("#desig").val(data["designation"]);
	});
	
	console.log(data);
	console.log(data["id"]);
	//alert(data["id"]+"\n"+data["name"]+"\n"+data["email"]+"\n"+data["mobile"]+"\n");
	});
	
	
});*/

		$(document).ready(function() {
			var base_url = "http://localhost:8080/ci4dt";
			$('#ssp-datatable').dataTable({
				processing:true,
				serverSide: true,
				"ajax": base_url + '/dtsspctrl' ,
				"columns": [
				{'data':'id'},
				{'data':'name'},
				{'data':'email'}
				]
			});
		});