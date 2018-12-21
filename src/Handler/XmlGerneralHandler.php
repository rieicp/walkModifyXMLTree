<?php

namespace WalkModifyXmlTree\Handler;

class XmlGerneralHandler
{
    public function sxml_append(\SimpleXMLElement $to, \SimpleXMLElement $from) {
        $toDom = dom_import_simplexml($to);
        $fromDom = dom_import_simplexml($from);
        $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
        /**
         * 不仅仅dom的元素变化了，simplexml的元素也相应变化了！
         * 也就是说，dom和simplexml非相互独立的系统，
         * 而是一体两面，水乳交融的关系
         */
    }

    public function keepOnlyTheseNodes($node, &$parent, $config, $path)
    {
        //todo
        return;
    }

    public function removeNode($node, &$parent, $config, $path)
    {
        if (
            ($config['path'] === '*') ||
            ($config['path'] === implode('/', $path))
        ) {
            $nodename = $config['nodename'];
            if ($node->getName() === $nodename) {
                $dom=dom_import_simplexml($node);
                $dom->parentNode->removeChild($dom);
            }
        }
    }

    public function addChildNode($node, &$parent, $config, $path)
    {
        if (
            ($config['path'] === '*') ||
            ($config['path'] === implode('/', $path))
        ) {
            $nodename = $config['nodename'];
            if ($node->getName() === $nodename) {
                $child = simplexml_load_string($config['snippet']);
                $this->sxml_append($parent->$nodename, $child);
            }
        }
    }


    public function setNodeAttribute($node, &$parent, $config, $path)
    {
        if (
            ($config['path'] === '*') ||
            ($config['path'] === implode('/', $path))
        ) {
            $nodename = $config['nodename'];
            $attr = $config['attribute'];
            if ($node->getName() === $nodename) {
                $parent->$nodename->attributes()->$attr = $config['value'];
            }
        }
    }

    public function setNodeValue($node, &$parent, $config, $type, $path)
    {
        if (
            ($config['path'] === '*') ||
            ($config['path'] === implode('/', $path))
        ) {
            if ($type === 'leaf') { //setNodeValue只适用于叶节点
                $nodename = $config['nodename'];
                if ($nodename === '*') {
                    $nodename = '*|leaf';
                }
                if ($nodename === '*|leaf') {
                    $thisname = $node->getName();
                    //todo: 将'str1234' 设置为常量
                    if ((string)$parent->$thisname === 'str1234') { //若叶节点为虚假值'str1234'则设置为新值
                        $parent->$thisname = $config['value'];
                    }
                } else {
                    if ($node->getName() === $nodename) {
                        $parent->$nodename = $config['value'];
                    }
                }
            }
        }
    }

    public function modifyTree($node, &$parent, $configs, $type, $path)
    {
        foreach ($configs as $config) {
            if($config['action'] === 'keepOnlyTheseNodes'){ //仅保留这些childNode

                $this->keepOnlyTheseNodes($node, $parent, $config, $path);

            }elseif($config['action'] === 'addChildNode'){ //添加childNode

                $this->addChildNode($node, $parent, $config, $path);

            }elseif($config['action'] === 'removeNode'){ //删除childNode

                $this->removeNode($node, $parent, $config, $path);

            }elseif($config['action'] === 'setNodeValue') { //修改Node值（针对叶节点）

                $this->setNodeValue($node, $parent, $config, $type, $path);

            }elseif($config['action'] === 'setNodeAttribute'){ //修改Node属性

                $this->setNodeAttribute($node, $parent, $config, $path);
            }
        }
    }


    public function handle($xml, $parent, $config, $debug = true, $path = [])
    {
        foreach ($xml->children() as $node) {

            if ($node->getName() === 'STUDY_COURSE'){
                echo '';
            }
            $path[] = $node->getName();

            if ($node->count()) { //非叶节点

                $type = 'notleaf';
                $this->handle($node, $xml, $config, $debug, $path);
                array_pop($path);
                $this->modifyTree($node, $xml, $config, $type, $path);

            } else { //叶节点

                $type = 'leaf';
                array_pop($path);
                $this->modifyTree($node, $xml, $config, $type, $path);

                if ($debug) {
                    echo '<hr />';
                    echo '<h5>Path = ['. implode('/', $path) . '/' . $node->getName() . ']</h5>';
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