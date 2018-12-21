<?php
header("Content-Type:text/xml;charset=ISO-8859-1");

require_once (__DIR__ . '/vendor/autoload.php');

use WalkModifyXmlTree\XmlLoader;
use WalkModifyXmlTree\XmlXpathHandler;

$xmlloader = new XmlLoader();
$xmlhandler = new XmlXpathHandler();


/**
 * snippet loading and mofifying
 */
$sfile = __DIR__ . '/Resources/snippet/service.xml';
$str = $xmlloader->loadExampleXML($sfile);
$snippet = simplexml_load_string($str);

$couse_id = 'AKU-0123456+++';
$configs[] = [
    'action' => 'setNodeValue',
    'nodename' => 'PRODUCT_ID',
    'path' => '*',
    'value' => $couse_id,
];

$configs[] = [
    'action' => 'setNodeValue',
    'nodename' => 'COURSE_ID',
    'path' => '*',
    'value' => $couse_id,
];

$xmlhandler->setConfigs($configs);
$snippetNode2 = $xmlhandler->handle($snippet);
$snippet2 = $snippetNode2->asXML();


/**
 * add service(snippet) node to the tree
 */
$xmlfile = __DIR__ . '/Resources/xml/generated_Katalog.xml';
$str = $xmlloader->loadExampleXML($xmlfile);
$xml = simplexml_load_string($str);

$configs = [];
$configs[] = [
    'action' => 'addChildNode',
    'nodename' => 'NEW_CATALOG',
    'path' => '*',
    'snippet' => $snippet2,
];

$xmlhandler->setConfigs($configs);
$xml2 = $xmlhandler->handle($xml);
$content = $xml2->asXML();
$content = preg_replace("/\s*\n\s*\n/", "\n", $content);//空白行整合
echo $content;
