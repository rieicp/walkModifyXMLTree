<?php

namespace WalkModifyXmlTree;

use WalkModifyXmlTree\XmlSnippetLoader;

class PremiumConfigurationLoader
{
    public function loadConfigurations($file)
    {
        return require_once ($file);
    }
}
