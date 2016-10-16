<?php
require_once('myClasses.php');
  $Home  = array("text"=>"Home", "url"=>"http://zenit.senecac.on.ca:19350/lab6/testDB.php");
  $Select = array('text'=>'Select', 'url'=>'http://zenit.senecac.on.ca:19350/lab6/testDB.php?id=1');
  $Insert = array('text'=>'Insert', 'url'=>'http://zenit.senecac.on.ca:19350/lab6/testDB.php?id=2');
  $Update = array('text'=>'Update', 'url'=>'http://zenit.senecac.on.ca:19350/lab6/testDB.php?id=3');

$m = new Menu($Home,$Select,$Insert,$Update);
echo $m->displayMenu();
?>
