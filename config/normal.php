<?php

$configs = [];

/**
* 首先将所有叶节点的虚假值如'str1234'设为空
*/
$configs[] = [
'action' => 'setNodeValue',
'nodename' => '*|leaf', //所有的叶节点
'path' => '*',
'value' => '',
];

//修改（叶）节点的值---------------------------------------------------

$configs[] = [
'action' => 'setNodeValue',
'nodename' => 'CATALOG_ID',
'path' => '*',
'value' => 'CAT-0123456789',
];

$configs[] = [
'action' => 'setNodeValue',
'nodename' => 'CATALOG_VERSION',
'path' => '*',
'value' => '0.0.12',
];

$configs[] = [
'action' => 'setNodeValue',
'nodename' => 'COUNTRY_CODED',
'path' => '*',
'value' => 'DE',
];

$configs[] = [
'action' => 'setNodeValue',
'nodename' => 'COUNTRY',
'path' => '*',
'value' => 'D',
];

$configs[] = [
'action' => 'setNodeValue',
'nodename' => 'NAME',
'path' => 'HEADER/SUPPLIER/ADDRESS',
'value' => 'Sabc Wdef',
];

$configs[] = [
'action' => 'setNodeValue',
'nodename' => 'PHONE',
'path' => '*',
'value' => '+49.521.1234567',
];

$couse_id = 'AKU-0123456';
$configs[] = [
'action' => 'setNodeValue',
'nodename' => 'PRODUCT_ID',
'path' => 'NEW_CATALOG/SERVICE',
'value' => $couse_id,
];

$configs[] = [
'action' => 'setNodeValue',
'nodename' => 'COURSE_ID',
'path' => 'NEW_CATALOG/SERVICE/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION',
'value' => $couse_id,
];

$configs[] = [
'action' => 'setNodeValue',
'nodename' => 'TITLE',
'path' => 'NEW_CATALOG/SERVICE/SERVICE_DETAILS',
'value' => 'Abcdefg',
];

$configs[] = [
'action' => 'setNodeValue',
'nodename' => 'DESCRIPTION_LONG',
'path' => 'NEW_CATALOG/SERVICE/SERVICE_DETAILS',
'value' => base64_encode(random_bytes(50)),
];

//修改属性----------------------------------------------------------------------

$configs[] = [
'action' => 'setNodeAttribute',
'nodename' => 'EXTENDED_INFO',
'attribute' => 'input_type',
'path' => 'HEADER/SUPPLIER',
'value' => '2',
];

/*$configs[] = [
'action' => 'setNodeAttribute',
'nodename' => 'SERVICE_PRICE',
'attribute' => 'type',
'path' => '*',
'value' => 'net_customer',
];*/

$configs[] = [
'action' => 'setNodeAttribute',
'nodename' => 'SEGMENT_TYPE',
'attribute' => 'type',
'path' => '*',
'value' => '1',
];

$configs[] = [
'action' => 'setNodeAttribute',
'nodename' => 'EDUCATION_TYPE',
'attribute' => 'type',
'path' => '*',
'value' => '1234567',
];

$configs[] = [
'action' => 'setNodeAttribute',
'nodename' => 'CONTACT_ROLE',
'attribute' => 'type',
'path' => '*',
'value' => '1',
];

//??????
$configs[] = [
'action' => 'setNodeAttribute',
'nodename' => 'EDUCATION',
'attribute' => 'type',
'path' => '*',
'value' => 'true',
];

$configs[] = [
'action' => 'setNodeAttribute',
'nodename' => 'INSTRUCTION_FORM',
'attribute' => 'type',
'path' => '*',
'value' => '1',
];

$configs[] = [
'action' => 'setNodeAttribute',
'nodename' => 'ORGANIZATIONAL_FORM',
'attribute' => 'type',
'path' => '*',
'value' => '1',
];

$configs[] = [
    'action' => 'setNodeAttribute',
    'nodename' => 'EDUCATION_TYPE',
    'attribute' => 'type',
    'path' => '*',
    'value' => '100',
];

$configs[] = [
    'action' => 'setNodeAttribute',
    'nodename' => 'INSTITUTION',
    'attribute' => 'type',
    'path' => '*',
    'value' => '101',
];


//删除属性----------------------------------------------------------------------

$configs[] = [
'action' => 'removeNodeAttribute',
'nodename' => 'SERVICE_PRICE',
'attribute' => 'type',
'path' => '*',
];


return $configs;
