<?php

namespace App\Imports;
use Auth;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\withHeadingRow;

class EmployeeImport implements ToModel,withHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      
        $file[] =asset('images/hotel.jpg');
      
     
        $user_id = Auth::user()->id;
        return new Product([
            //
            'name'=> $row['name'],
            'description'=> $row['description'],
            'price'=> $row['price'],
            'file'=>json_encode($file),
            'user_id'=>$user_id,
        ]);
    }
}
