$(document).ready(function() {
        $('#examplecdn').DataTable( {
              dom: 'Bfrtip',
              buttons: [
                   'copy', 'csv', 'excel', 'pdf','print'
              ]
        } );
      } );