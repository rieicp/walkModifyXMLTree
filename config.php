<?php
function getConfigurations()
{
    $config = [];

    $config[] = [
        'property' => 'COUNTRY_CODED',
        'path' => '*',
        'setvalue' => 'DE',
    ];

    $config[] = [
        'property' => 'REGULAR_STUDY_PERIOD',
        'path' => '*',
        'setvalue' => '2',
    ];

    return $config;
}
