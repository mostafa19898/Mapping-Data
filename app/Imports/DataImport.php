<?php

// App\Imports\DataImport.php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\MainData;

class DataImport implements ToModel
{
    public function model(array $row)
    {
        return new MainData([
            'id' => $row[0], // Assuming 'identifier' is in the first column (0-based index)
            'description' => $row[1], // Assuming 'description' is in the second column
        ]);
    }
}
