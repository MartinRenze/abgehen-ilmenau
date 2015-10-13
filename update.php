<?php
if($_GET['noMenu']=="true")
  header('Location: update.php?noMenu=true');
else
  header('Location: update.php');

?>
