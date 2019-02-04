<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ebook;
use Spatie\MediaLibrary\Models\Media;
use App\Models\EbookTranslation;
use App\Repositories\EbookRepository;
use App\Http\Requests\StoreEbooks;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Repositories\FileRepository;

class EbookController extends Controller
{
    /**
     * @var FileRepository
     */
    protected $fileRepository;

    protected $ebooksRepository;

    public function __construct(EbookRepository $ebookRepository, FileRepository $fileRepository)
    {
        $this->middleware('permission:e-book-list');
        $this->middleware('permission:e-book-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:e-book-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:e-book-delete', ['only' => ['destroy']]);

        $this->ebookRepository = $ebookRepository;
        $this->fileRepository = $fileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ebooks = Ebook::with('translate', 'media')->latest()->paginate();
        return view('admin.ebooks.index', compact('ebooks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ebooks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEbooks $request)
    {
        $data = $request->all();

        $this->checkAndUploadFile($request, 'file_en', '/uploads/ebook_file');
        $this->checkAndUploadFile($request, 'file_ru', '/uploads/ebook_file');
        $this->checkAndUploadFile($request, 'file_ua', '/uploads/ebook_file');

        $ebooks = $this->ebookRepository->createEbooks($data);

        $this->checkAndUploadImage($request, 'poster', 'posters', $ebooks);

        Session::flash('message', 'Successfully created ebook!');
        return redirect()->route('ebooks.index');
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
        $ebook = Ebook::find($id);
        if (empty($ebook)) {
            abort(404);
        }
        return view('admin.ebooks.edit', compact('ebook'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEbooks $request, $id)
    {
        if (!$ebooks = Ebook::find($id)) {
            throw new NotFoundHttpException('Ebooks not found');
        }
        $data = $request->all();
//      dd($data);
        $this->checkAndUploadImage($request, 'poster', 'posters', $ebooks);

        $data['file_en'] = $this->checkAndUploadFile($request, 'file_en', '/uploads/ebook_file');
        $data['file_ru'] = $this->checkAndUploadFile($request, 'file_ru', '/uploads/ebook_file');
        $data['file_ua'] = $this->checkAndUploadFile($request, 'file_ua', '/uploads/ebook_file');

//      dump($data['file_en']);
//      dump($data['file_ru']);
//      dump($data['file_ua']);

        $this->ebookRepository->editEbooks($data, $id);
        Session::flash('message', 'Successfully updated ebook!');
        return redirect()->route('ebooks.index');
    }


    public function checkAndUploadFile($request, $fileName, $path)
    {
        if ($fileName = $request->file($fileName)) {
            return $this->fileRepository->saveFile($fileName, $path)->url;
        }
        return null;
    }

    public function checkAndUploadImage($request, $fileName, $collection, $model): void
    {
        if ($file = $request->file($fileName)) {
            if ($model->getMedia($collection)->first()) {
                $model->getMedia($collection)->first()->delete();
            }
            $model->addMediaFromRequest($fileName)->toMediaCollection($collection);
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
        Ebook::find($id)->delete();
        return redirect()->route('ebooks.index');
    }
}
