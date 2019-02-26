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

    return $configsStd;
}

/**
 * @param $configs
 * @param $configsStd
 * @return array
 *
 */
function handleSetNodeValueConfigs($configs, $configsStd): array
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
 * @param $key
 * @param $matches
 * @return array
 */
function parseNodePath($key)
{
    // Config目前只允许三种形式：
    //   - 单纯Nodename
    //   - */Nodename
    //   - path/to/Nodename
    if (strpos($key, '/') === false) { //  config: 单纯Nodename

        $path = '*';
        $nodename = $key;

    } else {
        if (strpos($key, '*') === 0) { //  config: */Nodename

            list($path, $nodename) = explode('/', $key);

        } elseif (preg_match("/(.*)\/([a-zA-Z0-9_]+)$/", $key, $matches)) { //  config: path/to/Nodename

            $path = $matches[1];
            $nodename = $matches[2];
        }
    }

    return array($path, $nodename);
}

/**
 * @param $configs
 * @param $configsStd
 * @return array
 */
function handleAddChildNodeConfigs($configs, $configsStd): array
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
    $str = is_file($xmlsource)? $xmlloader->loadExampleXML($xmlsource) : $xmlsource;
    
    $xml = simplexml_load_string($str);

    $configsStd = convert2StandardConfigs($configs);

    $xmlhandler->setConfigs($configsStd);
    $xml = $xmlhandler->handle($xml);

    return $xml;
}
