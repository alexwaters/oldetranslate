<?php

function log_action($level, $name, $message=""){
$logfile = SITE_ROOT.DS.'logs'.DS.'adminlog.txt';
$time = strftime('%m/%d/%Y %H:%M', time());
$input = $time . " | " . $level . " " . $name . $message . "\r\n" . "\r\n";

	if($handle = fopen($logfile, 'a')) { // append
	//	| does file exist, if not create new file
	//	| is file writeable? if not output error
	//	| append log entries to the end of the file
		fwrite($handle, $input); 
		fclose($handle);
	} else {
		echo "Could not open file for writing.";
	}
}

function strip_zeros_from_date( $marked_string="" ) {
  // first remove the marked zeros
  $no_zeros = str_replace('*0', '', $marked_string);
  // then remove any remaining marks
  $cleaned_string = str_replace('*', '', $no_zeros);
  return $cleaned_string;
}

function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function output_message($message="") {
  if (!empty($message)) { 
    return "<p class=\"message\">{$message}</p>";
  } else {
    return "";
  }
}

function __autoload($class_name) {
	$class_name = strtolower($class_name);
  $path = LIB_PATH.DS."{$class_name}.php";
  if(file_exists($path)) {
    require_once($path);
  } else {
		die("The file {$class_name}.php could not be found.");
	}
}

function include_layout_template($template="") {
	include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
}

function datetime_to_text($datetime="") {
  $unixdatetime = strtotime($datetime);
  return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}

?>