 document.addEventListener("DOMContentLoaded", function(event) { 

          var id = $("#id_n").attr("value");
          $('#myModal1_'+id).on('show.bs.modal', function () {
            var anim = "flipInX";
                // testAnim(anim);
                $('.modal .modal-dialog').attr('class', 'modal-dialog ' + anim + ' animated ');
          });
          $('#myModal1_'+id).on('hide.bs.modal', function () {
            var anim = "flipOutX";
                // testAnim(anim);
                $('.modal .modal-dialog').attr('class', 'modal-dialog ' + anim + ' animated ');
          });
  });