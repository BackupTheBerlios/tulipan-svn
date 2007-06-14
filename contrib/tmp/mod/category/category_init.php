<?php


        $page_owner = optional_param("page_owner",0,PARAM_INT);
        if (empty($page_owner)) {
            $page_owner = $_SESSION['userid'];
        }


?>