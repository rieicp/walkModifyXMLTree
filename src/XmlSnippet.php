<?php

namespace WalkModifyXmlTree;

class XmlSnippet
{
    public function getSnippet($name)
    {

        $snippet_education = <<<EOF
                    <EDUCATION type="true">
                        <COURSE_ID>AKU-0123456789</COURSE_ID>
                        <EXTENDED_INFO>
                            <INSTITUTION type="123456789" />
                            <INSTRUCTION_FORM type="123456789"/>
                            <EDUCATION_TYPE type="123456789" />
                        </EXTENDED_INFO>
                        <MODULE_COURSE>
                            <LOCATION>
                                <NAME>S1234567</NAME>
                                <ZIP>33615</ZIP>
                                <CITY>Bielefeld</CITY>
                                <COUNTRY_CODED>DE</COUNTRY_CODED>
                                <COUNTRY>Germay</COUNTRY>
                            </LOCATION>
                            <DURATION type="1" />
                            <FLEXIBLE_START>true</FLEXIBLE_START>
                            <EXTENDED_INFO>
                                <SEGMENT_TYPE type="123456789" />
                            </EXTENDED_INFO>
                        </MODULE_COURSE>
                    </EDUCATION>
EOF;


        switch ($name){
            case 'EDUCATION':
                return $snippet_education;
                break;
            default:
                return '';
                break;
        }
    }

}