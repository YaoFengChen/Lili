<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ConvertController extends Controller
{
    public function convert(Request $request)
    {
        if (!$request->hasFile('files')) {
            echo 567;
            exit();
        }

        foreach ($request->file('files') as $file) {
            Storage::disk('local')->put(Carbon::now()->format('Ymd'), $file);
        }

        echo 123;
        exit();
    }
}
