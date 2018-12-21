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
$configs = [];
$course_id = 'AKU-0123456+++';
$configs['setNodeValue'] = [
    '*/PRODUCT_ID' => $course_id,
    '*/COURSE_ID' => $course_id,
];

$snippetNode = handleXml($sfile, $xmlloader, $xmlhandler, $configs);//simpleXML node
$snippet = $snippetNode->asXML();


/**
 * add service(snippet) node to the tree
 */
$xmlfile = __DIR__ . '/Resources/xml/generated_Katalog.xml';
$configs = [];
$configs['addChildNode'] = [
    '*/NEW_CATALOG' => $snippet,
];

$xmlTree = handleXml($xmlfile, $xmlloader, $xmlhandler, $configs);//simpleXML node
$content = $xmlTree->asXML();
$content = preg_replace("/\s*\n\s*\n/", "\n", $content);//空白行整合
echo $content;
