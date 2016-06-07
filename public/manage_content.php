<?php require_once("../includes/session.php"); ?>
<?php require_once('../includes/db_connection.php'); ?>
<?php require_once('../includes/functions.php'); ?>
<?php include('../includes/layouts/header.php'); ?>
<?php find_select_page(); ?>

<div id="main">
  <div id="navigation">
    <br/>
    <a href="admin.php">&laquo; Main Menu</a><br/>
    <?php echo navigation($current_subject, $current_page); ?>
    <a href="new_subject.php">+ Add a subject</a>

  </div>
  <div id="page">
    <?php echo message(); ?>
    <?php if ($current_subject) { ?>
      <h2>Manage Subject</h2>
      Menu Name: <?php echo htmlentities($current_subject["menu_name"]);?><br/>
      Position: <?php  echo $current_subject["position"];?><br/>
      Visible: <?php echo $current_subject["visible"]==1?'yes':'no';?><br/>
      <br/>
      <a href="edit_subject.php?subject=<?php echo urlencode($current_subject["id"]);?>">Edit Subject</a>
      <br/><br/>
      <h3>Pages in this subject:</h3>
      <ul>
        <?php
          $page_set = find_pages_for_subject($current_subject["id"]);
          while($page = mysqli_fetch_assoc($page_set)) {
            echo "<li><a href=\"manage_content.php?page=".urlencode($page["id"])."\">".htmlentities($page["menu_name"])."</a></li>";
          }
        ?>
      </ul>
      + <a href="new_page.php?subject=<?php echo urlencode($current_subject["id"]);?>">Add a new page to this subject</a>


    <?php }elseif ($current_page) { ?>
      <h2>Manage Page</h2>
      Page Name: <?php echo htmlentities($current_page["menu_name"]); ?><br/>
      Position: <?php  echo $current_page["position"];?><br/>
      Visible: <?php echo $current_page["visible"]==1?'yes':'no';?><br/>
      Content: <br/>
      <div class="view-content">
        <?php echo htmlentities($current_page["content"]);?>
      </div>
      <br/>
      <a href="edit_page.php?page=<?php echo urlencode($current_page["id"]);?>">Edit Page</a>
    <?php }else { ?>
      Select something from the left
    <?php }?>
  </div>
</div>
<?php include('../includes/layouts/footer.php'); ?>
