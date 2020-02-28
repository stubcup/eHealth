
    <button class="btn blue lighten-2 waves-effect waves-dark eound-btn" id="btn_new_student">Add New Student</button>
    <button class="btn blue lighten-2 waves-effect waves-dark eound-btn" id="btn_sammury">View Sammury</button>
    <button class="btn blue lighten-2 waves-effect waves-dark eound-btn" id="btn_print">Print Table</button>
    
    <div class="row">
        <div class="input-field col-xs-6">
            <input type="number" name="stdNo" id="stdNo">
            <label for="stdNo">Student Number</label>
        </div>
        <div class="input-field col-xs-6">
            <input type="text" name="sname" id="sname">
            <label for="sname">Surname</label>
        </div>
    </div>
    <br><br>

    
    <span id="tableCont"></span>


<span id="result"></span>

<script>
    $('#btn_print').click(function(e) {
        e.preventDefault();
        var mode = 'iframe';
        var close = mode == "popup";
        var options = {
            mode: mode,
            popClose: close
        };

        $('#tableCont').printArea(options);
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

    $('#stdNo').keyup(function (e) { 
        search();
    });


    $('#sname').keyup(function (e) { 
        search();
    });
        search();

</script>