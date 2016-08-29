<?php
namespace Tool;

class xml2array{
    /**
     * xml专属组
     * @param $path      待转字符串
     * @param int $url   是否文件地址
     * @return mixed
     */
    public static function parse($path,$url=1){
        $ob =  $url?simplexml_load_string(file_get_contents($path)):simplexml_load_string($path);
        $json  = json_encode($ob);
        return json_decode($json,true);
    }

    var $out = array();
    var $parser;
    var $data;

    public function parse1($strInputXML){

        $this->parser = xml_parser_create();
        xml_set_object($this->parser, $this);
        xml_set_element_handler($this->parser, "tagOpen", "tagClosed");
        xml_set_character_data_handler($this->parser, "tagData");
        $this->data = xml_parse($this->parser, $strInputXML);
        if (!$this->data) {
            die(sprintf("XML error: %s at line %d",
                xml_error_string(xml_get_error_code($this->parser)),
                xml_get_current_line_number($this->parser)));
        }
        xml_parser_free($this->parser);

        return $this->out;
    }

    function tagOpen($parser, $name, $attrs){
        $tag = array();
        $tag['NAME'] = strtolower($name);
        if (count($attrs)) {
            $tag['ATTR'] = array();
            foreach ($attrs as $k => $v)
                $tag['ATTR'][strtolower($k)] = $v;
        }
        array_push($this->out, $tag);
    }

    function tagData($parser, $tagData) {
        $tagData = addslashes(trim($tagData));
        if (strlen($tagData)) {
            if (isset($this->out[count($this->out) - 1]['DATA'])) {
                $this->out[count($this->out) - 1]['DATA'] .= $tagData;
            } else {
                $this->out[count($this->out) - 1]['DATA'] = $tagData;
            }
        }
    }

    function tagClosed($parser, $name)
    {
        $child = $this->out[count($this->out) - 1];
        $name = $child['NAME'];
        if (isset($this->out[count($this->out) - 2]['SUB'][$name][0]['NAME'])) {
            $this->out[count($this->out) - 2]['SUB'][$name][] = $child;
        } elseif (isset($this->out[count($this->out) - 2]['SUB'][$name]['NAME'])) {
            $prev = $this->out[count($this->out) - 2]['SUB'][$name];
            $this->out[count($this->out) - 2]['SUB'][$name] = array($prev, $child);
        } else {
            $this->out[count($this->out) - 2]['SUB'][$name] = $child;
        }
        array_pop($this->out);
    }
}
