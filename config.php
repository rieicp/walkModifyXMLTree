<?php
function getConfigurations()
{
    $config = [];

    $config[] = [
        'action' => 'setNodeValue',
        'nodename' => 'COUNTRY_CODED',
        'path' => '*',
        'value' => 'DE',
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

    return $config;
}
