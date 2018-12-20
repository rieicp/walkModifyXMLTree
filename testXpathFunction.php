<form method="post">
    <input name="path" type="text"/>
    <input type="submit" value="submit"/>
</form>

<?php

require_once (__DIR__ . '/vendor/autoload.php');

use WalkModifyXmlTree\XmlLoader;

$xmlloader = new XmlLoader();

$xmlfile = __DIR__ . '/Resources/xml/example_auto_01.xml';
$str = $xmlloader->loadExampleXML($xmlfile);
$xml = simplexml_load_string($str);

if (!empty($_POST['path'])){
    var_dump($xml->xpath($_POST['path']));
}

?>
