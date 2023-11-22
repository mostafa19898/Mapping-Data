<?php 
namespace App\Services;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;

class FileService 
{
    public function processExcelFile( $file )
    {
       $path = $file->storeAs('uploads', $file->getClientOriginalName(), 'public');
       $data = Excel::toArray([], $path);
       $headers = $data[0];
       $headersCollection = new Collection($headers);
       return $headersCollection;
    }
}