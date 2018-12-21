<?php

function convert2StandardConfigs($configs)
{
    $configsStd = [];
    $configsStd = handleSetNodeValueConfigs($configs, $configsStd);

    return $configsStd;
}

/**
 * @param $configs
 * @param $configsStd
 * @return array
 */
function handleSetNodeValueConfigs($configs, $configsStd): array
{
    foreach ($configs['setNodeValue'] as $key => $val) {

        if (strpos($key, '/') === false) {

            $path = '*';
            $nodename = $key;

        } else {

            list($path, $nodename) = explode('/', $key);
        }

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
 * @param $file
 * @param $xmlloader
 * @param $xmlhandler
 * @param $configs
 * @return SimpleXMLElement
 */
function handleXml($file, $xmlloader, $xmlhandler, $configs)
{
    $str = $xmlloader->loadExampleXML($file);
    $xml = simplexml_load_string($str);

    $configsStd = convert2StandardConfigs($configs);

    $xmlhandler->setConfigs($configsStd);
    $xml = $xmlhandler->handle($xml);

    return $xml;
}
