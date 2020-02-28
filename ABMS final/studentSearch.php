<button id="delSelect" class="btn red lighten-2 waves-effect waves-dark  card"><i class="fa fa-user-times"></i> Delete Selected</button>

<table class="bordered" id="std_table">
    <thead class="grey darken-4 white-text" style="border-bottom: #08acea medium solid; border-top: #08acea medium solid;">
        <tr>
            <th>
                <label>
                    <input type="checkbox" id="checkAll" id="" value="<?php echo ($row['studentID']); ?>">
                    <span>All</span>
                </label>
            </th>
            <th>Student Number</th>
            <th>Surname</th>
            <th>Initials</th>
            <th>Bus User</th>
            <th>Delete</th>
            <th>Profile</th>
        </tr>
    </thead>
<?php

include('connect.php');

$stdNo = $_POST['stdNo'];
$sName = $_POST['sname'];

if (empty($stdNo) && empty($sName)) {
    $query = "SELECT * FROM student WHERE `role` = '3' AND `deleted` = '0'  ORDER BY `sname` ASC";
}else {
    if (empty($stdNo) && !empty($sName)) {


        $sName = strip_tags($sName);
        $sName = $db->real_escape_string($sName);

        strtoupper($sName);
        $query = "SELECT * FROM student WHERE `sname` LIKE '%$sName%'  ORDER BY `sname` ASC";

    }elseif (!empty($stdNo) && empty($sName)) {


        $stdNo = strip_tags($stdNo);
        $stdNo = $db->real_escape_string($stdNo);

        strtoupper($stdNo);
        $query = "SELECT * FROM student WHERE `studentID` LIKE '%$stdNo%'  ORDER BY `sname` ASC";
    }elseif (!empty($stdNo) && !empty($sName)) {

        $stdNo = strip_tags($stdNo);
        $stdNo = $db->real_escape_string($stdNo);

        $sName = strip_tags($sName);
        $sName = $db->real_escape_string($sName);

        strtoupper($sName);
        $query = "SELECT * FROM student WHERE `sname` LIKE '%$sName%' AND  `studentID` LIKE '%$stdNo' ORDER BY `sname` ASC";
    }
}


$result = mysqli_query($db, $query);


if ($result) : ?>
    <tbody>
    <?php if (mysqli_num_rows($result) > 0) : ?>
   <?php while ($row = mysqli_fetch_array($result)) :
    if (empty($row['passW'])) {
        $bg = "white";
        $user = "No";
    } else {
        $bg = "grey lighten-4";
        $user = "Yes";
    }
    ?>
    
        <tr class="<?php echo ($bg); ?>">
            <td>
                <label>
                    <input type="checkbox" class="checkItem" id="" value="<?php echo ($row['studentID']); ?>">
                    <span></span>
                </label>
            </td>
            <td id="studentID"><?php echo ($row['studentID']); ?></td>
            <td id="sname"><?php echo ($row['sname']); ?></td>
            <td id="name"><?php echo ($row['name']); ?></td>
            <td id="user"><?php echo ($user); ?></td>
            <td><button onclick="studentDelete('<?php echo ($row['studentID']); ?>')" class="btn red lighten-2 waves-effect waves-dark round-btn"><i class="fa fa-user-times"></i> Delete</button></td>
            <td><button onclick="v_profile('<?php echo ($row['studentID']); ?>')" class="btn blue lighten-2 waves-effect waves-dark round-btn"><i class="fa fa-user"></i> More Info</button></td>
        </tr>
    <?php endwhile ?>
    <?php endif ?>
    <tbody>
</table>
<?php endif ?>

<script>

    $('#checkAll').change(function() {
        $('.checkItem').prop("checked", $(this).prop("checked"))
    });

    function v_profile(userID) {
        $.ajax({
            type: "post",
            url: "student_profile.php",
            data: {
                userID: userID
            },
            success: function(response) {
                $('.modal').modal('open');
                $('#mod_content').html(response);
            }
        });
    }

    function studentDelete(id) {
        var dlt_q = confirm("Are you sure you want to delete student " + id + " ?");

        if (dlt_q == true) {

            $.ajax({

                type: "post",
                url: "deleteStudent.php",
                data: {
                    id: id
                },
                success: function(response) {
                    $("#" + id).remove();
                    $('#result').html(response);
                }
            });
        }
    }

    $('#delSelect').click(function (e) { 
        e.preventDefault();
        var id = $('.checkItem:checked').map(function() {
            return $(this).val()
        }).get().join(' ')
        $.post('delSelect.php?p=del', {id: id}, function(response) {
            $('#result').html(response);
        })
    });

    $('#btn_new_student').click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "mod/add_student.php",
            success: function(response) {
                $('#mod_content').html(response);
                $('#adm_mod').modal('open');
            }
        });
    });

    $('#btn_sammury').click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "studentSammury.php",
            success: function(response) {
                $('#mod_content').html(response);
                $('#adm_mod').modal('open');
            }
        });
    });

</script>