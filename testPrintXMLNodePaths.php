<form method="post">
    <input name="path" style="width:70%" type="text"/>
    <input type="submit" value="submit"/>
</form>

<?php

require_once (__DIR__ . '/vendor/autoload.php');

use WalkModifyXmlTree\ResourceLoader\XmlLoader;

$xmlloader = new XmlLoader();

$xmlfile = __DIR__ . '/Resources/xml/example_by_hand_01.xml';
$str = $xmlloader->loadExampleXML($xmlfile);
$xml = simplexml_load_string($str);

if (!empty($_POST['path'])){
    $nodes = $xml->xpath($_POST['path']);
    foreach ($nodes as $node) {
        echo '\'';
        echo dom_import_simplexml($node)->getNodePath();
        echo '\',<br />';
    }
}

?>
