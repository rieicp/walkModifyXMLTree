<?php

use WalkModifyXmlTree\ResourceLoader\XmlSnippetLoader;

$configs = [];

//todo:与config/normal.php合并，是否可行？
//todo:若此配置文件为空，是否会产生错误？

//增加节点-----------------------------------------------------------------------

$snippet = new XmlSnippetLoader();
$section = $snippet->loadSnippet(__DIR__ . '/../Resources/snippet/education.xml');

$configs[] = [
    'action' => 'addChildNode',
    'nodename' => 'SERVICE_MODULE',
    'path' => '*',
    'snippet' => $section,
];


//仅保留这些节点（及其子节点）------------------------------------------
$configs[] = [
    'action' => 'keepOnlyTheseNodes',
    'nodePaths' => [
        '/OPENQCAT/HEADER/CATALOG/LANGUAGE',
        '/OPENQCAT/HEADER/CATALOG/CATALOG_ID',
        '/OPENQCAT/HEADER/CATALOG/CATALOG_VERSION',
        '/OPENQCAT/HEADER/SUPPLIER/SUPPLIER_ID',
        '/OPENQCAT/HEADER/SUPPLIER/SUPPLIER_NAME',
        '/OPENQCAT/HEADER/SUPPLIER/ADDRESS/NAME',
        '/OPENQCAT/HEADER/SUPPLIER/ADDRESS/ZIP',
        '/OPENQCAT/HEADER/SUPPLIER/ADDRESS/CITY',
        '/OPENQCAT/HEADER/SUPPLIER/ADDRESS/COUNTRY',
        '/OPENQCAT/HEADER/SUPPLIER/CONTACT/CONTACT_ROLE',
        '/OPENQCAT/HEADER/SUPPLIER/CONTACT/FIRST_NAME',
        '/OPENQCAT/HEADER/SUPPLIER/CONTACT/LAST_NAME',
        '/OPENQCAT/HEADER/SUPPLIER/KEYWORD',
        '/OPENQCAT/HEADER/SUPPLIER/EXTENDED_INFO/INSTITUTION_NUMBER',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/PRODUCT_ID',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/COURSE_TYPE',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/TITLE',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/DESCRIPTION_LONG',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/CONTACT/CONTACT_ROLE',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/CONTACT/LAST_NAME',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/CONTACT/ADDRESS/NAME',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/CONTACT/ADDRESS/ZIP',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/CONTACT/ADDRESS/CITY',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/CONTACT/ADDRESS/COUNTRY_CODED',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/CONTACT/ADDRESS/COUNTRY',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/CONTACT/ADDRESS/EMAILS/EMAIL',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/SERVICE_DATE/START_DATE',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/SERVICE_DATE/END_DATE',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/COURSE_ID',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/EXTENDED_INFO/INSTITUTION',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/EXTENDED_INFO/INSTRUCTION_FORM',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/EXTENDED_INFO/EDUCATION_TYPE',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/MODULE_COURSE/LOCATION/NAME',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/MODULE_COURSE/LOCATION/ZIP',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/MODULE_COURSE/LOCATION/CITY',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/MODULE_COURSE/LOCATION/COUNTRY_CODED',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/MODULE_COURSE/LOCATION/COUNTRY',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/MODULE_COURSE/DURATION',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/MODULE_COURSE/FLEXIBLE_START',
        '/OPENQCAT/NEW_CATALOG/SERVICE[1]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/MODULE_COURSE/EXTENDED_INFO/SEGMENT_TYPE',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/PRODUCT_ID',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/COURSE_TYPE',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/TITLE',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/DESCRIPTION_LONG',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/CONTACT/CONTACT_ROLE',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/CONTACT/LAST_NAME',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/CONTACT/ADDRESS/NAME',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/CONTACT/ADDRESS/ZIP',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/CONTACT/ADDRESS/CITY',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/CONTACT/ADDRESS/COUNTRY_CODED',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/CONTACT/ADDRESS/COUNTRY',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/CONTACT/ADDRESS/EMAILS/EMAIL',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/SERVICE_DATE/START_DATE',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/SERVICE_DATE/END_DATE',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/COURSE_ID',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/EXTENDED_INFO/INSTITUTION',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/EXTENDED_INFO/INSTRUCTION_FORM',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/EXTENDED_INFO/EDUCATION_TYPE',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/MODULE_COURSE/LOCATION/NAME',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/MODULE_COURSE/LOCATION/ZIP',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/MODULE_COURSE/LOCATION/CITY',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/MODULE_COURSE/LOCATION/COUNTRY_CODED',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/MODULE_COURSE/LOCATION/COUNTRY',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/MODULE_COURSE/DURATION',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/MODULE_COURSE/FLEXIBLE_START',
        '/OPENQCAT/NEW_CATALOG/SERVICE[2]/SERVICE_DETAILS/SERVICE_MODULE/EDUCATION/MODULE_COURSE/EXTENDED_INFO/SEGMENT_TYPE',    ]
];

//删除节点-----------------------------------------------------------------------

/*$configs[] = [
    'action' => 'removeNode',
    'nodename' => 'STUDY_COURSE',
    'path' => 'NEW_CATALOG/SERVICE/SERVICE_DETAILS',
];*/


return $configs;
