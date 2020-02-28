    <table class="highlight">
        <thead>
            <tr>
                <th>Date</th>
                <th>Hour</th>
                <th>Bus</th>
                <th>Driver</th>
                <th>Departure</th>
                <th>Destination</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            <?php

            $errors = array();
            include('connect.php');

            $v_date = $_POST['v_dater'];
            $v_bus = $_POST['v_bus'];
            $v_id = $_POST['v_id'];

            if (empty($v_date) && empty($v_bus) && empty($v_id)) {
                $query = "SELECT * FROM schedule";
            } elseif (!empty($v_date) && empty($v_bus) && empty($v_id)) {
                $query = "SELECT * FROM schedule WHERE `schedule_date` LIKE '%$v_date'";
            } elseif (empty($v_date) && !empty($v_bus) && empty($v_id)) {
                $query = "SELECT * FROM schedule WHERE `bus` LIKE '%$v_bus%'";
            } elseif (empty($v_date) && empty($v_bus) && !empty($v_id)) {
                $query = "SELECT * FROM schedule WHERE `driver` LIKE '%$v_id'";
            } elseif (!empty($v_date) && !empty($v_bus) && empty($v_id)) {
                $query = "SELECT * FROM schedule WHERE (`schedule_date` LIKE '%$v_date') AND (`bus` LIKE '%$v_bus%')";
            } elseif (!empty($v_date) && empty($v_bus) && !empty($v_id)) {
                $query = "SELECT * FROM schedule WHERE (`schedule_date` LIKE '%$v_date') AND (`driver` LIKE '%$v_id')";
            } elseif (empty($v_date) && !empty($v_bus) && !empty($v_id)) {
                $query = "SELECT * FROM schedule WHERE (`bus` LIKE '%$v_bus%') AND (`driver` LIKE '%$v_id')";
            } elseif (!empty($v_date) && !empty($v_bus) && !empty($v_id)) {
                $query = "SELECT * FROM schedule WHERE (`schedule_date` LIKE '%$v_date') AND (`bus` LIKE '%$v_bus%') AND (`driver` LIKE '%$v_id')";
            }

            $result = mysqli_query($db, $query);

            if ($result) :

                if (mysqli_num_rows($result) == 0) {
                    echo ('<h4>No Schedules Found');
                }


                while ($row = mysqli_fetch_array($result)) {

                    $driver = $row['driver'];

                    $query1 = "SELECT * FROM driver WHERE `driverID` = '$driver'";
                    $result1 = mysqli_query($db, $query1);

                    if ($result1) {

                        while ($row1 = mysqli_fetch_array($result1)) {
                            $name = $row1['sname'] . ' ' . $row1['name'];
                            $raw_time = $row['time'];
                            $bus = $row['bus'];
                            $scheduleID = $row['scheduleID'];
                        }

                        if (strlen($raw_time) == 1) {
                            $time = "0" . $raw_time . "H00";
                        } else {
                            $time = $raw_time . "H00";
                        }
                    }
                    ?>
            <tr id="<?php echo ($scheduleID); ?>">
                <td><b><?php echo ($row['schedule_date']); ?><b></td>
                <td><?php echo ($time); ?></td>
                <td><?php echo ($bus); ?></td>
                <td><?php echo ($name); ?></td>
                <td><?php echo ($row['from']); ?></td>
                <td><?php echo ($row['to']); ?></td>
                <td>
                    <button class="btn red lighten-2 waves-effect waves-dark round-btn" onclick="delete_schedule('<?php echo ($driver); ?>', '<?php echo ($bus); ?>','<?php echo ($scheduleID); ?>');">Remove</button>
                </td>
            </tr>
            <?php 
        } ?>
            <?php endif ?>

        </tbody>
    </table>
    <span id="result"></span>

    <script type="text/javascript">
        $('.modal').modal();

        function delete_schedule(driver, bus, id) {

            var dater = $('#dater').val();

            var dlt_q = confirm("Are you sure you want to delete schedule?");

            if (dlt_q == true) {
                $.ajax({
                    type: "post",
                    url: "mod/unschedule.php",
                    data: {
                        dater: dater,
                        id: id,
                        driver: driver,
                        bus: bus
                    },
                    success: function(response) {
                        $("#" + id).remove();
                        $('#result').html(response);
                    }
                });
            }
        };


        function edit_schedule(driver, bus, id) {
            $('#modal1').modal('open');

            $('#mod_driver').html(driver);
            $('#mod_bus').html(bus);
            $('#mod_id').html(id);
        }

        function update_schedule() {
            var driver = $('#mod_driver').html();
            var bus = $('#mod_bus').html();
            var id = $('#mod_id').html();

            var update_driver = $('#update_driver select').val();
            var update_bus = $('#update_bus select').val();

            $.ajax({
                type: "post",
                url: "update_schedule.php",
                data: {
                    driver: driver,
                    bus: bus,
                    id: id,
                    update_driver: update_driver,
                    update_bus: update_bus
                },
                success: function(response) {
                    $('#result').html(response);
                }
            });
        }
    </script> 