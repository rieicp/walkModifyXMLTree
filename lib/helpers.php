<?php

function convert2StandardConfigs($configs)
{
    $configsStd = [];
    if (!empty($configs['setNodeValue'])) {
        $configsStd = handleSetNodeValueConfigs($configs, $configsStd);
    }
    if (!empty($configs['addChildNode'])) {
        $configsStd = handleAddChildNodeConfigs($configs, $configsStd);
    }
    if (!empty($configs['setNodeAttribute'])) {
        $configsStd = handleSetNodeAttributeConfigs($configs, $configsStd);
    }

    return $configsStd;
}

/**
 * @param $configs
 * @param $configsStd
 * @return array
 *
 */
function handleSetNodeValueConfigs($configs, $configsStd)
{
    foreach ($configs['setNodeValue'] as $key => $val) {

        list($path, $nodename) = parseNodePath($key);

        $configsStd[] = [
            'action' => 'setNodeValue',
            'nodename' => $nodename,
            'path' => $path,
            'value' => $val,
        ];
    }
    return $configsStd;
}

/**
 * @param $configs
 * @param $configsStd
 * @return array
 *
 */
function handleSetNodeAttributeConfigs($configs, $configsStd)
{
    foreach ($configs['setNodeAttribute'] as $key => $val) {

        list($path, $nodename, $attribute) = parseNodePath($key);

        $configsStd[] = [
            'action' => 'setNodeAttribute',
            'nodename' => $nodename,
            'path' => $path,
            'attribute' => $attribute,
            'value' => $val,
        ];
    }
    return $configsStd;
}


/**
 * @param $key
 * @param $matches
 * @return array
 */
function parseNodePath($key)
{
    // Config目前只允许四种形式：
    //   - 单纯Nodename
    //   - */Nodename
    //   - path/to/Nodename
    //   - path/to/Nodename@Attribute
    $attribute = null;

    if (strpos($key, '/') === false) { //  config: 单纯Nodename

        $path = '*';
        $nodename = $key;

    } else {
        if (strpos($key, '*') === 0) { //  config: */Nodename

            list($path, $nodename) = explode('/', $key);

        } elseif (preg_match("/(.*)\/([a-zA-Z0-9_]+)$/", $key, $matches)) { //  config: path/to/Nodename

            $path = $matches[1];
            $nodename = $matches[2];

        }  elseif (preg_match("/(.*)\/([a-zA-Z0-9_]+)@([a-zA-Z0-9_]+)$/", $key, $matches)) { //  config: path/to/Nodename
            $path = $matches[1];
            $nodename = $matches[2];
            $attribute = $matches[3];
        }
    }

    return array($path, $nodename, $attribute);
}

/**
 * @param $configs
 * @param $configsStd
 * @return array
 */
function handleAddChildNodeConfigs($configs, $configsStd)
{
    foreach ($configs['addChildNode'] as $key => $val) {

        list($path, $nodename) = parseNodePath($key);

        $configsStd[] = [
            'action' => 'addChildNode',
            'nodename' => $nodename,
            'path' => $path,
            'snippet' => $val,
        ];
    }
    return $configsStd;
}

/**
 * @param $xmlsource
 * @param $xmlloader
 * @param $xmlhandler
 * @param $configs
 * @return SimpleXMLElement
 */
function handleXml($xmlsource, $xmlloader, $xmlhandler, $configs)
{
    $ext = pathinfo($xmlsource)['extension'];

    $str = ($ext == 'xml' && is_file($xmlsource))? $xmlloader->loadExampleXML($xmlsource) : $xmlsource;

    $xml = simplexml_load_string($str);

    $configsStd = convert2StandardConfigs($configs);

    $xmlhandler->setConfigs($configsStd);
    $xml = $xmlhandler->handle($xml);

    return $xml;
}
