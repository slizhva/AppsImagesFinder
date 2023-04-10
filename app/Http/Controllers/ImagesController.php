<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Unsplash;

class ImagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index():Renderable
    {
        return view('pages.images');
    }

    public function find(Request $request):Renderable|RedirectResponse
    {
        if (!empty($request->get('search'))) {
            $searches = preg_split("/\r\n|\n|\r/", $request->get('search'));
            Session::put('searches', $searches);
            Session::put('search_number', 0);
        } else {
            $searches = Session::get('searches');
        }

        if (empty($searches)) {
            return redirect()->route('images');
        }

        $searchNumber = Session::get('search_number');

        if (!empty($request->get('selected_image_url'))) {
            $explodedSearch = explode('|', $searches[$searchNumber - 1]);
            Session::push(
                'result_searches',
                $explodedSearch[0] . '|' . $request->get('selected_image_url')
            );
        }

        $searchesCount = count($searches);
        if ($searchesCount === $searchNumber) {
            Session::remove('search_number');
            Session::remove('searches');
            $results = Session::get('result_searches');
            Session::remove('result_searches');

            return view('pages.select_image_result', [
                'result' => implode("\n", $results)
            ]);
        }

        $explodedSearch = explode('|', $searches[$searchNumber]);
        if (count($explodedSearch) === 2) {
            [$name, $search] = $explodedSearch;
        } else {
            $name = $search = $explodedSearch[0];
        }

        $page = 1;
        $per_page = 30; // max 30
        $orientation = null;
        Unsplash\HttpClient::init([
            'applicationId'	=> env('UNSPLASH_ACCESS_KEY'),
            'utmSource' => 'AppsImagesFinder'
        ]);
        $unsplashResult = Unsplash\Search::photos($search, $page, $per_page, $orientation);
        $images = [];
        foreach($unsplashResult->getResults() as $result) {
            $images[] = [
                'src' => $result['urls']['full'],
                'thumb' => $result['urls']['thumb']
            ];
        }

        Session::put('search_number', ++$searchNumber);

        return view('pages.select_image', [
            'searchNumber' => $searchNumber,
            'searchCount' => $searchesCount,
            'name' => $name,
            'images' => $images,
        ]);
    }
}
