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
        $dom = dom_import_simplexml($node);
        return simplexml_import_dom($dom->ownerDocument);
        /**
         * ownerDocument返回整个xml文档！而非仅仅该node
         * 可见node是包含着整个xml文档的完整信息的
         */
    }

    public function removeChildNode($node)
    {
        $dom = dom_import_simplexml($node);
        $dom->parentNode->removeChild($dom);
        return simplexml_import_dom($dom->ownerDocument);
    }

    public function keepOnlyTheseNodes($node)
    {
        //todo
        return;
    }

    public function setNodeAttribute($node)
    {
        //todo
        return;
    }

    public function setNodeValue($node)
    {
        //todo
        return;
    }

    public function modifyTree($nodes)
    {
        foreach ($nodes as $node) {
            if($this->config['action'] === 'keepOnlyTheseNodes'){ //仅保留这些childNode

                return $this->keepOnlyTheseNodes($node);

            }elseif($this->config['action'] === 'addChildNode'){ //添加childNode

                return $this->addChildNode($node);

            }elseif($this->config['action'] === 'removeChildNode'){ //删除childNode

                return $this->removeChildNode($node);

            }elseif($this->config['action'] === 'setNodeValue') { //修改Node值（针对叶节点）

                return $this->setNodeValue($node);

            }elseif($this->onfig['action'] === 'setNodeAttribute'){ //修改Node属性

                return $this->setNodeAttribute($node);
            }
        }
    }


    public function handle($xml)
    {
        foreach ($this->configs as $config) {

            $this->config = $config;

            if ($config['path'] === '*' || $config['path'] === '*|leaf') { //模糊匹配

                $nodes = $xml->xpath('//' . $config['nodename']);

            }else{ //精确匹配

                $nodes = $xml->xpath($config['path'] . '/' . $config['nodename']);
            }

            $xml = $this->modifyTree($nodes);
        }

        return $xml;
    }
}
