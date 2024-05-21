<?php

namespace App\Imports;

use App\Models\Grade;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GradesImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Find existing grade record by ID
        $grade = Grade::where('id', $row[str_replace(' ', '_', strtolower('ID'))])->first();
    
        if ($grade) {
            // Update existing record
            $grade->update([
                'firstQGrade' => $row[str_replace(' ', '_', strtolower('1st Quarter Grade'))],
                'secondQGrade' => $row[str_replace(' ', '_', strtolower('2nd Quarter Grade'))],
                'thirdQGrade' => $row[str_replace(' ', '_', strtolower('3rd Quarter Grade'))],
                'fourthQGrade' => $row[str_replace(' ', '_', strtolower('4th Quarter Grade'))],
            ]);
        }
    
        return $grade;
    }
    
}
