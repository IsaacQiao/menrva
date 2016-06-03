<?php require_once("../includes/session.php"); ?>
<?php require_once('../includes/db_connection.php'); ?>
<?php require_once('../includes/functions.php'); ?>

<?php

  if (isset($_POST['submit'])) {
    //Process the form

    $menu_name = mysql_prep(trim($_POST["menu_name"]));
    $position = (int) trim($_POST["position"]);
    $visible = (int) trim($_POST["visible"]);

    $query = 'INSERT INTO ';
    $query .= 'subjects ';
    $query .= '(menu_name, position, visible) ';
    $query .= "VALUES ('{$menu_name}', {$position}, {$visible})";
    $result = mysqli_query($connection, $query);
    // reslut will be a special kind of object called a resource
    // collection of DB rows

    if ($result) {
        //Success
        $_SESSION["message"] = "subject created";
        redirect_to("manage_content.php");
    } else {
        // Fail
        $_SESSION["message"] = "subject creation failed";
        redirect_to("new_subject.php");
    }


  }else {
    redirect_to("new_subject.php");
  }

?>




<?php
  if (isset($connection)) {mysqli_close($connection);}
?>
