<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartnerCategory;
use App\Models\PartnerCategory;
use App\Repositories\PartnerCategoryRepository;
use Illuminate\Support\Facades\Session;

class PartnerCategoryController extends Controller
{
    protected $partnerCategoryRepository;

    public function __construct(PartnerCategoryRepository $partnerCategoryRepository)
    {
        $this->middleware('permission:partner-category-list');
        $this->middleware('permission:partner-category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:partner-category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:partner-category-delete', ['only' => ['destroy']]);

        $this->partnerCategoryRepository = $partnerCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partnerCategories = PartnerCategory::paginate();
        return view('admin.partner_categories.index', compact('partnerCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partner_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartnerCategory $request)
    {
        $data = $request->all();
        $this->partnerCategoryRepository->createPartnerCategories($data);
        Session::flash('message', 'Successfully created partner category!');
        return redirect()->route('partner-categories.index');
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
        $partnerCategory = PartnerCategory::find($id);
        if (empty($partnerCategory)) {
            abort(404);
        }
        return view('admin.partner_categories.edit', compact('partnerCategory'));
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
        $this->partnerCategoryRepository->editPartnerCategory($data, $id);
        Session::flash('message', 'Successfully updated nerd!');
        return redirect()->route('partner-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PartnerCategory::find($id)->delete();
        return redirect()->route('partner-categories.index');
    }
}
