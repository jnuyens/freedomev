<?php
/**
 * Library of functions concerning Apps
 */

    function load_all_apps()
    {
        $apps = [];
        $appfolders = glob("../../../freedomev/apps-available/*");

        foreach ($appfolders as $appname) {
        $app = "";
        if (file_exists($appname."/description.json")) {
            $app = json_decode(file_get_contents($appname."/description.json"), true);
            if (file_exists('../../../freedomev/apps/'.basename($appname))) {
                $app['enabled'] = true;
            } else {
                $app['enabled'] = false;
            }

            $app['id'] = basename($appname);
            $app['name'] = isset($app['name']) ? $app['name'] : "Untitled app";
            $app['description'] = isset($app['description']) ? $app['description'] : "This app has no description yet";

        }
        $apps[] = $app;
        }

        return $apps;
    }