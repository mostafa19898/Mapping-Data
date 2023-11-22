<?php

namespace App\Http\Controllers;

use App\Services\MappingService;
use App\Services\FileService;
use App\Http\Requests\UploadRequest;
use Illuminate\Http\Request;
use App\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class ManualLinkingController extends Controller
{   
    use HasRoles;
    

    protected $mappingService , $fileService;
    public function __construct( mappingService $mappingService  , FileService $fileService )
    {    
       $this->mappingService = $mappingService;
       $this->fileService = $fileService;
    }

    public function upload(UploadRequest $request)
    {   

            $file = $request->file('excel_file');
            $headers = $this->fileService->processExcelFile($file);  
            $mainData = $this->mappingService->mainDataList();
            $reasons = $this->mappingService->reasonsList();          

            return view('display-columns', compact('mainData','reasons','headers'));

    }

    public function getAllMappings(){
        $mappings =  $this->mappingService->allMappings();
        return view('all-mappings', compact('mappings'));
    }

    public function showForm()
    {
        return view('upload-form');
    }

    public function saveMappingData(Request $request)
    {    
    
        $dataToSave = $request->dataToSave;
        $result = $this->mappingService->saveMappingData($dataToSave);
        return response()->json($result);

    }
    
    public function getSimilarityPercentage(Request $request){
        $dropdownValue = $request->dropdown_value;
        $id = $request->id;                      
        // Calculate the similarity percentage using similar_text function
        similar_text($dropdownValue, $id, $percentage);
        $percentageString = sprintf("%.2f%%", $percentage);   
        return response()->json(['message'=>$percentageString]);
    }

}
