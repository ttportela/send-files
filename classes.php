<?php
class FileHolder { 
    public $name;
    public $content;

    public function toHTML() {
        return "<div>" .
            "   <span>".$this->name.":</span>" .
            "   <pre class=\"prettyprint\" style=\"border: 1px solid black;margin: 0;\">".print_r($this->content,true)."</pre>" .
            "</div>";
    }
}   

class Person {
    public $name;
    public $mail;
    public $files; 
    
    function __construct() {
        $this->files = array();
    }

    public function add($f) {
        array_push($this->files, $f);
    }   
}
?>