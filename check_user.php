<?php
if(!isset($_SESSION['username']) || !isset($_SESSION['privilegi'])){
  header('location: index.php');
}
