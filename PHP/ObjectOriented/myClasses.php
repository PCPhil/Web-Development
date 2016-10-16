<?php
/*
Philip Chung
071-790-141
Anthony Austin
March 18th,2016*/
class DBLink{
	private $link;
	private $user;
	private $pass;
	private $hint;
	private $salt="p";
//Constructor
	
	//Construct a link to my database
	public function __construct ($databasename){

		//Obtain db login info
		$lines = file('/home/int322_161a27/secret/topsecret.txt');
		$dbserver = trim($lines[0]);
		$uid = trim($lines[1]);
		$pw = trim($lines[2]);
		$dbname = trim($lines[3]);
		
		
		
		$this->link = mysqli_connect($dbserver,$uid,$pw,$dbname) or die("Failed");
		//Procedural style;
		mysqli_select_db($this->link,$databasename) or die("No Database");

	}

	//Set private variables
	function set($user_query,$pass_query){
		$this->user = $user_query;
		$this->pass = crypt($pass_query,$this->salt);
		$this->hint = substr($pass_query,-1);
	}

	//Query function
	function query ($sql_query){
		$result = mysqli_query ($this->link,$sql_query);
		return $result;
	}
	//Validate function
	function validate($user_query,$pass_query){

		//CHECK FOR EMPTY FIELDS
		if($user_query==""){
			return false;
		}
		if($pass_query==""){
			return false;
		}
		

		return true;
	}

	//Checks for existing records
	function exists($user_query){
		
		//CALL MEMBER FUNCTION QUERY OF THE CURRENT OBJECT
		$result = $this->query("Select username from users where username='".$user_query."'");
		
		//COUNT RESULTS FROM QUERY
		$count = mysqli_num_rows($result);

		//IF COUNT HAS COUNTED ONE OR MORE RESULTS, RETURN FALSE BECAUSE EMAIL/USER IS ALREADY REGISTERED!
		if($count>0){
			return false;
		}
		return true;
	}
	//Inserts data into database
	function register($user_query,$pass_query,$hint_query){
		$salt = "p";
		$hashedpass=crypt($pass_query,$salt);
		$result=$this->query('insert into users set username="'.$user_query.'",password="'.$hashedpass.'",passwordHint="'.$hint_query.'"');
	}
	//Updates existing data in the database
	function update($user_query,$pass_query,$hint_query){
		$count=0;
		if($user_query!=""){
			$result=$this->query('update users set username ="'.$user_query.'" where username="'.$this->user.'"');
			$count++;
		}
		if($pass_query!=""){
			$result=$this->query('update users set password ="'.crypt($pass_query,$this->salt).'" where password="'.$this->pass.'"');
			$count++;
		}
		if($hint_query!=""){
			$result=$this->query('update users set passwordHint ="'.$hint_query.'" where username="'.$this->user.'"');
			$count++;
		}
	return $count;
	
	}
	//Check for no records, return false if there are records
	function emptyResult(){
		$result=$this->query('select * from users where username="'.$this->user.'" AND password="'.$this->pass.'"');
		if(mysqli_num_rows($result)>0){
			return false;
		}
		return true;
	}
	//Destroy database object
	function __destruct(){
		mysqli_close($this->link);
	}
}

class Menu{
	private $home;
	private $select;
	private $insert;
	private $update;
	public function __construct($home,$select,$insert,$update){
             	$this->home .= "<a href='{$home['url']}'>{$home['text']}</a>\n";
		$this->select .= "<a href='{$select['url']}'>{$select['text']}</a>\n";
		$this->insert .= "<a href='{$insert['url']}'>{$insert['text']}</a>\n";
		$this->update .= "<a href='{$update['url']}'>{$update['text']}</a>\n";
	}
	public function displayMenu(){
		$html.=$this->home."<br>";
		$html.=$this->select."<br>";
		$html.=$this->insert."<br>";
		$html.=$this->update."<br>";
		
    		return $html;

	}
}
?>

