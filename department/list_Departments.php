<?php
include '../inc/header.php';

//View or Show all Movie categories
$sql = "Select * from Employee_Category";
$exec = mysqli_query($con, $sql);
$result = mysqli_fetch_all($exec, MYSQLI_ASSOC) //Store all data from category table into $result



?>
<div class="container d-flex flex-column align-items-center">

    <h2>List of Departments </h2>
    <a href="./add_Department.php" class="btn btn-light w-10">
        Create Department 
    </a>
    <br>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Department Id</th>
                <th>Department Name </th>



            </tr>
        </thead>
        <?php foreach ($result as $Cat) : ?>
            <tr>
                <td> <?php echo $Cat['Category_ID']; ?> </td>
                <td> <?php echo $Cat['Category_Name']; ?></td>
                <td>
                <a href="./delete_Department.php?delete=<?php echo $Cat['Category_ID']; ?>">
                   <button class="btn btn-danger" type="button"> 
                       Delete
                    </button>
                  </a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>

</div>

<?php
include 'inc/footer.php';

?>