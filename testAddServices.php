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

$course_id = 'AKU-0123456+++';
$configs['setNodeValue'] = [
    '*/PRODUCT_ID' => $course_id,
    '*/COURSE_ID' => $course_id,
];

$snippetNode2 = handleXml($sfile, $xmlloader, $xmlhandler, $configs);
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
