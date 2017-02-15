/*
* file-name: libraryCard.js
* used-for: index.php and libraryCard.php.
* created-by: Mohit Dadu
* date: 06/02/2017
*/

/* function to add new records into the database.
   and name and email are of string and phone is of integer type. */
function addRecord(event) {

    // sanitizing the input values
    var name = $.trim($("#name").val());
    var email = $.trim($("#email").val());
    var phone = $.trim($("#phone").val());

    var errors = true;

    // validating the name 
    if(name.length < 2) {
        $("#name_error").html("Name must be more than 3 characters");
        $("#name_error").show();
        errors =  false;
    } else {
        $("#name_error").hide();
        errors =  true;
    }

    //validating the email address 
    var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,4}?$/);
    if(pattern.test(email)) {
        $("#email_error").hide();
        error = true;
    } else {
        $("#email_error").html(" Invalid email address.");
        $("#email_error").show();
        error = false;
    }

    //validating the phone number.
    if(phone.length != 10) {
        $("#phone_error").html("phone number must be of 10 digits");
        $("#phone_error").show();
        errors =  false;
    } else {
        $("#phone_error").hide();
        errors = true;
    }

    // storing the data after validation into the database.
    if (errors) {
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
}

/* function for cofirmation before detele of student records */
function confirmationDelete(anchor)
{
   var conf = confirm('Are you sure want to delete this record?');
   // after conformation, redirecting to provided page in anchor tag.
   if(conf)
      window.location=anchor.attr("href");
}

/* search and filter book through from html table. */
$(document).ready(function() {

    // search book through book name in search field. 
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

    // filteration through book category using select field.
    var rows = $("table#myTable tr:not(:first-child)");

    // when the select field is changed.
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


