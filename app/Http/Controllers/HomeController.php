<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param  Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke(Request $request)
    {
        $sites = $request->user()->searchconsole()->listSites();
        $sites = $sites->siteEntry ?? [];

        return view('home')->with(compact('sites'));
    }
}
