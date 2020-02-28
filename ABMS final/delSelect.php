
<script>
function search() {
    var stdNo = $('#stdNo').val();
    var sname = $('#sname').val();

    $.ajax({
        type: "post",
        url: "studentSearch.php",
        data: {stdNo: stdNo, sname: sname},
        success: function (response) {
            $('#tableCont').html(response);
        }
    });
}
</script>
<?php

include('connect.php');


$page = isset($_GET['p'])? $_GET['p']: '';

if ($page == 'del') {
    $myStd = $_POST['id'];
    $std = str_replace(' ', ',', $myStd);
    
    $query = "UPDATE student SET `deleted` = '1' WHERE `studentID` IN ($std)";
    $result = mysqli_query($db, $query);
    
    if ($result) {
        echo('<script>alert("Selection Successfully Deleted "); search();</script>');
    }else {
        echo('<script>alert("Selection was not Successfully Deleted ");</script>');
    }
}
?>