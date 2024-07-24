<?php

include_once('../helper/functions.php');

session_unset();
session_destroy();
redirect('login.php');

?>