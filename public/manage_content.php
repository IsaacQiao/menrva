<?php require_once('../includes/db_connection.php'); ?>
<?php require_once('../includes/functions.php'); ?>
<?php include('../includes/layouts/header.php'); ?>
<?php find_select_page(); ?>

<div id="main">
  <div id="navigation">
    <?php echo navigation($current_subject, $current_page); ?>
  </div>
  <div id="page">
    <?php if ($current_subject) { ?>
      <h2>Manage Subject</h2>
      Menu Name: <?php echo $current_subject["menu_name"]; ?>

    <?php }elseif ($current_page) { ?>
      <h2>Manage Page</h2>
      Page Name: <?php echo $current_page["menu_name"]; ?>

    <?php }else { ?>
      Select something from the left
    <?php }?>
  </div>
</div>
<?php include('../includes/layouts/footer.php'); ?>
