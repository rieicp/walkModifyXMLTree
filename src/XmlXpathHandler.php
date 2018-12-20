<?php

namespace WalkModifyXmlTree;

//todo
//using xPath
class XmlXpathHandler
{
    private $configs;
    private $config;

    public function getConfigs()
    {
        return $this->configs;
    }

    public function setConfigs($configs)
    {
        $this->configs = $configs;
    }

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

    public function addChildNode($node)
    {
        $childnode = simplexml_load_string($this->config['snippet']);
        $this->sxml_append($node, $childnode);
    }

    public function removeNode($node)
    {
        $dom = dom_import_simplexml($node);
        $dom->parentNode->removeChild($dom);
    }

    public function keepOnlyTheseNodesOneByOne($node, $keptNodes)
    {
        if(!in_array($node, $keptNodes)){
            $this->removeNode($node);
        }
        echo '';
    }

    public function setNodeValue($node)
    {
        $nodename = $this->config['nodename'];
        if ($nodename === '*') {
            $nodename = '*|leaf';
        }
        if ($nodename === '*|leaf') {
            //todo: 将'str1234' 设置为常量
            if (dom_import_simplexml($node)->nodeValue === 'str1234') { //若叶节点为虚假值'str1234'则设置为新值
                dom_import_simplexml($node)->nodeValue = $this->config['value'];
            }
        } else {
            if ($node->getName() === $nodename) {
                dom_import_simplexml($node)->nodeValue = $this->config['value'];
            }
        }
    }

    public function setNodeAttribute($node)
    {
        dom_import_simplexml($node)->setAttribute($this->config['attribute'], $this->config['value']);
    }

    public function removeNodeAttribute($node)
    {
            dom_import_simplexml($node)->removeAttribute($this->config['attribute']);
    }

    public function modifyTree($nodes, $keptNodes=null)
    {
        foreach ($nodes as $node) {
            if($this->config['action'] === 'keepOnlyTheseNodes'){ //仅保留这些childNode

                $this->keepOnlyTheseNodesOneByOne($node, $keptNodes);

            }elseif($this->config['action'] === 'addChildNode'){ //添加childNode

                $this->addChildNode($node);

            }elseif($this->config['action'] === 'removeNode'){ //删除childNode

                $this->removeNode($node);

            }elseif($this->config['action'] === 'setNodeValue') { //修改Node值（针对叶节点）

                $this->setNodeValue($node);

            }elseif($this->config['action'] === 'setNodeAttribute'){ //修改Node属性

                $this->setNodeAttribute($node);

            }elseif($this->config['action'] === 'removeNodeAttribute'){ //修改Node属性

                $this->removeNodeAttribute($node);
            }
        }
    }


    public function handle($xml)
    {
        foreach ($this->configs as $config) {

            $this->config = $config;

            if (empty($config['path'])) {
                
                if (
                    (!empty($config['nodePaths'])) && 
                    (is_array($nodePaths = $config['nodePaths'])) &&
                    ($config['action'] === 'keepOnlyTheseNodes')
                ) {
                    $keptNodes = [];
                    foreach ($nodePaths as $nodePath){
                        $keptNodes = $this->appendNodes($keptNodes, $xml->xpath($nodePath.'/ancestor-or-self::*'));
                        $keptNodes = $this->appendNodes($keptNodes, $xml->xpath($nodePath.'/descendant::*'));
                    }
                    $allNodes = $xml->xpath('//*');
                    $this->modifyTree($allNodes, $keptNodes);
                }
                
            }else{
                
                if ($config['path'] === '*') { //模糊匹配

                    if ($config['nodename'] === '*|leaf') { //若是针对所有叶节点

                        $nodes = $xml->xpath('//*[not(*)]');

                    } else { //若非叶节点

                        $nodes = $xml->xpath('//' . $config['nodename']);
                    }

                } else { //精确匹配

                    $nodes = $xml->xpath($config['path'] . '/' . $config['nodename']);
                }

                $this->modifyTree($nodes);
            }
        }

        return $xml;
    }


    public function appendNodes($nodes, $nodes2append)
    {
        foreach ($nodes2append as $node) {
            $nodes[] = $node;
        }

        return $nodes;
    }
}
