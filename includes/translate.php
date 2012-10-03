<?php
require_once(LIB_PATH.DS.'database.php');

class Translate extends DatabaseObject {
	
	protected static $table_name="translate";
	protected static $db_fields=array('id', 'userInput','date');
	
	public $errors;
	
	public $id;
	public $userInput;
	public $date;
	public $output;
	public $dictionary = array(
	"the" => "ye",
	"you" => "thou",
	"are" => "art",
	"can" => "canst",
	"do" => "doest",
	"does" => "dost",
	"has" => "hath",
	"here" => "hither",
	"none" => "nary",
	"nothing" => "naught",
	"will" => "shalt",
	"look" => "seek",
	"wait" => "tarry",
	"stay" => "tarry",
	"where" => "whence",
	"know" => "wit",
	"done" => "wrought",
	"made" => "wrought",
	"created" => "wrought",
	"leave" => "bequeth",
	"facebook" => "the Kingdom of Zuckerberg"
			
	);  
	
	//I am not using gettext as a principle for this exercise, please see this thread if you're curious as to why: http://bit.ly/T0tbfo
	public function convert() {
	$i=0;
	$output = explode(" ", $this->userInput);	
	//for every word in the array
	foreach ($output as $word){
		
		//if the word matches a key in the dictionary array
		if(isset($this->dictionary[$word])){
			
			//splice the array to replace the input word with the output word
			foreach($output as $k=>$v) { 
				if($v==$word){
				$output[$k] = $this->dictionary[$word]; }
			}
		}
		$i++;
	}
	
	$output = implode(" ", $output);
	return $output;		
	}
	
	public function save() {
		// A new record won't have an id yet.
		if(isset($this->id)) {
			// Really just to update the name
			$this->update();
			return true;
		} else {
			// Make sure there are no errors
			// Can't save if there are pre-existing errors
		  	if(!empty($this->errors)) { return false; }

			//Finally add the item to the DB
			if($this->create()) {
				return true;
			} else {
				// 
				$this->errors = "Send failed, please contact us";
				return false;
			}
		}
	}
			
	// Common Database Methods
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM ".self::$table_name);
  }
  
  public static function find_by_id($id=0) {
  	global $database;
    $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id=".$database->escape_value($id)." LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  }
  
  public static function find_by_sql($sql="") {
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }

  public static function count_all() {
  	global $database;
  	$sql = "SELECT COUNT(*) FROM ".self::$table_name;
  	$result_set = $database->query($sql);
  	$row = $database->fetch_array($result_set);
  	return array_shift($row);
  }
  
	private static function instantiate($record) {
		// Could check that $record exists and is an array
    $object = new self;
    
    
    
		// Simple, long-form approach:
		// $object->id 				= $record['id'];
		// $object->username 	= $record['username'];
		// $object->password 	= $record['password'];
		// $object->first_name = $record['first_name'];
		// $object->last_name 	= $record['last_name'];
		
		// More dynamic, short-form approach:
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	private function has_attribute($attribute) {
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  $attributes = array();
	  foreach(self::$db_fields as $field) {
	    if(property_exists($this, $field)) {
	      $attributes[$field] = $this->$field;
	    }
	  }
	  return $attributes;
	}
	
	protected function sanitized_attributes() {
	  global $database;
	  $clean_attributes = array();
	  // sanitize the values before submitting
	  // Note: does not alter the actual value of each attribute
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $database->escape_value($value);
	  }
	  return $clean_attributes;
	}
	
	// replaced with a custom save()
	// public function save() {
	//   // A new record won't have an id yet.
	//   return isset($this->id) ? $this->update() : $this->create();
	// }
	
	public function create() {
		global $database;
		$attributes = $this->sanitized_attributes();
		unset($attributes['id']);
		
	  $sql = "INSERT INTO ".self::$table_name." (";
		$sql .= join(", ", array_keys($attributes));
	  $sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
	  $sql .= "')";
		if($database->query($sql)) {
	    $this->id = $database->insert_id();
	    return true;
	  } else {
	    return false;
	  }
	}

	public function update() {
	  global $database;
		// Don't forget your SQL syntax and good habits:
		// - UPDATE table SET key='value', key='value' WHERE condition
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$table_name." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE id=". $database->escape_value($this->id);
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}

	public function delete() {
		global $database;
		// Don't forget your SQL syntax and good habits:
		// - DELETE FROM table WHERE condition LIMIT 1
		// - escape all values to prevent SQL injection
		// - use LIMIT 1
	  $sql = "DELETE FROM ".self::$table_name;
	  $sql .= " WHERE id=". $database->escape_value($this->id);
	  $sql .= " LIMIT 1";
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	
		// NB: After deleting, the instance of User still 
		// exists, even though the database entry does not.
		// This can be useful, as in:
		//   echo $user->first_name . " was deleted";
		// but, for example, we can't call $user->update() 
		// after calling $user->delete().
	}

}

?>