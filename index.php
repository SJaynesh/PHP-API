<?php

include ("config/config.php");

$config = new Config();

/*
 superglobal variables => (Associative Array) (MAP / JSON DATA) (Key value pair)

 $_GET
 $_POST
 $_REQUEST
*/

$fetch_res = $config->fetch_students_data();

if (isset($_REQUEST['submit_btn'])) {
    $name = $_REQUEST['name'];
    $age = $_REQUEST['age'];
    $course = $_REQUEST['course'];

    $res = $config->insert($name, $age, $course);

    if ($res) {
        echo '<div class="container pt-5" > <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success !</strong> Data inseted successfully 😎
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> </div>';
    } else {
        echo '<div class="container pt-6" > <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed !</strong> Data insertion failed 😣
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> </div>';
    }

    $fetch_res = $config->fetch_students_data();


}

if (isset($_REQUEST['btn_delete'])) {
    $delete_id = $_REQUEST['delete_id'];

    $res = $config->delete($delete_id);

    if ($res) {
        echo '<div class="container pt-5" > <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success !</strong> Data deleted successfully 😎
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> </div>';
    } else {
        echo '<div class="container pt-6" > <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed !</strong> Data deletion failed 😣
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> </div>';
    }

    $fetch_res = $config->fetch_students_data();
}

$fetch_single_student_result = null;


if (isset($_REQUEST['btn_update'])) {
    $update_id = $_REQUEST['update_id'];

    $res = $config->fetch_single_student_data($update_id);
    $fetch_single_student_result = mysqli_fetch_assoc($res);
}

if (isset($_REQUEST['update_btn'])) {
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $age = $_REQUEST['age'];
    $course = $_REQUEST['course'];

    $res = $config->update($name, $age, $course, $id);

    if ($res) {
        echo '<div class="container pt-5" > <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success !</strong> Data Updated successfully 😎
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> </div>';
    } else {
        echo '<div class="container pt-6" > <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed !</strong> Data Updation failed 😣
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> </div>';
    }

    $fetch_res = $config->fetch_students_data();


}

?>

<!DOCTYPE html>
<html>
<head>
    <title> Student </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

    <body class="p-3 text-dark-emphasis bg-dark-subtle border border-dark-subtle rounded-3">

       

        <div class="container pt-5 " >
            <marquee > <h1 align="center"> PHP </h1> </marquee>
           <div class="col-4" >
            <form action="" method="POST"> 
                <input type="hidden" name="id" value="<?php if ($fetch_single_student_result != null) {
                    echo $fetch_single_student_result['id'];
                } ?>">
                    Name :  <input type="text" class="form-control"   name="name"   value="<?php if ($fetch_single_student_result != null) {
                        echo $fetch_single_student_result['name'];
                    } ?>" placeholder="Enter name.." > <br>
                    Age :  <input type="number" class="form-control"  name="age"    value="<?php if ($fetch_single_student_result != null) {
                        echo $fetch_single_student_result['age'];
                    } ?>" placeholder="Enter age.." ><br>
                    Course :  <input type="text" class="form-control" name="course" value="<?php if ($fetch_single_student_result != null) {
                        echo $fetch_single_student_result['course'];
                    } ?>" placeholder="Enter course.." ><br>
                    <button class="btn <?php if ($fetch_single_student_result == null) {
                        echo 'btn-success';
                    } else {
                        echo 'btn-warning';
                    } ?>" name="<?php if ($fetch_single_student_result == null) {
                         echo "submit_btn";
                     } else {
                         echo "update_btn";
                     } ?>"> 
                      <?php if ($fetch_single_student_result == null) { ?>  
                                    Add Student 
                      <?php } else { ?>
                                    Update Student
                      <?php } ?> 
                    </button>
                </form>
           </div>

           <br>
           <br>
           <br>

           <div class="col-6" >
           <table class="table table-hover table-bordered table-info">
                <thead class="text-center" > 
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>AGE</th>
                        <th>COURSE</th>
                        <th colspan="2" >ACTION</th>
                    </tr>
                </thead>
                <tbody class="text-center" >

                <?php while ($result = mysqli_fetch_assoc($fetch_res)) { ?>
                            <tr>
                                <td> <?php echo $result['id']; ?> </td>
                                <td> <?php echo $result['name'] ?> </td>
                                <td> <?php echo $result['age'] ?> </td>
                                <td> <?php echo $result['course'] ?> </td>
                                <td>  
                                        <form action="" method="POST">
                                            <input type="hidden" name="update_id" value="<?php echo $result['id'] ?>" >
                                            <button class="btn btn-warning" name="btn_update" > Edit </button>
                                        </form>
                                </td>
                                <td>  
                                        <form action="" method="POST">
                                            <input type="hidden" name="delete_id" value="<?php echo $result['id'] ?>" >
                                            <button class="btn btn-danger" name="btn_delete" > Delete </button>
                                        </form>
                                </td>
                            </tr>

                <?php } ?>
                </tbody>
            </table>
           </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>

