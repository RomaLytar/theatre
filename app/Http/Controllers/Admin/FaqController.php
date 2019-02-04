<?php

namespace App\Http\Controllers\Admin;

use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\FaqTranslation;
use App\Repositories\FaqRepository;
use App\Http\Requests\StoreFaq;
use Illuminate\Support\Facades\Session;

class FaqController extends Controller
{

    protected $faqRepository;

    public function __construct(FaqRepository $faqRepository)
    {
        $this->middleware('permission:faq-list');
        $this->middleware('permission:faq-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:faq-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:faq-delete', ['only' => ['destroy']]);

        $this->faqRepository = $faqRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::with('translate', 'category', 'category.translate')->latest()->paginate();
        return view('admin.faqs.index', compact('faqs'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faqCategories = FaqCategory::all();
        $faqCategories = array_multilanguage_formatter($faqCategories, 'id', 'title');

        return view('admin.faqs.create', compact('faqCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaq $request)
    {
        $data = $request->all();
        $this->faqRepository->createFaq($data);
        Session::flash('message', 'Successfully created faq!');
        return redirect()->route('faqs.index');
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
        if (!$faq = Faq::find($id)) {
            abort(404);
        }
        $faqCategories = FaqCategory::all();
        $faqCategories = array_multilanguage_formatter($faqCategories, 'id', 'title');

        return view('admin.faqs.edit', compact('faqCategories', 'faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFaq $request, $id)
    {
        $data = $request->all();
        $this->faqRepository->editFaq($data, $id);
        Session::flash('message', 'Successfully updated nerd!');
        return redirect()->route('faqs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Faq::find($id)->delete();
        return redirect()->route('faqs.index');
    }
}
