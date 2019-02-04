<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleCategory;
use App\Models\ArticleCategory;
use App\Repositories\ArticleCategoryRepository;
use Illuminate\Support\Facades\Session;

class ArticleCategoryController extends Controller
{
    protected $articleCategoryRepository;

    public function __construct(ArticleCategoryRepository $articleCategoryRepository)
    {
        $this->middleware('permission:article-category-list');
        $this->middleware('permission:article-category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:article-category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:article-category-delete', ['only' => ['destroy']]);

        $this->articleCategoryRepository = $articleCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articleCategories = ArticleCategory::paginate();
        return view('admin.article_categories.index', compact('articleCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleCategory $request)
    {
        $data = $request->all();
        $this->articleCategoryRepository->createArticleCategories($data);
        Session::flash('message', 'Successfully created article category!');
        return redirect()->route('article-categories.index');
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
        $articleCategory = ArticleCategory::find($id);
        if (empty($articleCategory)) {
            abort(404);
        }
        return view('admin.article_categories.edit', compact('articleCategory'));
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
        $this->articleCategoryRepository->editArticleCategory($data, $id);
        Session::flash('message', 'Successfully updated nerd!');
        return redirect()->route('article-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ArticleCategory::find($id)->delete();
        return redirect()->route('article-categories.index');
    }
}
