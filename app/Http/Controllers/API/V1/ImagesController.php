<?php


namespace App\Http\Controllers\Api\V1;

use App\Images;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImagesController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        return Images::all();
    }

    public function show($id)
    {
        return Images::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $company = Images::findOrFail($id);
        $company->update($request->all());

        return $company;
    }

    public function store(Request $request)
    {
        $company = Images::create($request->all());
        return $company;
    }

    public function destroy($id)
    {
        $company = Images::findOrFail($id);
        $company->delete();
        return '';
    }
}
