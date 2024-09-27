<?php

namespace App\Imports;

use App\Models\Grade;
use App\Rules\Grade as GradeRule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class GradesImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        // Map column names from the file to model attributes
        $columnMapping = [
            'id' => 'id',
            '1st Quarter Grade' => 'firstQGrade',
            '2nd Quarter Grade' => 'secondQGrade',
            '3rd Quarter Grade' => 'thirdQGrade',
            '4th Quarter Grade' => 'fourthQGrade',
        ];

        $mappedRow = [];
        foreach ($columnMapping as $fileColumn => $modelColumn) {
            $mappedRow[$modelColumn] = $row[strtolower(str_replace(' ', '_', $fileColumn))];
        }

        // Handle non-numeric values for grades
        foreach ($mappedRow as $key => $value) {
            if (strpos($key, 'Grade') !== false && $value === 'ongoing') {
                $mappedRow[$key] = 'ongoing'; // Handle as needed
            }
        }

        // Validate the row data
        $validator = Validator::make($mappedRow, $this->rules());

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // Find existing grade record by ID
        $grade = Grade::where('id', $mappedRow['id'])->first();

        if ($grade) {
            // Update existing record
            $grade->update([
                'firstQGrade' => $mappedRow['firstQGrade'],
                'secondQGrade' => $mappedRow['secondQGrade'],
                'thirdQGrade' => $mappedRow['thirdQGrade'],
                'fourthQGrade' => $mappedRow['fourthQGrade'],
            ]);
        }

        return $grade;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:grades,id',
            'firstQGrade' => ['required', new GradeRule],
            'secondQGrade' => ['required', new GradeRule],
            'thirdQGrade' => ['required', new GradeRule],
            'fourthQGrade' => ['required', new GradeRule],
        ];
    }

    // this function will display the error messages
    public function customValidationMessages()
    {
        return [
            'id.required' => 'The ID field is required.',
            'id.integer' => 'The ID field must be an integer.',
            'id.exists' => 'The ID must exist in the grades table.',

            'firstQGrade.required' => 'The 1st Quarter Grade field is required.',
            'firstQGrade.numeric' => 'The 1st Quarter Grade must be a number.',
            'firstQGrade.min' => 'The 1st Quarter Grade must be at least 60.',
            'firstQGrade.max' => 'The 1st Quarter Grade may not be greater than 100.',

            'secondQGrade.required' => 'The 2nd Quarter Grade field is required.',
            'secondQGrade.numeric' => 'The 2nd Quarter Grade must be a number.',
            'secondQGrade.min' => 'The 2nd Quarter Grade must be at least 60.',
            'secondQGrade.max' => 'The 2nd Quarter Grade may not be greater than 100.',

            'thirdQGrade.required' => 'The 3rd Quarter Grade field is required.',
            'thirdQGrade.numeric' => 'The 3rd Quarter Grade must be a number.',
            'thirdQGrade.min' => 'The 3rd Quarter Grade must be at least 60.',
            'thirdQGrade.max' => 'The 3rd Quarter Grade may not be greater than 100.',

            'fourthQGrade.required' => 'The 4th Quarter Grade field is required.',
            'fourthQGrade.numeric' => 'The 4th Quarter Grade must be a number.',
            'fourthQGrade.min' => 'The 4th Quarter Grade must be at least 60.',
            'fourthQGrade.max' => 'The 4th Quarter Grade may not be greater than 100.',
        ];
    }
}
