<?php

class ApiToolkit{
    
    const configIniPathName = "./config/config.ini";
    const configIniSectionApi = "ebook";

    public static function getConfigVariable($param)
    {
        if (!file_exists(ApiToolkit::configIniPathName)) {
            $messages[] = array("0011" => "Not found file config");
        }

        $config = parse_ini_file(ApiToolkit::configIniPathName, true);

        if (!isset($config[ApiToolkit::configIniSectionApi][$param])) {
            $messages[] = array("0005" => "config variable not exist");
            #ApiToolkit::returnFailed(500, $messages);
        }
        return $config[ApiToolkit::configIniSectionApi][$param];
    }


    public static function getHomeUrl()
    {
        if (ApiToolkit::getConfigVariable("enviroment") == "it-ebooks-api.info/v1/") {
            $url.= 'it-ebooks-api.info/v1/';
        }
        return $url;
    }
}
