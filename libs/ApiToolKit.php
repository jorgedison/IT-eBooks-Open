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

    public static function getCurrentProtocol()
    {
        $protocol = "http://";

        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
            $protocol = "https://";
        }
        return $protocol;
    }

    public static function getHomeUrl()
    {
        #$url = ApiToolkit::getCurrentProtocol() . filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_URL) . ApiToolkit::getConfigVariable("uriHomeServices");
        $url = ApiToolkit::getCurrentProtocol();
        if (ApiToolkit::getConfigVariable("enviroment") == "it-ebooks-api.info/v1/") {
            $url.= 'it-ebooks-api.info/v1/';
        }
        return $url;
    }
}
