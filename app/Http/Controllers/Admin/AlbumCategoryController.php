<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlbumCategory;
use App\Models\AlbumCategory;
use App\Repositories\AlbumCategoryRepository;
use Illuminate\Support\Facades\Session;

class AlbumCategoryController extends Controller
{
    protected $albumCategoryRepository;

    public function __construct(AlbumCategoryRepository $albumCategoryRepository)
    {
        $this->middleware('permission:album-category-list');
        $this->middleware('permission:album-category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:album-category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:album-category-delete', ['only' => ['destroy']]);

        $this->albumCategoryRepository = $albumCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albumCategories = AlbumCategory::paginate();
        return view('admin.album_categories.index', compact('albumCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.album_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlbumCategory $request)
    {
        $data = $request->all();
        $this->albumCategoryRepository->createAlbumCategories($data);
        Session::flash('message', 'Successfully created album category!');
        return redirect()->route('album-categories.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $albumCategory = AlbumCategory::find($id);
        if (empty($albumCategory)) {
            abort(404);
        }
        return view('admin.album_categories.edit', compact('albumCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->albumCategoryRepository->editAlbumCategory($data, $id);
        Session::flash('message', 'Successfully updated nerd!');
        return redirect()->route('album-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AlbumCategory::find($id)->delete();
        return redirect()->route('album-categories.index');
    }
}
