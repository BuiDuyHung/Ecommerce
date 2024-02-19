<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Category([
            'title' => $row[0],
            'slug' => $row[1],
            'desc' => $row[2],
            'status' => $row[3],
            'keywords' => $row[4],
        ]);
    }
}
