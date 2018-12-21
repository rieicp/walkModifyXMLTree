<?php

namespace WalkModifyXmlTree;

class ConfigurationLoader
{
    public function loadConfigurations($file)
    {
        return require_once ($file);
    }
}
