<?php

namespace WalkModifyXmlTree\ResourceLoader;

class XmlLoader
{
    public static function loadExampleXML($xmlfile)
    {
        $str = file_get_contents($xmlfile);
        return $str;
    }
}
