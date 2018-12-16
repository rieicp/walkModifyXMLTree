<?php

namespace WalkModifyXmlTree;

class ConfigurationLoader
{
    public function getConfigurations()
    {
        return require_once (__DIR__ . '/../config/normal.php');
    }
}
