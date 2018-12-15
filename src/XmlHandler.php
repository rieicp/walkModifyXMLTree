<?php

namespace WalkModifyXmlTree;

class XmlHandler
{
    public function sxml_append(\SimpleXMLElement $to, \SimpleXMLElement $from) {
        $toDom = dom_import_simplexml($to);
        $fromDom = dom_import_simplexml($from);
        $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
    }


    public function addChildNode($node, &$parent, $config)
    {
        $nodename = $config['nodename'];
        if ($node->getName() === $nodename) {
            $child = simplexml_load_string($config['snippet']);
            $this->sxml_append($parent->$nodename, $child);
        }
    }


    public function setNodeAttribute($node, &$parent, $config)
    {
        $nodename = $config['nodename'];
        $attr = $config['attribute'];
        if ($node->getName() === $nodename) {
            $parent->$nodename->attributes()->$attr = $config['value'];
        }
    }

    public function setNodeValue($node, &$parent, $config)
    {
        $nodename = $config['nodename'];
        if ($node->getName() === $nodename) {
            $parent->$nodename = $config['value'];
        }
    }

    public function modifyTree($node, &$parent, $configs)
    {
        foreach ($configs as $config) {
            if ($config['action'] === 'setNodeValue') {

                $this->setNodeValue($node, $parent, $config);

            }elseif($config['action'] === 'setNodeAttribute'){

                $this->setNodeAttribute($node, $parent, $config);

            }elseif($config['action'] === 'addChildNode'){

                $this->addChildNode($node, $parent, $config);
            }
        }
    }


    public function handle($xml, $parent, $config, $debug = true, $path = [])
    {
        foreach ($xml->children() as $node) {

            $path[] = $node->getName();

            if ($node->count()) {

                $this->handle($node, $xml, $config, $debug, $path);
                $this->modifyTree($node, $xml, $config);
                array_pop($path);

            } else {

                array_pop($path);
                $this->modifyTree($node, $xml, $config);

                if ($debug) {
                    echo '<hr />';
                    echo '<p>Path = ['. implode(' > ', $path) .']</p>';
                    echo '<h3>' . $node->getName() . '</h3>';
                    echo '<p>attributes: ';
                    foreach ($node->attributes() as $name => $vl) {
                        echo $name . " = " . $vl . " | ";
                    }
                    echo '</p>';
                    echo '<p>node-value: ' . (string)$node . '</p>';
                }
            }

        }

        return $xml;
    }
}