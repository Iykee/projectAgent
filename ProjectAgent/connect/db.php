<?php
    session_start("1");
    define('DB_NAME','bms');
    define('DB_USER','root');
    define('DB_PASSWORD','');
    define('DB_HOST','localhost');
    
    $link=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
    if(!$link){
        die('could not connect' . mysql_error());
    }
    $db_selceted=mysql_select_db(DB_NAME,$link);
    if(!$db_selceted){
    die('Can\'t use'.DB_NAME.':'.mysql_error());
    }
    $connect=mysqli_connect("localhost","root","","bms");
    if(mysqli_connect_errno()){
        echo "Failed to Connect to mysql:",mysqli_connect_errno();
    }              
?>
    
    