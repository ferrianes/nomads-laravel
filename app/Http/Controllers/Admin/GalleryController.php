<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use App\Gallery;
use App\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing and search of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->s;
        $limit = $request->limit;

        $items = Gallery::with(['travel_package'])
            ->whereHas('travel_package', function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%");   
            })
            ->paginate($limit ?? 5);

        // append link to pagination (?s=input?page=2)
        $items->appends($request->only('s', 'limit'));

        return view('pages.admin.gallery.index', [
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
        $items = Gallery::onlyTrashed()
                    ->with(['travel_package'])
                    ->get();

        return view('pages.admin.gallery.trash', [
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
        $travel_packages = TravelPackage::all();

        return view('pages.admin.gallery.create', [
            'travel_packages' => $travel_packages
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $data = $request->all();
        $data['images'] = $request->file('images')->store(
            'assets/gallery', 'public'
        );

        Gallery::create($data);
        return redirect()->route('gallery.index')->with('status', 'add-success');
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
        $item = Gallery::findOrFail($id);

        return view('pages.admin.gallery.edit', [
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
    public function update(GalleryRequest $request, $id)
    {
        $data = $request->all();
        $data['images'] = $request->file('images')->store(
            'assets/gallery', 'public'
        );

        $item = Gallery::findOrFail($id);

        Storage::disk('public')->delete($item->images);

        $item->update($data);

        return redirect()->route('gallery.index')->with('status', 'edit-success');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $item = Gallery::onlyTrashed()->findOrFail($id);
        $item->restore();

        return redirect()->route('gallery-trash')->with('status', 'restore-success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Gallery::findOrFail($id);
        $item->delete();

        return redirect()->route('gallery.index')->with('status', 'delete-success');
    }

    /**
     * Force Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kill($id)
    {
        $item = Gallery::onlyTrashed()->findOrFail($id);
        Storage::disk('public')->delete($item->images);
        $item->forceDelete();

        return redirect()->route('gallery-trash')->with('status', 'delete-success');
    }
}
