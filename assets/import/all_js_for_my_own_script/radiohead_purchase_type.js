$(document).ready(function () {

$('#pr_meter').attr('disabled', true);
$('#pur_price').attr('disabled', true);
$('#lot_area').attr('disabled', true);

$('#radiohead input').on('change', function() {
    //alert($(this).val());
    if ($('input[name=pack]:checked', '#radiohead').val() == $('.p_type').val()) {
        //alert("sadf");
        // package
        $('#pr_meter').attr('disabled', true);
        $('#pur_price').attr('disabled', false);
        $('#lot_area').attr('disabled', false);
        $('#pr_meter').val('');
        $('#pur_price').val('');
        $('#lot_area').val('');
        /*$('#price2').val('');
        $('#price1').val('');
        $('#price3').val('');*/
    }
    else{
        // per/sq_m
        $('#pur_price').attr('disabled', true);
        $('#pr_meter').attr('disabled', false);
        $('#lot_area').attr('disabled', false);
        $('#pr_meter').val('');
        $('#pur_price').val('');
        $('#lot_area').val('');
        /*$('#price2').val('');
        $('#price1').val('');
        $('#price3').val('');*/
    }

  });

});