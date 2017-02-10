/*
  file-name: script.js
  used-for: index.php.
  created-by: Mohit Dadu
  date: 06/02/2017
*/


// function for cofirmation before detele of student records
function confirmationDelete(anchor)
{
   var conf = confirm('Are you sure want to delete this record?');
   if(conf)
      window.location=anchor.attr("href");
}


// function to add new records 
function addRecord() {
    // get values
    var name = $.trim($("#name").val());
    var email = $.trim($("#email").val());
    var phone = $.trim($("#phone").val());
 
    // Add record
    $.post("addRecord.php", {
        name: name,
        email: email,
        phone: phone
    }, function (data, status) {
        // close the popup modal
        $("#add_new_record_modal").modal("hide");

        // clear fields from the popup
        $("#name").val("");
        $("#email").val("");
        $("#phone").val("");
        location.reload(true);
    });
}


// function to search book through book name from html table.
$(document).ready(function() {
    $(".search").on("keyup",function(){
        var searchValue = $(this).val().toLowerCase();
        $("#myTable tr").each(function(){
            var lineStr = $(this).text().toLowerCase();
            if(lineStr.indexOf(searchValue) === -1){
                $(this).hide();
            } else {
                $(this).show();
            }
        }); 
    });
});


// function to filter through book category.
$(document).ready(function() {
    var rows = $("table#myTable tr:not(:first-child)");

    $("#select_field").on("change",function(){
        var selected = this.value;
        if(selected != "All"){
            rows.filter("[category="+selected+"]").show();
            rows.not("[category="+selected+"]").hide();

        } else {
            rows.show();
        }
    });
});


