<?php

class book{

    function getBookId($id){
        $url = ApiToolkit::getHomeUrl().'book/'.$id;
        $json = file_get_contents($url,0,null,null);
        $json_output = json_decode($json, true);
        return var_dump(array($json_output));
    }

}
