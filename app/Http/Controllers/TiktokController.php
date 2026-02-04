<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TiktokController extends Controller
{
    public function callback(Request $request)
    {
        Log::info('Tiktok callback endpoint hit', $request->all());
        
        return true;
    }
}
