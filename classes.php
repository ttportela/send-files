<?php
class FileHolder { 
    public $name;
    public $content;
    public $size;
    public $mime;

    public function toHTML() {
        return "<div style=\"margin-top: 10px;\">" .
            "   <span style=\"font-weight: bold;\">".$this->name.":</span>" .
            "   <pre class=\"prettyprint\" style=\"border: 1px solid black;margin: 0;white-space: pre-wrap;\">".print_r($this->content,true)."</pre>" .
            "</div>";
    }

    public function toLiHTML() {
        if ($this->mime != null) {
            return "   <li class=\"mdl-list__item\" style=\"padding-top: 0;padding-bottom: 0;min-height: 30px;\"><span class=\"mdl-list__item-primary-content\">
            <i class=\"material-icons mdl-list__item-icon mdl-color-text--cyan-A400\">description</i>".$this->name."</span>
                <span class=\"mdl-list__item-secondary-content\">".$this->size."B</span>
            </li>";
        } else {
            return "   <li class=\"mdl-list__item\" style=\"padding-top: 0;padding-bottom: 0;min-height: 30px;\"><span class=\"mdl-list__item-primary-content\">
            <i class=\"material-icons mdl-list__item-icon mdl-color-text--yellow-400\">warning</i>".
                    $this->name."</span>
                <span class=\"mdl-list__item-secondary-content mdl-color-text--red\">".$this->size."</span>
            </li>";
        }
        
    }
}   

class Person {
    public $name;
    public $mail;
    public $files; 
    
    function __construct() {
        $this->name = '';
        $this->mail = '';
        $this->files = array();
    }

    public function add($f) {
        array_push($this->files, $f);
    }   

    public function hasFiles() {
        return isset($this->files) && !empty($this->files);
    }

    public function toHTML() {
        $content = '';
        foreach ($this->files as $f) {
            $content .= $f->toHTML();
        }
        return '<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>Arquivos - '. $this->name . '</title>

</head>
<body style="max-width: 680px;">
    <h3>'. $this->name . '</h3>
    <hr/>
    <div id="print_files">
    '. $content .'
    </div>

    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>

</body>
</html>';
    }
}
?>