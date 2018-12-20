<?php

$config = [];

/**
* 首先将所有叶节点的虚假值如'str1234'设为空
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
'value' => 'CAT-0123456789',
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
'value' => 'D',
];

$config[] = [
'action' => 'setNodeValue',
'nodename' => 'NAME',
'path' => 'HEADER/SUPPLIER/ADDRESS',
'value' => 'Sabc Wdef',
];

$config[] = [
'action' => 'setNodeValue',
'nodename' => 'PHONE',
'path' => '*',
'value' => '+49.521.1234567',
];

$couse_id = 'AKU-0123456';
$config[] = [
'action' => 'setNodeValue',
'nodename' => 'PRODUCT_ID',
'path' => 'NEW_CATALOG/SERVICE',
'value' => $couse_id,
];

$config[] = [
'action' => 'setNodeValue',
'nodename' => 'COURSE_ID',
'path' => 'NEW_CATALOG/SERVICE/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION',
'value' => $couse_id,
];

$config[] = [
'action' => 'setNodeValue',
'nodename' => 'TITLE',
'path' => 'NEW_CATALOG/SERVICE/SERVICE_DETAILS',
'value' => 'Abcdefg',
];

$config[] = [
'action' => 'setNodeValue',
'nodename' => 'DESCRIPTION_LONG',
'path' => 'NEW_CATALOG/SERVICE/SERVICE_DETAILS',
'value' => base64_encode(random_bytes(50)),
];

//修改属性----------------------------------------------------------------------

$config[] = [
'action' => 'setNodeAttribute',
'nodename' => 'EXTENDED_INFO',
'attribute' => 'input_type',
'path' => 'HEADER/SUPPLIER',
'value' => '2',
];

/*$config[] = [
'action' => 'setNodeAttribute',
'nodename' => 'SERVICE_PRICE',
'attribute' => 'type',
'path' => '*',
'value' => 'net_customer',
];*/

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
'value' => '1234567',
];

$config[] = [
'action' => 'setNodeAttribute',
'nodename' => 'CONTACT_ROLE',
'attribute' => 'type',
'path' => '*',
'value' => '1',
];

//??????
$config[] = [
'action' => 'setNodeAttribute',
'nodename' => 'EDUCATION',
'attribute' => 'type',
'path' => '*',
'value' => 'true',
];

$config[] = [
'action' => 'setNodeAttribute',
'nodename' => 'INSTRUCTION_FORM',
'attribute' => 'type',
'path' => '*',
'value' => '1',
];

$config[] = [
'action' => 'setNodeAttribute',
'nodename' => 'ORGANIZATIONAL_FORM',
'attribute' => 'type',
'path' => '*',
'value' => '1',
];

$config[] = [
    'action' => 'setNodeAttribute',
    'nodename' => 'EDUCATION_TYPE',
    'attribute' => 'type',
    'path' => '*',
    'value' => '100',
];

$config[] = [
    'action' => 'setNodeAttribute',
    'nodename' => 'INSTITUTION',
    'attribute' => 'type',
    'path' => '*',
    'value' => '101',
];


//删除属性----------------------------------------------------------------------

$config[] = [
'action' => 'removeNodeAttribute',
'nodename' => 'SERVICE_PRICE',
'attribute' => 'type',
'path' => '*',
];


return $config;
