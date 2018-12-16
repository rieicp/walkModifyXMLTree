<?php

namespace WalkModifyXmlTree;

class XmlSnippetLoader
{
    public function loadSnippet($file)
    {
        return file_get_contents($file);
    }
}
