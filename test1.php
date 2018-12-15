<?php
header("Content-Type:text/html;charset=ISO-8859-1");

function walkModifyXMLTree($xml, $parent, $path = [])
{
    foreach ($xml->children() as $node) {

        $path[] = $node->getName();

        if ($node->count()) {

            walkModifyXMLTree($node, $xml, $path);
            array_pop($path);

        } else {

            array_pop($path);
            print_r($path);

            if ($node->getName() === 'LANGUAGE'){
                $xml->LANGUAGE = 'eng';
            }
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

$str = getExampleXML();

$xml = simplexml_load_string($str);
$parent = null;

$xml2 = walkModifyXMLTree($xml, $parent);

echo '<hr />';

var_dump( $xml2->asXML() );
