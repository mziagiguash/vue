<?php

namespace App\Http\Controllers\Admin;

use App\Models\Facility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Facility\StoreRequest;
use App\Http\Requests\Facility\UpdateRequest;

class FacilityController extends Controller
{
    public function create()
    {
        $facilities = Facility::all();

        return view('admin.facilities.index', compact('facilities'));
    }

    public function store(StoreRequest $request)
    {
        $facilities = new Facility($request->all());
        $facilities->save();

        return to_route('admin.facilities');
    }

    public function edit(Facility $facility)
    {
        return view('admin.facilities.edit', compact('facility'));
    }

    public function update(UpdateRequest $request, Facility $facility)
    {
        Facility::find($facility->id)->update($request->all());

        return to_route('admin.facilities');
    }

    public function destroy(Facility $facility)
    {
        Facility::find($facility->id)->delete();

        return to_route('admin.facilities');
    }
}
