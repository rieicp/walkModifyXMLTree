<?php
header("Content-Type:text/xml;charset=ISO-8859-1");

require_once (__DIR__ . '/vendor/autoload.php');

use WalkModifyXmlTree\XmlLoader;
use WalkModifyXmlTree\PremiumConfigurationLoader;
use WalkModifyXmlTree\ConfigurationLoader;
use WalkModifyXmlTree\XmlHandler;

$xmlloader = new XmlLoader();
/**
 * PremiumConfigurationLoader 是对应增删节点的配置，优先执行
 */
$premiumconfiguration = new PremiumConfigurationLoader();
$configloader = new ConfigurationLoader(); //ConfigurationLoader是对应普通节点操作的配置
$xmlhandler = new XmlHandler();

$xmlfile = __DIR__ . '/Resources/xml/sample01.xml';
$str = $xmlloader->getExampleXML($xmlfile);
$xml = simplexml_load_string($str);
$parent = null;
$premiumconfigs = $premiumconfiguration->getConfigurations();
//先执行节点增删
foreach ($premiumconfigs as $premiumconfig){
    $xml = $xmlhandler->handle($xml, $parent, array($premiumconfig), false);
}

$parent = null;
$configs = $configloader->getConfigurations();
//再执行其它节点操作
$xml2 = $xmlhandler->handle($xml, $parent, $configs, false);
echo $xml2->asXML();
