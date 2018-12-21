<?php

namespace WalkModifyXmlTree\ResourceLoader;

class XmlSnippetLoader
{
    public function loadSnippet($file)
    {
        return file_get_contents($file);
    }
}
