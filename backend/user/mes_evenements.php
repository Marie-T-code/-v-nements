<?php
session_start(); 
if(!isset($_SESSION['id'])){
    header('Location: ../login_logout/login.php'); 
    exit; 
}

require_once __DIR__ . '/../acces_insertions_DB/db.php'; 

