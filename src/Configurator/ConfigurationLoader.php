<?php

namespace WalkModifyXmlTree\Configurator;

class ConfigurationLoader
{
    public function loadConfigurations($file)
    {
        return require_once ($file);
    }
}
