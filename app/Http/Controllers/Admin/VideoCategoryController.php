<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVideoCategory;
use App\Models\VideoCategory;
use App\Repositories\VideoCategoryRepository;
use Illuminate\Support\Facades\Session;

class VideoCategoryController extends Controller
{
    protected $videoCategoryRepository;

    public function __construct(VideoCategoryRepository $videoCategoryRepository)
    {
        $this->middleware('permission:video-category-list');
        $this->middleware('permission:video-category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:video-category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:video-category-delete', ['only' => ['destroy']]);

        $this->videoCategoryRepository = $videoCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videoCategories = VideoCategory::paginate();
        return view('admin.video_categories.index', compact('videoCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.video_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideoCategory $request)
    {
        $data = $request->all();
        $this->videoCategoryRepository->createVideoCategories($data);
        Session::flash('message', 'Successfully created video category!');
        return redirect()->route('video-categories.index');
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
        $videoCategory = VideoCategory::find($id);
        if (empty($videoCategory)) {
            abort(404);
        }
//    dd($videoCategory->translate->title);
        return view('admin.video_categories.edit', compact('videoCategory'));
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
        $this->videoCategoryRepository->editVideoCategory($data, $id);
        Session::flash('message', 'Successfully updated nerd!');
        return redirect()->route('video-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        VideoCategory::find($id)->delete();
        return redirect()->route('video-categories.index');
    }
}
