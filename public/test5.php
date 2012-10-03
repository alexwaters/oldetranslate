<?php

$dictionary = array(
		"you" => "ye",
		"is" => "art",
);

$input = "hey there my name's alex. how are you ?";
$output = explode(" ", $input);	
print_r($output);
$i=0;

//for every word in the array
foreach ($output as $word){
	
	//if the word matches a key in the dictionary array
	if(isset($dictionary[$word])){
		
		//splice the array to replace the input word with the output word
		foreach($output as $k=>$v) { 
			if($v==$word){
			$output[$k] = $dictionary[$word]; }
		}
	}
	$i++;
}

$output = implode(" ", $output);
echo "<br />".$output;
echo "<br />";

echo "<br />";echo "<br />";echo "<br />";


function convert() {
	$dictionary = array(
			"you" => "ye",
			"is" => "art",
				
	);
	$input = "hey there my name's alex. how are you ?";
	$i=0;
	$output = explode(" ", $input);
	//for every word in the array
	foreach ($output as $word){

		//if the word matches a key in the dictionary array
		if(isset($dictionary[$word])){
				
			//splice the array to replace the input word with the output word
			foreach($output as $k=>$v) {
				if($v==$word){
					$output[$k] = $dictionary[$word]; }
			}
		}
		$i++;
	}

	$output = implode(" ", $output);
	return $output;
}

echo convert();

?>