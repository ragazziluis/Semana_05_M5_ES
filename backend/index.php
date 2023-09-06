<?php include "../inc/dbinfo.inc"; ?>
<html>
<body>
<h1>Sample page</h1>
<?php
  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_conn>
  $database = mysqli_select_db($connection, DB_DATABASE);
  /* Ensure that the EMPLOYEES table exists. */
  VerifyEmployeesTable($connection, DB_DATABASE);
  /* Ensure that the FERIADAO table exists. */
  VerifyFeriadaoTable($connection, DB_DATABASE);

  /* If input fields are populated, add a row to the EMPLOYEES table. */
  $employee_name = htmlentities($_POST['NAME']);
  $employee_address = htmlentities($_POST['ADDRESS']);

  /* If input fields are populated, add a row to the FERIADAO table. */
  $feriadao_name = htmlentities($_POST['NAME2']);
  $feriadao_local = htmlentities($_POST['LOCAL']);

  if (strlen($employee_name) || strlen($employee_address)) {
    AddEmployee($connection, $employee_name, $employee_address);
  }

  if (strlen($feriadao_name) || strlen($feriadao_local)) {
    AddFeriadao($connection, $feriadao_name, $feriadao_local);
  }

?>
<!-- Input form for EMPLOYEES -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>NAME</td>
      <td>ADDRESS</td>
    </tr>
    <tr>
    <td>
        <input type="text" name="NAME" maxlength="45" size="30" />
      </td>
      <td>
        <input type="text" name="ADDRESS" maxlength="90" size="60" />
      </td>
      <td>
        <input type="submit" value="Add Data" />
      </td>
    </tr>
  </table>
</form>

<!-- Input form for FERIADAO -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>NAME2</td>
      <td>LOCAL</td>
      </tr>
    <tr>
      <td>
        <input type="text" name="NAME2" maxlength="45" size="30" />
      </td>
      <td>
        <input type="text" name="LOCAL" maxlength="90" size="60" />
      </td>
      <td>
        <input type="submit" value="Add Data" />
      </td>
    </tr>
  </table>
</form>

<!-- Display table data for EMPLOYEES -->
<h2>EMPLOYEES</h2>
<table border="1" cellpadding="2" cellspacing="2">
  <tr>
  <td>ID</td>
    <td>NAME</td>
    <td>ADDRESS</td>
  </tr>
<?php
$result = mysqli_query($connection, "SELECT * FROM EMPLOYEES");
while($query_data = mysqli_fetch_row($result)) {
  echo "<tr>";
  echo "<td>",$query_data[0], "</td>",
       "<td>",$query_data[1], "</td>",
       "<td>",$query_data[2], "</td>";
  echo "</tr>";
}
?>
</table>

<!-- Display table data for FERIADAO -->
<h2>FERIADAO</h2>
<table border="1" cellpadding="2" cellspacing="2">
<tr>
    <td>ID</td>
    <td>NAME2</td>
    <td>LOCAL</td>
  </tr>
<?php
$result2 = mysqli_query($connection, "SELECT * FROM FERIADAO");
while($query_data2 = mysqli_fetch_row($result2)) {
  echo "<tr>";
  echo "<td>",$query_data2[0], "</td>",
       "<td>",$query_data2[1], "</td>",
       "<td>",$query_data2[2], "</td>";
  echo "</tr>";
}
?>
</table>



<!-- Clean up. -->
<?php
  mysqli_free_result($result);
  mysqli_close($connection);
?>

</body>
</html>

<?php

/* Add an employee to the table. */
function AddEmployee($connection, $name, $address) {
   $n = mysqli_real_escape_string($connection, $name);
   $a = mysqli_real_escape_string($connection, $address);
   $query = "INSERT INTO EMPLOYEES (NAME, ADDRESS) VALUES ('$n', '$a');";
   if(!mysqli_query($connection, $query)) echo("<p>Error adding employee data.<>
}

/* Check whether the table exists and, if not, create it. */
function VerifyEmployeesTable($connection, $dbName) {
  if(!TableExists("EMPLOYEES", $connection, $dbName))
  {
     $query = "CREATE TABLE EMPLOYEES (
         ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         NAME VARCHAR(45),
         ADDRESS VARCHAR(90)
       )";
     if(!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>">
  }
}
/* Add an employee to the table. */
function AddFeriadao($connection, $name, $local) {
    $n = mysqli_real_escape_string($connection, $name);
    $a = mysqli_real_escape_string($connection, $local);

    $query = "INSERT INTO FERIADAO (NAME, LOCAL) VALUES ('$n', '$a');";

    if(!mysqli_query($connection, $query)) echo("<p>Error adding employee data.>
 }

 /* Check whether the table exists and, if not, create it. */
 function VerifyFeriadaoTable($connection, $dbName) {
   if(!TableExists("FERIADAO", $connection, $dbName))
   {
      $query = "CREATE TABLE FERIADAO (
          ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          NAME VARCHAR(45),
          LOCAL VARCHAR(90)
        )";

      if(!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>>
   }
 }
/* Check for the existence of a table. */
function TableExists($tableName, $connection, $dbName) {
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);
  $checktable = mysqli_query($connection,
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t'>
  if(mysqli_num_rows($checktable) > 0) return true;
  return false;
}
?>