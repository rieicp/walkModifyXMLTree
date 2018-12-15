<?php

namespace WalkModifyXmlTree;

class XmlLoader
{
    public static function getExampleXML($xmlfile)
    {
        $str = file_get_contents($xmlfile);
        return $str;
    }
}
