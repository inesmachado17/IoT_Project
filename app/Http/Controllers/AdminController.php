<?php

namespace App\Http\Controllers;

use App\Models\FireAlarm;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function __construct()
    {
        $fireAlarm = (new FireAlarm())->latest()->first();
        View::share('fireAlarm', $fireAlarm);
    }
}
