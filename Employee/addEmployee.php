<?php
include '../inc/header.php';

//Retrieve data from Category table into <Select>
$sql = "Select * from  Employee_Category;";
$exec = mysqli_query($con, $sql);
$results = mysqli_fetch_all($exec, MYSQLI_ASSOC);

//Store Textboxes into variables
$e_id = FILTER_INPUT(INPUT_POST, 'e_id', FILTER_SANITIZE_SPECIAL_CHARS);
$e_name = FILTER_INPUT(INPUT_POST, 'e_name', FILTER_SANITIZE_SPECIAL_CHARS);
$e_cat = FILTER_INPUT(INPUT_POST, 'Cat', FILTER_SANITIZE_SPECIAL_CHARS);
$e_date = FILTER_INPUT(INPUT_POST, 'e_date', FILTER_SANITIZE_SPECIAL_CHARS);
$e_picture = FILTER_INPUT(INPUT_POST, 'e_picture', FILTER_SANITIZE_SPECIAL_CHARS);
$e_email = FILTER_INPUT(INPUT_POST, 'e_email', FILTER_SANITIZE_SPECIAL_CHARS);
$err_Msg = '';
$add_Msg = '';



if (isset($_POST['add_Employee'])) {

  //Check if textboxes are empty and show error message
  if (empty($e_id) || empty($e_name)) {
    $err_Msg = 'Enter data';
  } else {
    $err_Msg = '';
  }

  //Allowed picture extensions
  $allowed = ['jpg', 'jpeg', 'png', 'tif', 'pdf'];

  if (!empty($_FILES['e_picture']['name'])) {
    //Define details of pic such as name , size, tmp location using $_File[]
    //Supper global

    $file_Name = $_FILES['e_picture']['name'];
    $file_Size = $_FILES['e_picture']['size'];
    $file_Tmp = $_FILES['e_picture']['tmp_name'];

    //Specify fold path to upload pics to
    $target_dir = "uploads/$file_Name";
    // Extract file extension from from file
    $file_ext = explode('.', $file_Name);

    //Convert file extensions to lower case
    $file_ext = strtolower(end($file_ext));

    //Check if file ext is allowed
    if (in_array($file_ext, $allowed)) {
      //uploading file
      move_uploaded_file($file_Tmp, $target_dir);
    } else {
      echo 'Invalid File'; //if file ext is not in allowed list
    }
  }

  // End of pic validation
  //add data to movie table
  $sql2 = "insert into Employee(Employee_ID,Employee_Name,Category_ID,DoB,Picture,Email) 
          values  ('$e_id','$e_name','$e_cat','$e_date','$target_dir','$e_email')";



  if (mysqli_query($con, $sql2)) //Connect to dabatase and run query
  {
    $add_Msg = 'Employee Added';
  } else {
    $add_Msg = 'Not Added' . mysqli_error($con);
  }
}
?>
<main>
  <div class="container d-flex flex-column align-items-center">
    <img src="logo.png" class="w-25 mb-3" alt="">
    <p class="lead text-center">Add New Emolyee</p>
    <p class="lead text-center" style="color:green"><?php echo $add_Msg; ?></p>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="mt-4 w-75" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="name" class="form-label">Employee_ID </label>
        <input type="text" class="form-control" id="e_id" name="e_id">
        <?php echo  $err_Msg; ?>
      </div>

      <div class="mb-3">
        <label for="name" class="form-label">Employee Name</label>
        <input type="text" class="form-control" id="e_name" name="e_name">
      </div>

      <div class="mb-3">

        <select name="Cat">
          <?php echo  $err_Msg; ?>
          <option>Select Department</option>
          <?php foreach ($results as $employee_Cat) :  ?>
            <option value='<?php echo $employee_Cat['Category_ID']; ?>'>
              <?php echo $employee_Cat['Category_Name']; ?>
            </option>
          <?php endforeach ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="Year" class="form-label">Date of Birth</label>
        <input type="Date" class="form-control" id="e_date" name="e_date">
      </div>

      <div class="mb-3">
        <label  class="form-label">Email</label>
        <input type="email" class="form-control" id="e_email" name="e_email">
        <?php echo  $err_Msg; ?>
      </div>

      <div class="mb-3">
        <input type="submit" name="add_Employee" value="Add Employee" class="btn btn-dark w-55">
          <a href="./list_Employees.php" class="btn  w-40 btn-light">List Employees</a>
        </div>
      </div>
    </form>
  </div>
</main>

<?php
include 'inc/footer.php';

?>