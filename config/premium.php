<?php

use WalkModifyXmlTree\XmlSnippetLoader;

$config = [];


//删除节点-----------------------------------------------------------------------

$config[] = [
    'action' => 'removeChildNode',
    'nodename' => 'STUDY_COURSE',
    'path' => 'NEW_CATALOG/SERVICE/SERVICE_DETAILS',
];


//增加节点-----------------------------------------------------------------------

$snippet = new XmlSnippetLoader();
$section = $snippet->loadSnippet(__DIR__ . '/../Resources/snippet/education.xml');

$config[] = [
    'action' => 'addChildNode',
    'nodename' => 'SERVICE_MODULE',
    'path' => '*',
    'snippet' => $section,
];



return $config;
