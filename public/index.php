<?php require_once("../includes/initialize.php"); ?>
<?php include_layout_template('header.php'); ?>

<form action="results.php" enctype="multipart/form-data" method="post">
<input type="text" name="userText" placeholder="Enter some English you would like translated here..."/><br />
<input type="submit" name="submit" value="Translate" />
</form>

<?php include_layout_template('footer.php'); ?>