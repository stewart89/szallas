<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = public_path('testCompanyDB.csv');
        if(!file_exists($file)){
            throw new Exception('File not found');
        }

        $fp = fopen($file, 'r');

        $header = fgetcsv($fp, 0, ';');
        $header = array_map(function ($row) {
            return str_replace('company_', '', Str::snake($row));
        }, $header);

        $data = [];
        while (($row = fgetcsv($fp, 0, ';')) !== false) {

            $row[13] = str_replace(['false', 'true'], [0, 1], $row[13]);
            $row[15] = Hash::make($row[15]);
            $data[] = array_combine($header, $row);
        }

        fclose($fp);
        DB::table('companies')->insert($data);
    }
}
