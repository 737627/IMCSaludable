<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app/public/foods.csv');
        
        if (!File::exists($file)) {
            $this->command->error("File not found: " . $file);
            return;
        }

        $handle = fopen($file, 'r');
        if ($handle === false) {
            $this->command->error("Could not open file: " . $file);
            return;
        }

        // Set encoding to UTF-8
        stream_filter_append($handle, 'convert.iconv.ISO-8859-1/UTF-8');

        $header = null;
        $data = [];
        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            // Skip rows that do not have the expected number of columns
            if (count($row) < 8) {
                $this->command->warn("Skipping row due to insufficient columns: " . implode(',', $row));
                continue;
            }

            if (!$header) {
                $header = array_slice($row, 0, 8);
                // Validate header
                if ($header[0] !== 'type' || $header[1] !== 'name' || $header[2] !== 'calories' || $header[3] !== 'proteins' || $header[4] !== 'carbohydrates' || $header[5] !== 'fats' || $header[6] !== 'quantity' || $header[7] !== 'description') {
                    $this->command->error("Invalid CSV header.");
                    return;
                }
            } else {
                $rowData = array_combine($header, array_slice($row, 0, 8));
                // Validate row data
                if (!is_numeric($rowData['calories']) || !is_numeric($rowData['proteins']) || !is_numeric($rowData['carbohydrates']) || !is_numeric($rowData['fats'])) {
                    $this->command->warn("Skipping row due to invalid data: " . implode(',', $row));
                    continue;
                }
                $data[] = $rowData;
            }
        }
        fclose($handle);

        foreach ($data as $rowData) {
            DB::table('foods')->insert([
                'type' => $rowData['type'],
                'name' => $rowData['name'],
                'calories' => $rowData['calories'],
                'proteins' => $rowData['proteins'],
                'carbohydrates' => $rowData['carbohydrates'],
                'fats' => $rowData['fats'],
                'quantity' => $rowData['quantity'],
                'description' => $rowData['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
