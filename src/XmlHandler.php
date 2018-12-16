<?php

namespace WalkModifyXmlTree;

//todo
//using xPath
class XmlHandler
{
    public function sxml_append(\SimpleXMLElement $to, \SimpleXMLElement $from) {
        $toDom = dom_import_simplexml($to);
        $fromDom = dom_import_simplexml($from);
        $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
    }

    public function keepOnlyTheseNodes($node, &$parent, $config, $path)
    {
        //todo
        return;
    }

    public function removeChildNode($node, &$parent, $config, $path)
    {
        //todo
        return;
    }

    public function addChildNode($node, &$parent, $config, $path)
    {
        //todo
        return;
    }


    public function setNodeAttribute($node, &$parent, $config, $path)
    {
        //todo
        return;
    }

    public function setNodeValue($node, &$parent, $config, $type, $path)
    {
        //todo
        return;
    }

    public function modifyTree($node, &$parent, $configs, $type, $path)
    {
        foreach ($configs as $config) {
            if($config['action'] === 'keepOnlyTheseNodes'){ //仅保留这些childNode

                $this->keepOnlyTheseNodes($node, $parent, $config, $path);

            }elseif($config['action'] === 'addChildNode'){ //添加childNode

                $this->addChildNode($node, $parent, $config, $path);

            }elseif($config['action'] === 'removeChildNode'){ //删除childNode

                $this->removeChildNode($node, $parent, $config, $path);

            }elseif($config['action'] === 'setNodeValue') { //修改Node值（针对叶节点）

                $this->setNodeValue($node, $parent, $config, $type, $path);

            }elseif($config['action'] === 'setNodeAttribute'){ //修改Node属性

                $this->setNodeAttribute($node, $parent, $config, $path);
            }
        }
    }


    public function handle($xml, $parent, $config, $debug = true, $path = [])
    {
        //todo
        $type = null;
        $this->modifyTree($xml, $parent, $config, $type, $path);
        return $xml;
    }
}