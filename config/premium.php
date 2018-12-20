<?php

use WalkModifyXmlTree\XmlSnippetLoader;

$config = [];

//todo:若此配置文件为空，是否会产生错误？

//仅保留这些节点（及其子节点）------------------------------------------
$config[] = [
    'action' => 'keepOnlyTheseNodes',
    'nodePaths' => [
        'HEADER/CATALOG',
        'HEADER/SUPPLIER',
        'NEW_CATALOG/SERVICE',
    ]
];

//删除节点-----------------------------------------------------------------------

/*$config[] = [
    'action' => 'removeNode',
    'nodename' => 'STUDY_COURSE',
    'path' => 'NEW_CATALOG/SERVICE/SERVICE_DETAILS',
];*/


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
