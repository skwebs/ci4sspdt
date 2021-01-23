<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Codeigniter 4 Server Side DataTable Tutorial - Online Web Tutor</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>
</head>

<body>
  <div class="container">

    <br/>
    <h2>Codeigniter 4 Server Side DataTable Tutorial</h2>
    <br/>
    <table class="table table-striped" id="tbl-students-data">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Mobile</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  
  <script>

    var site_url = "<?php echo site_url(); ?>";

    $(document).ready( function () {

        $('#tbl-students-data').DataTable({
          lengthMenu: [[ 10, 30, -1], [ 10, 30, "All"]], // page length options
          bProcessing: true,
          serverSide: true,
          scrollY: "400px",
          scrollCollapse: true,
          ajax: {
            url: site_url + "/ajax-load-data", // json datasource
            type: "post",
            data: {
              // key1: value1 - in case if we want send data with request
            }
          },
          columns: [
            { data: "id" },
            { data: "name" },
            { data: "email" },
            { data: "mobile" }
          ],
          columnDefs: [
            { orderable: false, targets: [0, 1, 2, 3] }
          ],
          bFilter: true, // to display datatable search
        });
    });
  </script>
</body>

</html>