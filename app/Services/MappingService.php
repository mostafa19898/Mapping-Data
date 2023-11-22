<?php 
namespace app\Services;

use App\Models\MainData;
use App\Models\Reason;
use App\Models\Mapping;
use Illuminate\Support\Facades\DB;
class MappingService {

    public function mainDataList()
    {
      try {
      $mainData = MainData::all();
      return $mainData;
      }
    catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
      }
    }

    public function reasonsList()
    {
        try {
        $reasons = Reason::all();
        return $reasons;
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function allMappings()
    {
    try {
       $mappings = Mapping::all();
       return $mappings;
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function saveMappingData($dataToSave)
    {
        try {

            DB::beginTransaction();
            
            foreach ($dataToSave as $data) {
                if (isset($data['mainDataId']) && isset($data['reasonsId'])) {
                    $mainDataId = $data['mainDataId'];
                    $reasonsId = $data['reasonsId'];
    
                    if (isset($data['selectedColumns']) && !empty($data['selectedColumns'])) {
                        $selectedColumns = $data['selectedColumns'];
                        $concatenatedColumns = implode(', ', $selectedColumns);
    
                        $mapping = Mapping::where(function ($query) use ($selectedColumns) {
                            foreach ($selectedColumns as $column) {
                                $query->orWhere('description', 'LIKE', '%' . $column . '%');
                            }
                        })
                        ->first();
    
                        if ($mapping) {
                            $mapping->update([
                                'main_data_id' => $mainDataId,
                                'reason_id' => $reasonsId,
                                'description' => $concatenatedColumns,
                            ]);
                        } else {
                            Mapping::create([
                                'description' => $concatenatedColumns,
                                'main_data_id' => $mainDataId,
                                'reason_id' => $reasonsId,
                            ]);
                        }
                    }
                }
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Data saved successfully']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    
      
    
}

