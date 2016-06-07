<?php require_once("../includes/session.php"); ?>
<?php require_once('../includes/db_connection.php'); ?>
<?php require_once('../includes/functions.php'); ?>
<?php require_once('../includes/validation_functions.php'); ?>

<?php find_select_page(); ?>

<?php
  if (!$current_subject) {
    // subject id was missing or invalid or couldnt be found in DB
    redirect_to("manage_content.php");
  }
?>

<?php

  if (isset($_POST['submit'])) {
    //Process the form

    // validations
    $required_fields = array("menu_name", "position", "visible", "content");
    validate_presences($required_fields);
    $field_with_max_lengths = array("menu_name" => 30);
    validate_max_lengths($field_with_max_lengths);

    if (empty($errors)) {
      // peform update

      $subject_id = $current_subject["id"];
      $menu_name = mysql_prep($_POST["menu_name"]);
      $position = (int) $_POST["position"];
      $visible = (int) $_POST["visible"];
      $content = mysql_prep($_POST["content"]);

      $query = 'INSERT INTO ';
      $query .= 'pages ';
      $query .= '(subject_id, menu_name, position, visible, content) ';
      $query .= "VALUES ({$subject_id}, '{$menu_name}', {$position}, {$visible}, '{$content}')";
      $result = mysqli_query($connection, $query);
      // reslut will be a special kind of object called a resource
      // collection of DB rows

      if ($result) {
          //Success
          $_SESSION["message"] = "page created";
          redirect_to("manage_content.php?subject=" . urlencode($current_subject["id"]));
      } else {
          // Fail
          $message = "page creation failed";
      }
    }

  }else {
    //do the bottom
  }//end of if (isset......)

?>

<?php include('../includes/layouts/header.php'); ?>

<div id="main">
  <div id="navigation">
    <?php echo navigation($current_subject, $current_page); ?>
  </div>
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    <h2>Create Page</h2>
		<form action="new_page.php?subject=<?php echo urlencode($current_subject["id"]);?>" method="post">
		  <p>Menu name:
		    <input type="text" name="menu_name" value="" />
		  </p>
		  <p>Position:
		    <select name="position">
				<?php
					$page_set = find_pages_for_subject($current_subject["id"]);
					$page_count = mysqli_num_rows($page_set);
					for($count=1; $count <= ($page_count + 1); $count++) {
						echo "<option value=\"{$count}\">{$count}</option>";
					}
				?>
		    </select>
		  </p>
		  <p>Visible:
		    <input type="radio" name="visible" value="0" /> No
		    &nbsp;
		    <input type="radio" name="visible" value="1" /> Yes
		  </p>
      <p>Content:<br/>
        <textarea name="content" cols="100" rows="20" > </textarea><br/>
      </P>
		  <input type="submit" name="submit" value="Create Page" />
		</form>
    <br/>
    <a href="manage_content.php?subject=<?php echo urlencode($current_subject["id"]); ?>">Cancel</a>
  </div>
</div>
<?php include('../includes/layouts/footer.php'); ?>