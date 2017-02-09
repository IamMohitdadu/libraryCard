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
        
        //to read the records from database
        //readRecord();
        
        // clear fields from the popup
        $("#name").val("");
        $("#email").val("");
        $("#phone").val("");

    });
}


// remove the issued book from card. Here id is of integer type.
function deleteIssuedBook(id) {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.open("GET", "deleteIssuedBook.php?id=" + id, true);
    xmlhttp.send();
}

// search the book from database. str is of string type.
function showResult(str) {
    if (str.length==0) { 
        document.getElementById("livesearch").innerHTML="";
        document.getElementById("livesearch").style.border="0px";
        return;
    }
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("livesearch").innerHTML=this.responseText;
          document.getElementById("livesearch").style.border="1px solid #A5ACB2";
        }
    }
    xmlhttp.open("GET","livesearch.php?name=" + str, true);
    xmlhttp.send();
}

/*
// READ records
function readRecord() {
    $.get("readRecord.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}

*/
