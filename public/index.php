<?php require_once("../includes/initialize.php"); ?>
<?php include_layout_template('header.php'); ?>

<?php 
if(isset($_GET["id"])){
	$message = Translate::find_by_id($_GET["id"]);
	$placeholder = $message->userInput;
	$output = $message->convert();
}

if(isset($_POST['submit'])){
	$translate = new Translate();
	$translate->userInput = $_POST['userInput'];
	if($translate->save()) {
		$session->message("Success");
		redirect_to('index.php?id='.$translate->id);
	} else {
		$session->message($translate->errors);
	}
}
?>

<form action="index.php" enctype="multipart/form-data" method="post">
<label class=label>Input:&nbsp;&nbsp;</label>
<textarea cols="50" rows="10" class="textarea" name="userInput" id="userInput" placeholder="Enter some English that you would like translated here..">
<?php if(isset($_GET["id"])){ echo $placeholder;}?></textarea><br />
<input class="submit" type="submit" name="submit" value="Translate" />
<br /><br />
<label class=label>Output:&nbsp;&nbsp;</label>

<?php
if(isset($output)){ echo $output;}
?>
</html>