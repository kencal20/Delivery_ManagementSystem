<?php
include '../inc/header.php';

//Store Textbox data in to variables
$cat_Id = FILTER_INPUT(INPUT_POST, 'mc_id', FILTER_SANITIZE_SPECIAL_CHARS);
$cat_Name = FILTER_INPUT(INPUT_POST, 'mc_name', FILTER_SANITIZE_SPECIAL_CHARS);
$sql = "insert into movie_categories(Category_Name) values($cat_Name)";
$err_Msg = '';
$add_Msg = '';

if (isset($_POST['add_Category'])) {
  //Check if textboxes are empty and show error message
  if (empty($cat_Id) || empty($cat_Name)) {
    $err_Msg = 'Enter data';
  } else {
    $err_Msg = '';
  }

  //Add record to the data
  $sql = "insert into  Employee_Category values ($cat_Id,'$cat_Name')";
  //var_dump($sql);
  if (mysqli_query($con, $sql)) //Connect to dabatase and run query
  {
    $add_Msg = 'Departmnet Added ';
  } else {
    $add_Msg = 'Not Added ' . mysqli_error($con);
  }
}
?>
<main>
  <div class="container d-flex flex-column align-items-center">
    <img src="logo.png" class="w-25 mb-3" alt="">
   
    <p class="lead text-center">Add New Department</p>

    <span class="lead text-center" style="color:green; font-family:tahoma;">
      <?php echo $add_Msg; ?>
    </span>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="mt-4 w-75">

      <div class="mb-3">

        <label for="name" class="form-label">Enter Department ID</label>
        <input type="text" class="form-control" id="mc_id" name="mc_id" >
        <span style="color:red; font-family:tahoma;"><?php echo $err_Msg; ?></span>
      </div>

      <div class="mb-3">
        <label for="name" class="form-label">Enter Department Name</label>
        <input type="text" class="form-control" id="mc_name" name="mc_name" >
        <span style="color:red; font-family:tahoma;"><?php echo $err_Msg; ?></span>
      </div>

      <div class="mb-3 ">
        <input type="submit" name="add_Category" value="Add Departments" class="btn btn-dark w-100">
        <br/>
        <br/>
        <a href="./list_Departments.php"  class=" btn btn-success align-items-center  w-50">
       LIST DEPARTMENTS
        </a>
        <a href="../Employee/addEmployee.php"  class=" btn btn-primary align-items-center  w-40">
       ADD EMPLOYEE
        </a>
      </div>
    </form>
  </div>
</main>

<?php
include 'inc/footer.php';

?>