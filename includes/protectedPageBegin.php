<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions2.php';
sec_session_start(); 
if(login_check($mysqli) == true) {
        // Add your protected page content here!
