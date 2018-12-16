<?php

namespace WalkModifyXmlTree;

use WalkModifyXmlTree\XmlSnippetLoader;

class PremiumConfigurationLoader
{
    public function loadConfigurations()
    {
        $config = [];

//增加节点-----------------------------------------------------------------------

        $snippet = new XmlSnippetLoader();
        $section = $snippet->loadSnippet(__DIR__ . '/../Resources/snippet/education.xml');

        $config[] = [
            'action' => 'addChildNode',
            'nodename' => 'SERVICE_MODULE',
            'path' => '*',
            'snippet' => $section,
        ];

//删除节点-----------------------------------------------------------------------

        $config[] = [
            'action' => 'removeChildNode',
            'nodename' => 'STUDY_COURSE',
            'path' => 'NEW_CATALOG/SERVICE/SERVICE_DETAILS',
        ];



        return $config;
    }
}