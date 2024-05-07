<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = [];

        foreach (Country::all() as $c) {
            array_push($countries, $c);
        }

        return view("countries.index", ["countries" => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("countries.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCountryRequest $request)
    {
        // $data = $request->validated();
        $data = $request->all();

        // $country->update($input);

        $country = new Country;
        $country->name = $data["name"];
        $country->code = $data["code"];
        $country->currency =$data["currency"];
        $country->area = $data["area"];
        $country->language = $data["language"];
        $country->save();

        return redirect()->route("countries.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        return view("countries.show", ["c"=>$country]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        return view("countries.edit", ["c"=>$country]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $input = $request->all();
        $country->update($input);
        return redirect()->route('countries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        try {
            $country->delete();
            return redirect()->route('countries.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cannot delete this country because it is being referenced by trips.');
        }
    }
    
    
}
