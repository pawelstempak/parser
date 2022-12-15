<?php
/** 
    @author Paweł Stempak
    @packege App;
    @filename index.php 
*/

require __DIR__ . '/../vendor/autoload.php';

use App\Actions\Load\LoadFileContent;
use App\Actions\CreateCSV;

$file = new LoadFileContent('../orders/wo_for_parse.html');
$html_content = $file->loadContent();

$tags = [
    'wo_number',
    'po_number',
    'scheduled_date',
    'customer',
    'trade',
    'nte',
    'store_id',
    'location_address',
    'location_phone'
];

$heads = [
    'wo_number',
    'po_number',
    'scheduled_date',
    'customer',
    'trade',
    'nte',
    'store_id',
    'street',
    'city',
    'state',
    'code',
    'location_phone'    
];

$new_file = new CreateCSV($html_content, $tags, $heads, 'newfile.csv');
$new_file->Parsing(); 


