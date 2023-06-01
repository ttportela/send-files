<?php 

include_once 'func.php'; 
include_once 'classes.php';

$temp = new FileHolder();
$temp->name = "WESLEY.java";
$temp->content = "public class Main {
  int x = 5;

  public static void main(String[] args) {
    Main myObj = new Main();
    System.out.println(myObj.x);
  }
}";

$user = new Person();
$user->name = "Miguel";
$user->add($temp);

$_SESSION["USER_PROFIL"] = $user;

?>