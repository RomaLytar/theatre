<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FestivalStoreRequest;
use App\Http\Requests\FestivalUpdateRequest;
use App\Models\Festival;
use App\Repositories\FestivalRepository;
use App\Repositories\VideoRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FestivalController extends Controller
{
    /**
     * @var FestivalRepository
     */
    protected $festivalRepository;

    /**
     * @var VideoRepository
     */
    protected $videoRepository;

    public function __construct(
        FestivalRepository $festivalRepository,
        VideoRepository $videoRepository
    ) {
        $this->middleware('permission:festival-list');
        $this->middleware('permission:festival-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:festival-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:festival-delete', ['only' => ['destroy']]);

        $this->festivalRepository = $festivalRepository;
        $this->videoRepository = $videoRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $festivals = Festival::with('translate', 'media')->latest()->paginate();
        return view('admin.festival.index', compact('festivals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.festival.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FestivalStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FestivalStoreRequest $request)
    {
        $data = $request->all();
        $data['videos'] = $this->videoRepository->saveVideos($data['videos']);
        $festival = $this->festivalRepository->createFestival($data);

        if($request->file('poster')) {
          $festival->addMediaFromRequest('poster')->toMediaCollection('posters');
        }

      if($request->file('images')) {
        $festival->addMultipleMediaFromRequest(['images'])
          ->each(function ($fileAdder) {
            $fileAdder->toMediaCollection('album-images');
          });
      }

        Session::flash('message', 'Successfully created festival!');
        return Redirect::to('/admin/festival');
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
        if (!$festival = $this->festivalRepository->getMultiLangModelById($id)) {
          throw new NotFoundHttpException('Festival not found');
        }

        return view('admin.festival.edit',
          compact('festival')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FestivalUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FestivalUpdateRequest $request, $id)
    {
        if (!$festival = $this->festivalRepository->getMultiLangModelById($id)) {
          throw new NotFoundHttpException('Festival not found');
        }
        $data = $request->all();

        if($request->file('poster')) {
            $festival->getMedia('posters')->first()->delete();
            $festival->addMediaFromRequest('poster')->toMediaCollection('posters');
        }

        $festival->videos()->delete();
        $data['videos'] = isset($data['videos']) ? $this->videoRepository->saveVideos($data['videos']) : [];

        if(isset($data['uploadedImages'])) {
          $ids = [];
          foreach($data['uploadedImages'] as $id) {
            $ids[] = $id;
          }
          $images = $festival->getMedia('album-images')->whereIn('id', $ids);
          $festival->clearMediaCollectionExcept('album-images', $images);
        }
        else {
          $festival->clearMediaCollection('album-images');
        }

        if($request->file('images')) {
          $festival->addMultipleMediaFromRequest(['images'])
            ->each(function ($fileAdder) {
              $fileAdder->toMediaCollection('album-images');
            });
        }

        $this->festivalRepository->updateFestival($data, $festival);

        Session::flash('message', 'Successfully updated festival!');
        return Redirect::to('/admin/festival');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->festivalRepository->delete($id);
        Session::flash('message', 'Successfully deleted the festival');
        return Redirect::to('/admin/festival');
    }

    public function checkAndUploadImage($request, $fileName, $collection, $model):void {
      if($file = $request->file($fileName)) {
        if($model->getMedia($collection)->first()) {
          $model->getMedia($collection)->first()->delete();
        }
        $model->addMediaFromRequest($file)->toMediaCollection($collection);
      }
    }
}

//$this->checkAndUploadImage($request, 'poster', 'posters', $festival);
