<?php

namespace WalkModifyXmlTree;

use WalkModifyXmlTree\XmlSnippet;

class PremiumConfigurationLoader
{
    public function getConfigurations()
    {
        $config = [];

//增加节点-----------------------------------------------------------------------

        $snippet = new XmlSnippet();
        $section = $snippet->getSnippet('EDUCATION');

        $config[] = [
            'action' => 'addChildNode',
            'nodename' => 'SERVICE_MODULE',
            'path' => '*',
            'snippet' => $section,
        ];

        return $config;
    }
}