<?php

function CheckLogin(){
    if (!empty($_SESSION['login']) and !empty($_SESSION['id'])) {
        return TRUE;
    }
    else {
        return FALSE;
    }
}

