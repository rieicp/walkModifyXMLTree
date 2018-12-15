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

//修改（叶）节点的值---------------------------------------------------

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
            'action' => 'setNodeValue',
            'nodename' => 'NAME',
            'path' => 'HEADER\SUPPLIER\ADDRESS',
            'value' => 'Sabc Wdef',
        ];

//修改属性----------------------------------------------------------------------

        $config[] = [
            'action' => 'setNodeAttribute',
            'nodename' => 'SERVICE_PRICE',
            'attribute' => 'type',
            'path' => '*',
            'value' => 'net_customer',
        ];

        $config[] = [
            'action' => 'setNodeAttribute',
            'nodename' => 'SEGMENT_TYPE',
            'attribute' => 'type',
            'path' => '*',
            'value' => '1',
        ];

        $config[] = [
            'action' => 'setNodeAttribute',
            'nodename' => 'EDUCATION_TYPE',
            'attribute' => 'type',
            'path' => '*',
            'value' => '1',
        ];

//增加节点-----------------------------------------------------------------------

        $snippet = new XmlSnippet();
        $section = $snippet->getSnippet('EDUCATION');

        $config[] = [
            'action' => 'addChildNode',
            'nodename' => 'SERVICE_MODULE',
            'path' => '*',
            'snippet' => $section,
        ];

        return $config;
    }
}