<?php
namespace Mokos\Template;
/**
 * @author http://phpdao.com
 */
class Template {
    /**
     * @var string path to template file
     */
    private $template;
    /**
     * @var string content of template file 
     */
    private $content;
    /**
     * @param string $template path to template file
     */
    function __construct($template)
    {
        $this->template = $template;
        $this->content = $this->getContent();
    }
    /**
     * Set value into variable in template
     * @param type $key
     * @param type $value
     */
    function set($key, $value)
    {
        $this->content = str_replace('${'.$key.'}', $value, $this->content);	
    }
    /**
     * @return string contains of template
     */
    function getContent()
    {
        $retval = '';
        $template = fopen ($this->template, "r");
        while (!feof ($template)) {
            $buffer = fgets($template, 4096);
            $retval .= $buffer;
        }
        fclose ($template);
        return $retval;			
    }
    /**
     * Write content from template to new file
     * @param string $fileName path include filename
     */	
    function write($fileName)
    {
        $fd = fopen ($fileName, "w");
        fwrite($fd, $this->content);
        fclose ($fd);
    }
}