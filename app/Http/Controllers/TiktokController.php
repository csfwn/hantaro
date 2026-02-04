<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laraditz\TikTok\Facades\TikTok;

class TiktokController extends Controller
{
    public function callback(Request $request)
    {
        Log::info('Tiktok callback endpoint hit', $request->all());

        return true;
    }

    public function webhook(Request $request)
    {
        Log::info('Tiktok wehbook endpoint hit', $request->all());

        return true;
    }
}
