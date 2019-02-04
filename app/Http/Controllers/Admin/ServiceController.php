<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceTranslation;
use App\Repositories\ServiceRepository;
use App\Http\Requests\StoreService;
use Illuminate\Support\Facades\Session;
use App\Repositories\FileRepository;

class ServiceController extends Controller
{
    protected $fileRepository;

    protected $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository, FileRepository $fileRepository)
    {
        $this->middleware('permission:service-list');
        $this->middleware('permission:service-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:service-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:service-delete', ['only' => ['destroy']]);

        $this->serviceRepository = $serviceRepository;
        $this->fileRepository = $fileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::with('translate')->paginate();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreService $request)
    {
        $data = $request->all();
        $service = $this->serviceRepository->createService($data);

        if ($request->file('images')) {
            $service->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('service-images');
                });
        }

        Session::flash('message', 'Successfully created service!');
        return redirect()->route('services.index');
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
        $service = Service::find($id);
        if (empty($service)) {
            abort(404);
        }

        return view('admin.services.edit', compact('service'));
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

        if (!$service = Service::find($id)) {
            throw new NotFoundHttpException('Service plans not found');
        }
        $data = $request->all();

        $this->serviceRepository->editService($data, $id);

        if (isset($data['uploadedImages'])) {
            $ids = [];
            foreach ($data['uploadedImages'] as $id) {
                $ids[] = $id;
            }
            $images = $service->getMedia('service-images')->whereIn('id', $ids);
            $service->clearMediaCollectionExcept('service-images', $images);
        } else {
            $service->clearMediaCollection('service-images');
        }

        if ($request->file('images')) {
            $service->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('service-images');
                });
        }

        Session::flash('message', 'Successfully updated service plans!');
        return redirect()->route('services.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::find($id)->delete();
        return redirect()->route('services.index');
    }
}
