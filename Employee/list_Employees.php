<?php
include '../inc/header.php';

session_start(); //to get to edit & delete pages with specific movie id

//View or Show all Movie categories
    $sql = "Select * from Employee natural Join Employee_Category";
    $exec = mysqli_query($con, $sql);
    $result = mysqli_fetch_all($exec, MYSQLI_ASSOC); //Store all data from category table into $result

?>
<?php if (empty($result)) : ?>
    <h1> <?php echo 'No Movies found'; ?></h1>
  
<?php endif ?>

<div class="container d-flex flex-column align-items-center">
<h2>List of Employees </h2>
<a href="./addEmployee.php" class="btn btn-primary">Add New Employee</a>
<br>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Employee_ID</th>
            <th>Employee Name</th>
            <th>Department Name</th>
            <th>Date of Birth</th>
            <th>EMAIL</th>
            
            <th>Action</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $employee) : ?>
            <tr>

                <td> <?php echo $employee['Employee_ID']; ?> </td>
                <td><?php echo $employee['Employee_Name']; ?> </td>
                <td><?php echo $employee['Category_Name']; ?> </td>
                <td><?php echo $employee['DoB']; ?> </td>
                <td><?php echo $employee['Email']; ?> </td>
                <td>
                <!-- <a href="./edit_Employee.php?edit=<?php echo $employee['Employee_ID']; ?>">
                   <button class="btn btn-primary" type="button">
                      Edit
                   </button>
                  </a> -->
                  <a href="./delete_Employee.php?delete=<?php echo $employee['Employee_ID']; ?>">
                   <button class="btn btn-danger" type="button"> 
                       Delete
                    </button>
                  </a>
                </td>

            </tr>
        <?php endforeach ?>

    </tbody>
</table>
</div>
<?php
include 'inc/footer.php';

?>