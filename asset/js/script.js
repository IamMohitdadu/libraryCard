/*
  file-name: script.js
  used-for: index.php.
  created-by: Mohit Dadu
  date: 06/02/2017
*/


// Add Record 
function addRecord() {
    // get values
    var name = $("#name").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
 
    // Add record
    $.post("addRecord.php", {
        name: name,
        email: email,
        phone: phone
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");
 
        // clear fields from the popup
        $("#name").val("");
        $("#email").val("");
        $("#phone").val("");

        header("Location: index.php");
    });
}

/*
// READ records
function readRecord() {
    $.get("readRecord.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}

*/