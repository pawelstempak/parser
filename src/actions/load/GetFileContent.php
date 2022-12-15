<?php
/** 
    @author Paweł Stempak
    @packege App/Class;
    @filename GetFileConent.php 
*/

namespace App\Actions\Load;

class GetFileContent
{
    public function __construct(private string $filepath) { }

    public function getContent(): string
    {
        $htmlfile = file_get_contents($this->filepath, FILE_USE_INCLUDE_PATH);
        return $htmlfile;
    }
}