<?php

namespace App\Http\Controllers;

use App\Search\FilterQuery;
use Illuminate\Http\Request;
use Revolution\Google\SearchConsole\Facades\SearchConsole;

class FilterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $url = $request->input('url');
        $keyword = $request->input('q');

        $query = new FilterQuery([
            'StartDate' => now()->subMonthWithoutOverflow()->toDateString(),
            'EndDate'   => now()->toDateString(),
        ]);

        $query->filter('query', $keyword);

        $token = [
            'access_token'  => $request->user()->access_token,
            'refresh_token' => $request->user()->refresh_token,
            'expires_in'    => 3600,
            'created'       => $request->user()->updated_at->getTimestamp(),
        ];

        $result = SearchConsole::setAccessToken($token)
                               ->query($url, $query);

        $rows = $result->rows ?? [];

        return view('filter')->with(compact('keyword', 'rows'));
    }
}
