<?php
header("Content-Type:text/html;charset=ISO-8859-1");

require_once (__DIR__ . '/vendor/autoload.php');

use WalkModifyXmlTree\ResourceLoader\XmlLoader;
use WalkModifyXmlTree\Configurator\PremiumConfigurationLoader;
use WalkModifyXmlTree\Configurator\ConfigurationLoader;
use WalkModifyXmlTree\Handler\XmlGerneralHandler;

$xmlloader = new XmlLoader();
/**
 * PremiumConfigurationLoader 是对应增删节点的配置，优先执行
 */
$premiumconfiguration = new PremiumConfigurationLoader();
$configloader = new ConfigurationLoader(); //ConfigurationLoader是对应普通节点操作的配置
$xmlhandler = new XmlGerneralHandler();

$xmlfile = __DIR__ . '/Resources/xml/example_by_hand_01.xml';
$str = $xmlloader->loadExampleXML($xmlfile);
$xml = simplexml_load_string($str);

$parent = null;
$premiumconfig = $premiumconfiguration->loadConfigurations(__DIR__ . '/config/premium.php');
//先执行节点增删
$xml2 = $xmlhandler->handle($xml, $parent, $premiumconfig, true);

echo '<hr />';
echo $xml2->asXML() . '<br />';
//var_dump( $xml2->asXML() );


$parent = null;
$config = $configloader->loadConfigurations(__DIR__ . '/config/normal.php');
//再执行其它节点操作
$xml3 = $xmlhandler->handle($xml2, $parent, $config, true);
echo '<hr />';
echo $xml3->asXML() . '<br />';
var_dump( $xml3->asXML() );
