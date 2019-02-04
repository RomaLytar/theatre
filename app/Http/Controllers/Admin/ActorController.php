<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreActor;
use App\Models\Actor;
use App\Models\ActorGroup;
use App\Models\ActorImage;
use App\Models\ActorTranslation;
use App\Models\ActorVideo;
use App\Repositories\ActorRepository;
use App\Repositories\ImageRepository;
use App\Repositories\VideoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ActorController extends Controller
{
    const PATH_AVATAR = '/uploads/actors/avatar';
    const PATH_GALLERY = '/uploads/actors/gallery';

    protected $actorRepository;
    protected $imageRepository;

    public function __construct(ActorRepository $actorRepository, ImageRepository $imageRepository)
    {
        $this->middleware('permission:actor-list');
        $this->middleware('permission:actor-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:actor-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:actor-delete', ['only' => ['destroy']]);

        $this->imageRepository = $imageRepository;
        $this->actorRepository = $actorRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actors = Actor::with('translate', 'group', 'group.translate','media')->latest()->paginate();
        return view('admin.actors.index', compact('actors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $actorGroups = ActorGroup::with('translate')->get();
        $actorGroups = array_multilanguage_formatter($actorGroups, 'id', 'title');

        return view('admin.actors.create', compact('actorGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreActor|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActor $request)
    {
        $data = $request->all();
        $data['images'] = $this->imageRepository->saveImages($request->file('images'), '/uploads/actors');

        $actor = $this->actorRepository->createActors($data);
        $this->checkAndUploadImage($request, 'poster', 'posters', $actor);
        Session::flash('message', 'Successfully created actor!');
        return Redirect::to('/admin/actor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$actor = Actor::find($id)) {
            abort(404);
        }
        $actorGroups = ActorGroup::all();
        $actorGroups = array_multilanguage_formatter($actorGroups, 'id', 'title');
        return view('admin.actors.edit', compact('actorGroups', 'actor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreActor|Request $request
     * @param  int $id
     * @return Response
     */
    public function update(StoreActor $request, $id)
    {
        if (!$actor = Actor::find($id)) {
            throw new NotFoundHttpException('Actor not found');
        }
        $data = $request->all();
        $this->checkAndUploadImage($request, 'poster', 'posters', $actor);

        $uploadedImages = $request->input('uploadedImages')?: [];
        $this->imageRepository->deleteNotIn($actor, $uploadedImages);
        $data['images'] = $this->imageRepository->saveImages($request->file('images'), '/uploads/actors');

        $this->actorRepository->editActor($data, $actor);
        Session::flash('message', 'Successfully edited actor!');
        return Redirect::to('/admin/actor');
    }
    public function checkAndUploadImage($request, $fileName, $collection, $model):void {
      if($file = $request->file($fileName)) {
        if($model->getMedia($collection)->first()) {
          $model->getMedia($collection)->first()->delete();
        }
        $model->addMedia($file)->toMediaCollection($collection);
      }
    }

  /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actor = Actor::find($id);
        $actor->delete();
        return Redirect::to('/admin/actor');
    }
}
