<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Food;
use Illuminate\Support\Facades\Storage;

class ImportFoodsFromCSV extends Command
{
    protected $signature = 'import:foods';
    protected $description = 'Import foods from a CSV file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $filePath = storage_path('app/public/foods.csv');
        $file = fopen($filePath, 'r');
        $header = fgetcsv($file);

        while ($row = fgetcsv($file)) {
            if (count($header) !== count($row)) {
                $this->error('Skipping row due to column mismatch: ' . implode(',', $row));
                continue;
            }

            $data = array_combine($header, $row);

            try {
                Food::create([
                    'type' => $data['type'],
                    'name' => $data['name'],
                    'calories' => $data['calories'] ?: 0, // Handle empty values
                    'proteins' => $data['proteins'] ?: 0,
                    'carbohydrates' => $data['carbohydrates'] ?: 0,
                    'fats' => $data['fats'] ?: 0,
                    'quantity' => $data['quantity'] ?: 0,
                    'description' => $data['description'] ?: '',
                ]);
            } catch (\Exception $e) {
                $this->error('Error inserting row: ' . implode(',', $row));
                $this->error($e->getMessage());
            }
        }

        fclose($file);
        $this->info('Foods imported successfully!');
    }
}
