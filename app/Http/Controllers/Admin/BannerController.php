<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Repositories\BannerRepository;
use App\Http\Requests\StoreBanners;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $fileRepository;

    protected $bannersRepository;

    public function __construct(BannerRepository $bannersRepository)
    {
        $this->middleware('permission:banner-list');
        $this->middleware('permission:banner-edit', ['only' => ['edit', 'update']]);

        $this->bannersRepository = $bannersRepository;
    }

    public function index()
    {
        $banners = Banner::with('translate', 'media')->latest()->paginate();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBanners $request)
    {
        $data = $request->all();
        $banners = $this->bannersRepository->createBanners($data);
        $this->checkAndUploadImage($request, 'poster', 'posters', $banners);
        Session::flash('message', 'Successfully created banner!');
        return redirect()->route('banners.index');
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
        $banner = Banner::find($id);
        if(empty($banner)){
            abort(404);
        }
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBanners $request, $id)
    {
        if (!$banners = Banner::find($id)) {
            throw new NotFoundHttpException('Banner not found');
        }
        $data = $request->all();
        $this->checkAndUploadImage($request, 'poster', 'posters', $banners);
        $this->bannersRepository->editBanners($data, $id);
        Session::flash('message', 'Successfully updated banner!');
        return redirect()->route('banners.index');
    }

    public function checkAndUploadImage($request, $fileName, $collection, $model):void {
        if($file = $request->file($fileName)) {
            if($model->getMedia($collection)->first()) {
                $model->getMedia($collection)->first()->delete();
            }
            $model->addMediaFromRequest($fileName)->toMediaCollection($collection);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Banner::find($id)->delete();
        return redirect()->route('banners.index');
    }
}
