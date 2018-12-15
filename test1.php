<?php
header("Content-Type:text/html;charset=ISO-8859-1");

function setNodeValue($node, &$parent, $config)
{
    $nodename = $config['nodename'];
    if ($node->getName() === $nodename) {
        $parent->$nodename = $config['value'];
    }
}

function modifyTree($node, &$parent, $configs)
{
    foreach ($configs as $config) {
        if ($config['action'] === 'setNodeValue') {
            setNodeValue($node, $parent, $config);
        }
    }
}


function walkModifyXMLTree($xml, $parent, $config, $path = [])
{
    foreach ($xml->children() as $node) {

        $path[] = $node->getName();

        if ($node->count()) {

            walkModifyXMLTree($node, $xml, $config, $path);
            array_pop($path);

        } else {

            array_pop($path);
            echo '<hr />';
            print_r($path);

            modifyTree($node, $xml, $config);

            echo '<h3>' . $node->getName() . '</h3>';
            echo '<p>attributes: ';
            foreach ($node->attributes() as $name => $vl) {
                echo $name . " = " . $vl . " | ";
            }
            echo '</p>';
            echo '<p>node-value: ' . (string)$node . '</p>';
        }

    }

    return $xml;
}

require_once (__DIR__ . '/exampleXML.php');
require_once (__DIR__ . '/config.php');

$str = getExampleXML();
$config = getConfigurations();

$xml = simplexml_load_string($str);
$parent = null;

$xml2 = walkModifyXMLTree($xml, $parent, $config);

echo '<hr />';

echo $xml2->asXML();
