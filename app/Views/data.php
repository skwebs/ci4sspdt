<!DOCTYPE html>
<html>

<head>
   <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1">
   <title>DataTables Server Side Ci4</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" />
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css" />
   <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/ont-awesome.min.css" />
   <link rel="stylesheet" href="https://cd.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" />
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

      /* Ensure that the demo table scrolls */
      th,
      td {
         white-space: nowrap;
      }

      div.dataTables_wrapper {
         width: 100%;
         margin: 0 auto;
      }
      
   </style>
</head>

<body>
   <div class="container-fluid mt-5">
      <div class="card">
         <div class="card-header text-muted text-center h4">Server Side Listing (Using SSP Library)</div>
         <div class="card-body">
            <table id="server-side-table-ssp" class="table table-striped table-border" style="width:100%">
               <thead>
                  <tr>
                     <th>UserID</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Mobile</th>
                     <th>Designation</th>
                     <th>Gender</th>
                     <th>Status</th>
                     
                  </tr>
               </thead>
            </table>
         </div>
      </div>
   </div>
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-html5-1.6.5/b-print-1.6.5/fc-3.3.2/datatables.min.js"></script>
   <!--<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
   <!--
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap4.min.js"></script>
-->
   <script>
        $(function() {
         if ($("#server-side-table-ssp").length > 0) {

            var table = $("#server-side-table-ssp").DataTable({
               scrollY: "300px",
               scrollX: true,
               scrollCollapse: true,
               paging: false,
               fixedColumns: {
                  leftColumns: 0,
                  rightColumns: 0
               },
               scrollX: true,
               processing: true,
               serverSide: true,
               ajax: "<?php echo site_url('list-data') ?>",
               dom: 'Bfrtip',
               /*buttons: [
	           /* {
                    extend: "copy",
                    exportOptions: {
                        columns: []
                    }
                },
                {
                    extend: "excel",
                    title: "client_side_data"
                },*
                {
                    extend: "csv",
                    title: "client_side_table_data"
                },
                {
                    extend: "pdf",
                    exportOptions: {
                        columns: ":visible"
                    }
                },
                'print'
            ]*/
            });

            /*$('#server-side-table-ssp tbody')
                .on( 'mouseenter', 'td', function () {
                    var colIdx = table.cell(this).index().column;

                    $( table.cells().nodes() ).removeClass( 'highlight' );
                    $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
                } );*/
         }
      });
   </script>
</body>

</html>