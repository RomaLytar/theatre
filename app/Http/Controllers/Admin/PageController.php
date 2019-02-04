<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use App\Repositories\AttributeValueRepository;
use App\Repositories\FileRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Repositories\PageRepository;
use App\Http\Requests\StorePage;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{

    protected $pageRepository;
    protected $attributeValueRepository;
    protected $fileRepository;

    public function __construct(PageRepository $pageRepository, AttributeValueRepository $attributeValueRepository, FileRepository $fileRepository)
    {
        $this->middleware('permission:page-list');
        $this->middleware('permission:page-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:page-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:page-delete', ['only' => ['destroy']]);

        $this->pageRepository = $pageRepository;
        $this->attributeValueRepository = $attributeValueRepository;
        $this->fileRepository = $fileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::with('translate', 'media')->latest()->paginate();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributes = Attribute::pluck('name', 'id');
        return view('admin.pages.create', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePage|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePage $request)
    {
        $data = $request->all();
        $page = $this->pageRepository->createPages($data);

        $blockCounter = $data['blockCounter'];
        $counter = $data['blockCounter'];
        $data['page_id'] = $page->id;
        if ($blockCounter > 0) {
            for ($i = 0; $i < $counter; $i++) {
                if (!isset($data['title_en_' . $i])) {
                    continue;
                }
                if ($data['attribute_name_' . $i] === 'file') {
                    $data['descriptions_' . $i] = $this->checkAndUploadFile($request, 'descriptions_' . $i, '/uploads/pages');
                }
                $block = $this->attributeValueRepository->createAttributeValues($data, $i);
                $this->checkAndUploadImage($request, 'poster_' . $i, 'posters', $block);
                if ($data['attribute_name_' . $i] === 'gallery') {
                    $this->checkAndUploadGalleryImages($request, 'gallery_' . $i, 'album-images', $block);
                }
            }
        }

        if ($request->file('poster')) {
            $page->addMediaFromRequest('poster')->toMediaCollection('posters');
        }

        Session::flash('message', 'Successfully created page!');
        return redirect()->route('pages.index');
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
        if (!$page = Page::with('blocks', 'media', 'blocks.media')->find($id)) {
            abort(404);
        }

        $attributesObject = Attribute::pluck('name', 'id');
        $attributes = $attributesObject->toArray();

        return view('admin.pages.edit', compact('page', 'attributes', 'attributesObject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorePage|Request $request
     * @param  int $id
     * @return Response
     */
    public function update(StorePage $request, $id)
    {
        if (!$page = Page::find($id)) {
            throw new NotFoundHttpException('Page not found');
        }
        $data = $request->all();
        $this->checkAndUploadImage($request, 'poster', 'posters', $page);

        $blockIds = $page->blocks()->pluck('id')->toArray();

        $blockCounter = $data['blockCounter'];
        $counter = $data['blockCounter'];
        $data['page_id'] = $page->id;

        foreach ($blockIds as $blockId) {
            if (isset($data['attribute_name_old_' . $blockId]) && $data['attribute_name_old_' . $blockId] === 'file') {
                $data['descriptions_old_' . $blockId] = $this->checkAndUploadFile($request, 'descriptions_old_' . $blockId, '/uploads/pages');
            }
            $block = $this->attributeValueRepository->editAttributeValue($data, $blockId);
            $this->checkAndUploadImage($request, 'poster_old_' . $blockId, 'posters', $block);
            if (isset($data['attribute_name_old_' . $blockId]) && $data['attribute_name_old_' . $blockId] === 'gallery') {
                $this->checkAndUpdateGalleryImages($request, 'uploadedImages_old_' . $blockId, 'album-images', $block, $blockId);
                $this->checkAndUploadGalleryImages($request, 'gallery_' . $blockId, 'album-images', $block);
            }
        }

        if ($blockCounter > 0) {
            for ($i = 0; $i < $counter; $i++) {
                if (!isset($data['title_en_' . $i])) {
                    continue;
                }
                if ($data['attribute_name_' . $i] === 'file') {
                    $data['descriptions_' . $i] = $this->checkAndUploadFile($request, 'descriptions_' . $i, '/uploads/pages');
                }
                $block = $this->attributeValueRepository->createAttributeValues($data, $i);
                $this->checkAndUploadImage($request, 'poster_' . $i, 'posters', $block);
                if ($data['attribute_name_' . $i] === 'gallery') {
                    $this->checkAndUploadGalleryImages($request, 'gallery_' . $i, 'album-images', $block);
                }
            }
        }

        $this->pageRepository->editPage($data, $page);
        Session::flash('message', 'Successfully edited page!');
        return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();
        return redirect()->route('pages.index');
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

    public function checkAndUploadGalleryImages($request, $galleryName, $collection, $model): void
    {
        if ($request->file([$galleryName])) {
            $model->addMultipleMediaFromRequest([$galleryName])
                ->each(function ($fileAdder) use ($collection) {
                    $fileAdder->toMediaCollection($collection);
                });
        }
    }

    public function checkAndUpdateGalleryImages($request, $galleryName, $collection, $model, $blockId): void
    {
        if ($request->input($galleryName) !== null) {
            $ids = [];
            foreach ($request->input($galleryName) as $i) {
                $ids[] = $i;
            }
            $images = $model->getMedia($collection)->whereIn('id', $ids);
            $model->clearMediaCollectionExcept($collection, $images);
        } else {
            $model->clearMediaCollection($collection);
        }
    }

    public function checkAndUploadFile($request, $fileName, $path)
    {
        if ($fileName = $request->file($fileName)) {
            return $this->fileRepository->saveFile($fileName, $path)->url;
        }
        return null;
    }
}
