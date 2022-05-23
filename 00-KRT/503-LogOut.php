<?php

    include_once '502-UserSession.php';
	
    $userSession = new UserSession();
    $userSession->closeSession();
    header("location: index.php");
?>