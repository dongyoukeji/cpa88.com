<?php
/**
 * Created by PhpStorm.
 * User: 魏巍
 * Date: 2015/6/16
 * Time: 17:04
 */

namespace Tool;

class xml2json{

/*
class xml2json {
    public static function parse($path,$url=1){
        $ob =  $url?simplexml_load_string(file_get_contents($path)):simplexml_load_string($path);
        return json_encode($ob);
    }
}*/

// XML2Json 主程式
/// XML2JsonSub 遞迴需要用的子程式
/// Xml2Array - 由 php.net 抓來的 Xml Parse(此 class 可 parse 出 tag 中的屬性)
/*
// example:
$rss = file_get_contents('rss.xml');
$json = Xml2Json($rss);
echo $json;
 */
    public function Xml2Json($xml_data)
    {

        $xml2Array = new xml2Array();
        $xml = $xml2Array->parse($xml_data);
        $json = array();

        for($i = 0, $c = count($xml); $i < $c; $i++) {
            array_push($json, $this->Xml2JsonSub($xml[$i]));
        }

        return '{'. implode(', ', $json) .'}';
    }

    function Xml2JsonKey($xml)
    {
        return '"' . $xml['NAME'] . '"';
    }

    function Xml2JsonValue($xml)
    {
        $values = array();
        if (isset($xml['ATTR']) && is_array($xml['ATTR']) && count($xml['ATTR']))
        {
            foreach ($xml['ATTR'] as $k => $v)
            {
                $values["@$k"] = '"' . $v . '"';
            }
        }

        if (isset($xml['DATA']))
        {
            $values['#text'] = '"' . $xml['DATA'] . '"';
        }

        if (isset($xml['SUB']) && is_array($xml['SUB']) && count($xml['SUB']))
        {
            foreach ($xml['SUB'] as $name => $sub)
            {
                $_sub = array();
                if (isset($sub[0]['NAME']))
                {
                    $subarray = array();
                    foreach ($sub as $s)
                    {
                        array_push($subarray, $this->Xml2JsonValue($s));
                    }
                    $values[$name] = '[ ' . implode(', ', $subarray) . ' ]';
                }
                else
                {
                    $values[$name] = $this->Xml2JsonValue($sub);
                }
            }
        }

        if (!count($values))
            return 'null';
        elseif (count($values) == 1 && isset($values['#text']))
            return $values['#text'];
        else
        {
            $ret = array();
            foreach ($values as $k => $v)
            {
                array_push($ret, '"' . $k . '": ' . $v);
            }
            return '{ ' . implode(', ', $ret) . ' }';
        }
    }

    function Xml2JsonSub($xml)
    {
        return $this->Xml2JsonKey($xml) . ': ' . $this->Xml2JsonValue($xml);
    }


}


 class xml2Array
 {
     var $out = array();
     var $parser;
     var $data;

     function parse($strInputXML)
     {
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

     function tagOpen($parser, $name, $attrs)
     {
         $tag = array();
         $tag['NAME'] = strtolower($name);
         if (count($attrs)) {
             $tag['ATTR'] = array();
             foreach ($attrs as $k => $v)
                 $tag['ATTR'][strtolower($k)] = $v;
         }
         array_push($this->out, $tag);
     }

     function tagData($parser, $tagData)
     {
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