<?php

namespace App\Http\Controllers;

use App\Check;

class ArchiveController extends Controller
{
    public function all()
    {
        $checks = Check::all();
        return view('archive.all', [
            'checks' => $checks,
        ]);
    }

    public function one($check_id)
    {
        $proxy_checks = Check::find($check_id)->proxyCheck()->get();
        return view('archive.one', [
            'proxy_checks' => $proxy_checks,
        ]);
    }
}
