<?php 

/**
 * créé des supervariables $_SESSION à partir d'une array
 * @param Array $datas
 * @return void
 */
function create_session(Array $datas) {
    foreach ($datas as $key => $data) {
        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = $data;
        }
    }
}

/**
 * retourne un string correspondant à une key $key dans une array $arr
 * || retourne null si la key n'existe pas dans l'array ou est vide
 * @param Array $arr
 * @param String $key
 * @return String|null
 */
function fetch_value(Array $arr, String $key) {
    if (isset($arr[$key]) && !empty($arr[$key])) {
        return $arr[$key];
    }
    return null;
}



