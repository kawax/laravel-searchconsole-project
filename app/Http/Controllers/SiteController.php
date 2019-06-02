<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Search\SampleQuery;

class SiteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $url = $request->input('url');

        $result = $request->user()
                          ->searchconsole()
                          ->query($url, new SampleQuery());

        $rows = $result->rows ?? [];

        return view('site')->with(compact('url', 'rows'));
    }
}
