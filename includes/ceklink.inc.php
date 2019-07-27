<?php

function cekLink($link){
    if (strpos("$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", 'admin')) {
        return "../$link";
    }
    else{
        return "$link";
    }

}