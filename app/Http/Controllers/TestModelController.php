<?php

namespace App\Http\Controllers;

use App\Models\TestModel;
use Illuminate\Http\Request;

class TestModelController extends Controller
{
    public function test($id)
    {
        TestModel::create([
            'test_data' => $id
        ]);
        return "Data Created";
    }
}
