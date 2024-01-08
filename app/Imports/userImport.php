<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;
use App\Models\profile; // Make sure to use the correct namespace for the Profile model

class UserImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'usernum' => $row['id'],
            'username' => $row['fullname'],
            'password' => $row['password'],
            'phone' => $row['phone'],
            'usertype' => $row['usertype'],
            'gender' => $row['gender'],
            'address' => $row['address'],
            'school_id' => 1,
            'status' => 1,
            'age' => $row['age'],
            'birthdate' => $row['birthday'],
        ]);
    }
}
