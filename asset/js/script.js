/*
  file-name: script.js
  used-for: Employee form creation Assignment for mindfire training session.
  created-by: Mohit Dadu
  description: the following file is for validating and generating table using jquery.
*/


$(function() {
 
  var ids = ["#usr", "#psd","#cnf-psd", "#lgr"];
  for (i = 0; i < ids.length; i++) {
    $(ids[i]).hide();  // for hiding paragraph which displays error on html page.
  }
  
  // submit form 
  $("#form-error").on('submit', function(event) {
    event.preventDefault();
    var chkr = validate();  // function call for form data validation.
    if (chkr) {
      generate_table(chkr);  // function call for generating table.
    }    
  });
  
// function for validation
function validate() {
  
  var emailid = $("#usr").val().length;
  var password = $("#psd").val().length;
  var cnf_password = $("#cnf-psd").val().length;
  var user_type = $("#lgr").val().length;

  if(emailid < 5) {
    $("#usr").show();
    return false;
  } else {
    $("#usr").hide();
  }

  if(password < 6) {
    $("#psd").show();
    return false;
  } else {
    $("#psd").hide();
  }
  
  if(cnf_password != password) {
    $("#cnf-psd").show();
    return false;
  } else {
    $("#cnf-psd").hide();
  }
  return true;
}

