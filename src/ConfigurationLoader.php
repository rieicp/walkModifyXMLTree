<?php

namespace WalkModifyXmlTree;

use WalkModifyXmlTree\XmlSnippet;

class ConfigurationLoader
{
    public function getConfigurations()
    {
        $config = [];

        /**
         * 首先将所有叶节点的虚假值从'str1234'设为空
         */
        $config[] = [
            'action' => 'setNodeValue',
            'nodename' => '*|leaf', //所有的叶节点
            'path' => '*',
            'value' => '',
        ];

        //---------------------------------------------------

        $config[] = [
            'action' => 'setNodeValue',
            'nodename' => 'CATALOG_ID',
            'path' => '*',
            'value' => 'KUR-0123456789',
        ];

        $config[] = [
            'action' => 'setNodeValue',
            'nodename' => 'CATALOG_VERSION',
            'path' => '*',
            'value' => '0.0.12',
        ];

        $config[] = [
            'action' => 'setNodeValue',
            'nodename' => 'COUNTRY_CODED',
            'path' => '*',
            'value' => 'DE',
        ];

        $config[] = [
            'action' => 'setNodeValue',
            'nodename' => 'COUNTRY',
            'path' => '*',
            'value' => 'Germany',
        ];

        $config[] = [
            'action' => 'setNodeValue',
            'nodename' => 'REGULAR_STUDY_PERIOD',
            'path' => '*',
            'value' => '2',
        ];

        $config[] = [
            'action' => 'setNodeAttribute',
            'nodename' => 'SERVICE_PRICE',
            'attribute' => 'type',
            'path' => '*',
            'value' => 'net_customer',
        ];

        $snippet = new XmlSnippet();

        $config[] = [
            'action' => 'addChildNode',
            'nodename' => 'SERVICE_MODULE',
            'path' => '*',
            'snippet' => $snippet->getSnippet('EDUCATION'),
        ];

        return $config;
    }
}