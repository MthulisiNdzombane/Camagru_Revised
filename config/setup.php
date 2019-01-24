<?php
  include '../config/config.php';
  include '../classes/Database.php';
  
  /###############/
  /#  CREATE DB  #/
  /###############/
  
  try {
    $db = new Database();
  } catch(PDOEXcepetion $e) {
    
  }
?>
