<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TravelPackageRequest;
use App\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TravelPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->s;
        $limit = $request->limit;

        $items = TravelPackage::where('title', 'like', "%{$search}%")
            ->orWhere('location', 'like', "%{$search}%")
            ->orWhere('about', 'like', "%{$search}%")
            ->orWhere('featured_event', 'like', "%{$search}%")
            ->orWhere('language', 'like', "%{$search}%")
            ->orWhere('foods', 'like', "%{$search}%")
            ->orWhere('departure_date', 'like', "%{$search}%")
            ->orWhere('duration', 'like', "%{$search}%")
            ->orWhere('type', 'like', "%{$search}%")
            ->orWhere('price', 'like', "%{$search}%")
            ->paginate($limit ?? 5);

        // append link to pagination (?s=input?page=2)
        $items->appends($request->only('s', 'limit'));

        return view('pages.admin.travel-package.index', [
            'items' => $items,
            'search' => $search,
            'limit' => $limit
        ]);
    }

    /**
     * Display a soft deletes listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $items = TravelPackage::onlyTrashed()->get();

        return view('pages.admin.travel-package.trash', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.travel-package.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TravelPackageRequest $request)
    {
        $data = $request->all();
        $data['departure_date'] = \Carbon\Carbon::parse($data['departure_date'])->toDate();
        $data['slug'] = Str::slug($request->title);

        TravelPackage::create($data);
        return redirect()->route('travel-package.index')->with('status', 'add-success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = TravelPackage::findOrFail($id);

        return view('pages.admin.travel-package.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TravelPackageRequest $request, $id)
    {
        $data = $request->all();
        $data['departure_date'] = \Carbon\Carbon::parse($data['departure_date'])->toDate();
        $data['slug'] = Str::slug($request->title);

        $item = TravelPackage::findOrFail($id);

        $item->update($data);

        return redirect()->route('travel-package.index')->with('status', 'edit-success');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $item = TravelPackage::onlyTrashed()->findOrFail($id);
        $item->restore();

        return redirect()->route('travel-package-trash')->with('status', 'restore-success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = TravelPackage::findOrFail($id);
        $item->delete();

        return redirect()->route('travel-package.index')->with('status', 'delete-success');
    }

    /**
     * Force Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kill($id)
    {
        $item = TravelPackage::onlyTrashed()->findOrFail($id);

        $item->forceDelete();

        return redirect()->route('travel-package-trash')->with('status', 'delete-success');
    }
}
