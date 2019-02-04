<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFaqCategory;
use App\Models\FaqCategory;
use App\Repositories\FaqCategoryRepository;
use Illuminate\Support\Facades\Session;


class FaqCategoryController extends Controller
{
    protected $faqCategoryRepository;

    public function __construct(FaqCategoryRepository $faqCategoryRepository)
    {
        $this->middleware('permission:faq-category-list');
        $this->middleware('permission:faq-category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:faq-category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:faq-category-delete', ['only' => ['destroy']]);

        $this->faqCategoryRepository = $faqCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqCategories = FaqCategory::with('translate')->paginate();
        return view('admin.faq_categories.index', compact('faqCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaqCategory $request)
    {
        $data = $request->all();
        $this->faqCategoryRepository->createFaqCategories($data);
        Session::flash('message', 'Successfully created faq category!');
        return redirect()->route('faqs-categories.index');
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
        $faqCategory = FaqCategory::find($id);
        if (empty($faqCategory)) {
            abort(404);
        }
        return view('admin.faq_categories.edit', compact('faqCategory'));
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
        $this->faqCategoryRepository->editFaqCategory($data, $id);
        Session::flash('message', 'Successfully updated nerd!');
        return redirect()->route('faqs-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FaqCategory::find($id)->delete();
        return redirect()->route('faqs-categories.index');
    }
}
