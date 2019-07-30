<?php

function xss_filter($string){
    echo htmlentities($string, ENT_QUOTES, 'UTF-8');
}