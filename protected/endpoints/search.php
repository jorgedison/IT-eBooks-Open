<?php

class search{

    function getSearch($query){
        $url = ApiToolkit::getHomeUrl().'search/'.$query;
        $json = file_get_contents($url,0,null,null);        
        $json_output = json_decode($json, true);
        return var_dump(array($json_output));
    }

    function getSearchPage($query, $number){
        $url = ApiToolkit::getHomeUrl().'search/'.$query.'/page/'.$number;
        $json = file_get_contents($url,0,null,null);        
        $json_output = json_decode($json, true);
        return var_dump(array($json_output));
    }
}

?>
