<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Documentation;
//use App\Models\DocumentationCategory;
use App\Models\DocumentationTranslation;
use App\Models\DocumentationCategory;
use App\Repositories\DocumentationRepository;
use App\Http\Requests\StoreDocumentation;
use Illuminate\Support\Facades\Session;
use App\Repositories\FileRepository;

class DocumentationController extends Controller
{
    /**
     * @var FileRepository
     */
    protected $fileRepository;

    protected $documentationRepository;

    public function __construct(DocumentationRepository $documentationRepository, FileRepository $fileRepository)
    {
        $this->middleware('permission:doc-list');
        $this->middleware('permission:doc-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:doc-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:doc-delete', ['only' => ['destroy']]);

        $this->documentationRepository = $documentationRepository;
        $this->fileRepository = $fileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentations = Documentation::with('translate', 'category')->latest()->paginate();
        return view('admin.documentations.index', compact('documentations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $documentationCategories = DocumentationCategory::all();
        $documentationCategories = array_multilanguage_formatter($documentationCategories, 'id', 'title');

        return view('admin.documentations.create', compact('documentationCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentation $request)
    {
        $data = $request->all();

        $data['file'] = $this->checkAndUploadFile($request, 'file', '/uploads/doc_file');

        $this->documentationRepository->createDocumentation($data);
        Session::flash('message', 'Successfully created documentation!');
        return redirect()->route('documentations.index');
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
        $documentation = Documentation::find($id);
        if (empty($documentation)) {
            abort(404);
        }
        $documentationCategories = DocumentationCategory::all();
        $documentationCategories = array_multilanguage_formatter($documentationCategories, 'id', 'title');
        return view('admin.documentations.edit', compact('documentationCategories', 'documentation'));
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

        if (!$documentations = Documentation::find($id)) {
            throw new NotFoundHttpException('Documentation not found');
        }
        $data = $request->all();
        $data['file'] = $this->checkAndUploadFile($request, 'file', '/uploads/doc_file');

        $this->documentationRepository->editDocumentation($data, $id);
        Session::flash('message', 'Successfully updated documentation!');
        return redirect()->route('documentations.index');
    }

    public function checkAndUploadImage($request, $fileName, $collection, $model): void
    {
        if ($file = $request->file($fileName)) {
            if ($model->getMedia($collection)->first()) {
                $model->getMedia($collection)->first()->delete();
            }
            $model->addMediaFromUrl($file)->toMediaCollection($collection);
        }
    }

    public function checkAndUploadFile($request, $fileName, $path)
    {
        if ($fileName = $request->file($fileName)) {
            return $this->fileRepository->saveFile($fileName, $path)->url;
        }
        return null;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Documentation::find($id)->delete();
        return redirect()->route('documentations.index');
    }
}
