// $('#la_form, #sp_form').on('keyup',function() {
//     var a = $('#la_form').val();
//     var b = $('#sp_form').val();
//     a = a.replace(/,/g,"");
//     b = b.replace(/,/g,"");
//     $('#total_form').val((parseFloat(a) * parseFloat(b) ? parseFloat(a) * parseFloat(b) :0).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
//     //$('#purchase_price2').val((parseFloat(a) * parseFloat(b) ? parseFloat(a) * parseFloat(b) :0).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
// });

// computing total price by square meter
$("#la_form,#sp_form").keyup(function () {	
  $('#total_form').val($('#la_form').val() * $('#sp_form').val());
});
//end

// computing commission 
$("#com_amount,#com_percentage").keyup(function () {
  $('#total_com').val($('#com_amount').val() * $('#com_percentage').val());
});
//end

// computing notarial  fee 
$("#t_amount,#notary_percentage").keyup(function () {
  $('#total_notary').val($('#t_amount').val() * $('#notary_percentage').val());
});
//end

//compute debit and credit amount
// $("#debit_amount,#credit_amount").keyup(function () {  
//   $('#total').val($('#debit_amount').val() - $('#credit_amount').val());
// });
//end
