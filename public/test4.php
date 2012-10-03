<?php require_once("../includes/initialize.php"); ?>
<?php include_layout_template('header.php'); ?>

<?php 
if(isset($_POST['submit'])){
	$translate = new Translate();
	$translate->userInput = $_POST['userInput'];
	if($translate->save()) {
		$session->message($translate->convert());
		redirect_to('test4.php');
	} else {
		$session->message($translate->errors);
	}
}
?>

<form action="test4.php" enctype="multipart/form-data" method="post">
<input type="text" name="userInput" placeholder="Enter some English you would like translated here..."/><br />
<input type="submit" name="submit" value="Translate" />
<br />
<?php
echo $session->message;
?>
</html>