<?php
/** 
    @author Paweł Stempak
    @packege App/Actions;
    @filename LoadFileConent.php 
*/

namespace App\Actions\Load;

use App\Actions\Load\GetFileContent;

class LoadFileContent
{
    public $html_file;

    public function __construct(private string $file) 
    { 
        $new_file = new GetFileContent($file);
        $this->html_file = $new_file->getContent();
    }

    public function loadContent()
    {
        $html = new \DOMDocument();
        $errors = libxml_use_internal_errors(true);
        $html->loadHTML($this->html_file);
        return $html;
    }
}