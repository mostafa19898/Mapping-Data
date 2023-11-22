
/*public function manualLinkingWithSelection(){
        $mainData = MainData::all();     
         return view('manual_linking', compact('mainData'));
    }
    */

    public function getDropdownData()
    {
        $dropdownData = MainData::select('id', 'description')->get(); // Adjust as per your database table columns
        return response()->json($dropdownData);
    }
    
    public function saveMappingData(Request $request){

        $mainDataId = $request->main_data_id;
        $description = $request->description;

        DB::table('mapping')->insert([ 
        'main_data_id' => $mainDataId,
        'description' => $description,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at'=> date('Y-m-d H:i:s')
        ]);
        
        return response()->json(['message' => 'Mapping data saved successfully']);
    }

    public function getSimilarityPercentage(Request $request){

        $dropdownValue = $request->dropdown_value;
        $id = $request->id;
              
        // Calculate the similarity percentage using similar_text function
        $similar_text = similar_text($dropdownValue, $id, $percentage);
       
        $percentageString = sprintf("%.2f%%", $percentage);   
        return response()->json(['message'=>$percentageString]);
    }




    /*public function upload(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);
    
        $file = $request->file('excel_file');
        $path = $file->storeAs('uploads', $file->getClientOriginalName(), 'public');
    
        // Read Excel file and process columns
        $data = Excel::toArray([], $path);
    
        // Assuming the first row contains column headers
        $headers = $data[0];
        $headersCollection = new Collection($headers);

        $mainData = MainData::all();     
        $reasons = Reason::all();
        
        return view('display-columns', compact('headers','mainData','reasons'));
    }
    */





    // Return the similarity percentages as JSON response

/*
public function compare(Request $request)
{
    $percentages = [];
    
    // Get the main data and selected columns from the request
    $mainData = $request->mainData;
    $selectedColumns = $request->selectedColumns;

    // Iterate through each column
    foreach ($selectedColumns as $column) {
        // Calculate the Levenshtein distance
        $levenshteinDistance = levenshtein($mainData, $column);

        $maxLength = max(strlen($mainData), strlen($column));
        $similarityPercentage = ($maxLength - $levenshteinDistance) / $maxLength * 100;

        // Ensure the similarity percentage is within the range of 0% to 100%
        $similarityPercentage = max(0, min(100, $similarityPercentage));

        // Round and format the similarity percentage with two decimal places
        $formattedPercentage = number_format($similarityPercentage, 2) . '%';
        
        // Store the similarity percentage for each selected column
        $percentages[] = [
            'selected_column' => $column,
            'similarity' => $formattedPercentage,
        ];
    }

    // Return the similarity percentages as JSON response
    return response()->json($percentages);
}

*/


/*
    public function saveMappingData(Request $request){

        $dataToSave = $request->dataToSave;
        
        foreach ($dataToSave as $data) {
            // Check if mainDataId and reasonsId are set
            if (isset($data['mainDataId']) && isset($data['reasonsId'])) {

                $mainDataId = $data['mainDataId'];
                $reasonsId = $data['reasonsId'];
                // Check if selectedColumns is set and not empty
                if (isset($data['selectedColumns']) && !empty($data['selectedColumns'])) {

                    $selectedColumns = $data['selectedColumns'];
                    
                    $concatenatedColumns = implode(', ', $selectedColumns);

                   $mapping = Mapping::where('description', $concatenatedColumns)->first();
                  
                   if ($mapping) {
                    // Update the existing record
                    $mapping->update([
                        'main_data_id' => $mainDataId,
                        'reason_id' => $reasonsId,
                        // Add other fields as needed
                    ]);
                } else {
                    // Create a new record
                    Mapping::updateOrCreate(
                        ['description' => $concatenatedColumns],
                        [
                            'main_data_id' => $mainDataId,
                            'reason_id' => $reasonsId,
                            // Add other fields as needed
                        ]
                    );
                   }
                }
            }
        }
        
    
        return response()->json(['message' => 'Mapping data saved successfully']);
    }
    
*/


use Illuminate\Support\Str;
use Stringy\Stringy;
//use Maatwebsite\Excel\Facades\Excel;
//use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Imports\DataImport;
use App\Models\Mapping;
use App\Models\Reason;
use App\Models\MainData;




/*
            $('select[name="main_data_options[]"], input[name="selected_columns[]"]').change(function() {
            // Get the parent row of the changed element
            var parentRow = $(this).closest('tr');
            // Prepare data
            var mainData = parentRow.find('select[name="main_data_options[]"] option:selected').text();

            var selectedColumns = parentRow.find('input[name="selected_columns[]"]:checked').map(function() {
                return $(this).val();

            }).get();

            // Send AJAX request
            $.ajax({
                url: '/compare',
                type: 'POST',
                data: {
                    mainData: mainData,
                    selectedColumns: selectedColumns
                },
                success: function(response) {
                    // Update the result table with the response
                    var resultTableBody = $('#result-table-body');
                    var resultRow = '<tr><td>' + mainData + '</td>';

                    $.each(response, function(index, similarity) {
                        resultRow += '<td>' + selectedColumns + '</td>';
                    });

                    resultRow += '</tr>';
                    resultTableBody.html(resultRow);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

      */

        // Add an event listener for changes in the dropdown and checkboxes
        /*
        $('select[name="main_data_options[]"], input[name="selected_columns[]"]').change(function() {
            // Prepare data
            var mainData = $('select[name="main_data_options[]"] option:selected').text();
         
            var selectedColumns = $('input[name="selected_columns[]"]:checked').map(function() {
                return this.value;
            }).get();

            // Send AJAX request
            $.ajax({
                url: '/compare',
                type: 'POST',
                data: {
                    mainData: mainData,
                    selectedColumns: selectedColumns
                },
                success: function(response) {
                   // Assuming response is an array with similarity percentages
                    var tableBody = $('#result-table-body');

                    // Clear existing rows
                    tableBody.empty();

                    // Iterate through the response and append new rows to the table
                    $.each(response, function(index, similarity) {
                        var newRow = '<tr>' +
                            '<td>' + similarity.selected_column + '</td>' +
                            '<td>' + similarity.similarity + '</td>' +
                            '</tr>';

                        tableBody.append(newRow);
                        });
                                },
                                error: function(error) {
                                    console.log(error);
                                }
                            });
                        });

*/
        /*$('#saveButton').on('click', function() {

               var mainData = $('select[name="main_data_options[]"] option:selected').text();
               var mainDataId = $('select[name="main_data_options[]"]').val();
               var reasonsId = $('select[name="reasons_options[]"]').val();
               var selectedColumns = $('input[name="selected_columns[]"]:checked').map(function() {
                    return this.value;
                }).get();        

                $.ajax({
                    url: '/saveMappingData',
                    type: 'POST',
                    data: {
                        mainData: mainDataId,
                        reasonsId:reasonsId,
                        selectedColumns: selectedColumns
                    },
                    success: function(response) {

                        Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "data has been updated",
                        showConfirmButton: false,
                        timer: 1500,
                        customClass: {
                            content: 'custom-swal-content' // Add your custom class here
                        }
                        });
                        // Handle the success response (if needed)
                        console.log(response);
                    },
                    error: function(error) {
                        // Handle the error response (if needed)
                        console.log(error);
                    }
                });
        });*/

