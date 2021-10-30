<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Student List</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Student</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone No.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($students as $stu) { ?>
                            <tr>
                                <td><?php echo $stu['id']; ?></td>
                                <td><?php echo $stu['name']; ?></td>
                                <td><?php echo $stu['phone_no']; ?></td>
                            </tr>
                         <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2>classes</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($classes as $cla) { ?>
                            <tr>
                                <td><?php echo $cla['id']; ?></td>
                                <td><?php echo $cla['name']; ?></td>
                            </tr>
                            
                         <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2>Batch</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Class ID</th>
                            <th>Batch</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($batches as $bat) { ?>
                            <tr>
                                <td><?php echo $bat['id']; ?></td>
                                <td>
                                    <?php 
                                         if ( $cla['id'] == $bat["class_id"] ) {
                                             $class = $cla["name"];
                                         }
                                         echo $bat["$class"];
                                        echo $cal["name"];
                                    ?>
                                    <?php
                                      echo $bat[$class];
                                     ?>
                                </td>
                                <td><?php echo $bat['batch']; ?></td>
                            </tr>
                         <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2>Students Batch</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student ID</th>
                            <th>Batch Id</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($student_batch as $stu_bat) { ?>
                            <tr>
                                <td><?php echo $stu_bat['id']; ?></td>
                                <td><?php echo $stu_bat['student_id']; ?></td>
                                <td><?php echo $stu_bat['batch_id']; ?></td>
                            </tr>
                         <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>