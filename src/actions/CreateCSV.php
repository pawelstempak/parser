<?php
/** 
    @author Paweł Stempak
    @packege App/Class;
    @filename CreateCSV.php 
*/

namespace App\Actions;

use App\Contracts\Parser;

class CreateCSV implements Parser
{
    public function __construct(public $data, public $tags, public $heads, public $csv_file){}

    public function Parsing()
    {
        $row = [];
        $file_handle = fopen($this->csv_file, 'w');
        fputcsv($file_handle, $this->heads);    
        foreach($this->tags as $tag)
        {
            $id = $this->data->getElementById($tag);
            switch($tag)
            {
                case 'scheduled_date':
                    $value = preg_replace('/\s\s+/',' ', $id->nodeValue);
                    $scheduled_date = date("Y-m-d H:i",strtotime($value));
                    array_push($row, trim($scheduled_date));
                break;
                case 'nte':
                    $value = preg_replace("/[^0-9.]/", "", $id->nodeValue );
                    $nte = floatval($value);
                    array_push($row, trim($nte));
                break;
                case 'location_address':
                    $location_address = explode("\n", trim($id->nodeValue));
                    $address_value = trim($location_address[0]);
                    $street = preg_replace("/[^a-zA-Z]/", "", $address_value);
                    array_push($row, trim($street));
                    $post = explode(" ", preg_replace('/\s\s+/'," ", trim($location_address[1])));
                    array_push($row, trim($post[0]));
                    array_push($row, trim($post[1]));
                    array_push($row, trim($post[2]));
                break;            
                case 'location_phone':
                    $value = preg_replace("/[^0-9.]/", "", $id->nodeValue );
                    $location_phone = floatval($value);
                    array_push($row, trim($location_phone));
                break;                
                default:
                    array_push($row, trim($id->nodeValue));
                break;
            }
        }
        fputcsv($file_handle, $row); 
        fclose($file_handle);
    }
}