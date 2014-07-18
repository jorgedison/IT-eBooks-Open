<?php

class exceptions{
   
    function exceptions($code){
        switch ($code) {
            case 404:
                $result['errors'] = array("Code"=>"","message"=>"Page not found");
                break;
        default:
            $result['errors'] = array("Code"=>"", "It has happened a fatal error");
        }
        $json_string = json_encode($result, JSON_PRETTY_PRINT);
        return $json_string;
    }

}

