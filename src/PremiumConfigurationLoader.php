<?php

namespace WalkModifyXmlTree;

use WalkModifyXmlTree\XmlSnippetLoader;

class PremiumConfigurationLoader
{
    public function getConfigurations()
    {
        return require_once (__DIR__ . '/../configuration/premium.php');
    }
}
