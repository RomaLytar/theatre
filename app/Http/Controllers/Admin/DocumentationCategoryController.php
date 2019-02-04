<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Requests\StoreDocumentation;
use App\Models\Documentation;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDocumentationCategory;
use App\Models\DocumentationCategory;
use App\Repositories\DocumentationCategoryRepository;
use Illuminate\Support\Facades\Session;

class DocumentationCategoryController extends Controller
{
    protected $documentationCategoryRepository;

    public function __construct(DocumentationCategoryRepository $documentationCategoryRepository)
    {
        $this->middleware('permission:doc-category-list');
        $this->middleware('permission:doc-category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:doc-category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:doc-category-delete', ['only' => ['destroy']]);

        $this->documentationCategoryRepository = $documentationCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentationCategories = DocumentationCategory::with('translate')->paginate();
        return view('admin.documentation_categories.index', compact('documentationCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.documentation_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentationCategory $request)
    {
        $data = $request->all();
        $this->documentationCategoryRepository->createDocumentationCategories($data);
        Session::flash('message', 'Successfully created documentation category!');
        return redirect()->route('documentation-categories.index');
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
        $documentationCategory = DocumentationCategory::find($id);
        if (empty($documentationCategory)) {
            abort(404);
        }
        return view('admin.documentation_categories.edit', compact('documentationCategory'));
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
        $this->documentationCategoryRepository->editdocumentationCategory($data, $id);
        Session::flash('message', 'Successfully updated nerd!');
        return redirect()->route('documentation-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DocumentationCategory::find($id)->delete();
        return redirect()->route('documentation-categories.index');
    }
}
