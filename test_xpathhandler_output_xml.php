<?php
header("Content-Type:text/html;charset=ISO-8859-1");

require_once (__DIR__ . '/vendor/autoload.php');

use WalkModifyXmlTree\ResourceLoader\XmlLoader;
use WalkModifyXmlTree\Configurator\PremiumConfigurationLoader;
use WalkModifyXmlTree\Configurator\ConfigurationLoader;
//use WalkModifyXmlTree\Handler\XmlGerneralHandler;
use WalkModifyXmlTree\Handler\XmlXpathHandler;

$xmlloader = new XmlLoader();
/**
 * PremiumConfigurationLoader 是对应增删节点的配置，优先执行
 */
$premiumconfigloader = new PremiumConfigurationLoader();
$configloader = new ConfigurationLoader(); //ConfigurationLoader是对应普通节点操作的配置
//$xmlhandler = new XmlGerneralHandler();
$xmlhandler = new XmlXpathHandler();

$xmlfile = __DIR__ . '/Resources/xml/example_auto_01.xml';
$str = $xmlloader->loadExampleXML($xmlfile);
$xml = simplexml_load_string($str);
//$parent = null;
$premiumconfigs = $premiumconfigloader->loadConfigurations(__DIR__ . '/config/premium.php');
//先执行节点增删
foreach ($premiumconfigs as $premiumconfig){
//    $xml = $xmlhandler->handle($xml, $parent, array($premiumconfig), false);
    $xmlhandler->setConfigs(array($premiumconfig));
//    $xml = $xmlhandler->handle($xml);
    $xml = $xmlhandler->handle($xml);
}

//echo $xml->asXML();

//$parent = null;
$configs = $configloader->loadConfigurations(__DIR__ . '/config/normal.php');
//再执行其它节点操作
//$xml2 = $xmlhandler->handle($xml, $parent, $configs, false);
$xmlhandler->setConfigs($configs);
$xml2 = $xmlhandler->handle($xml);
$content = $xml2->asXML();
$content = preg_replace("/\s*\n\s*\n/", "\n", $content);//空白行整合
echo $content;
