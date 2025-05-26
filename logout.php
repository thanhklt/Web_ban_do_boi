<?php

session_start();    
session_unset();        
session_destroy();      


header('Location: ./admin/bao/index.php');
exit;