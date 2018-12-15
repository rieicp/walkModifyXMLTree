<?php
header("Content-Type:text/html;charset=ISO-8859-1");

require_once (__DIR__ . '/vendor/autoload.php');

use WalkModifyXmlTree\XmlLoader;
use WalkModifyXmlTree\ConfigurationLoader;
use WalkModifyXmlTree\XmlHandler;

$xmlloader = new XmlLoader();
$configloader = new ConfigurationLoader();
$xmlhandler = new XmlHandler();

$str = $xmlloader->getExampleXML();
$config = $configloader->getConfigurations();

$xml = simplexml_load_string($str);
$parent = null;

$xml2 = $xmlhandler->handle($xml, $parent, $config, true);

echo '<hr />';

echo $xml2->asXML() . '<br />';

var_dump( $xml2->asXML() );
