<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProject;
use App\Models\Project;
use App\Http\Requests\StoreProjectCategory;
use App\Models\ProjectCategory;
use App\Repositories\ProjectCategoryRepository;
use Illuminate\Support\Facades\Session;

class ProjectCategoryController extends Controller
{
    protected $projectCategoryRepository;

    public function __construct(ProjectCategoryRepository $projectCategoryRepository)
    {
        $this->middleware('permission:project-category-list');
        $this->middleware('permission:project-category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:project-category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:project-category-delete', ['only' => ['destroy']]);

        $this->projectCategoryRepository = $projectCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectCategories = ProjectCategory::paginate();
        return view('admin.project_categories.index', compact('projectCategories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.project_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectCategory $request)
    {
        $data = $request->all();
        $this->projectCategoryRepository->createProjectCategories($data);
        Session::flash('message', 'Successfully created project category!');
        return redirect()->route('project-categories.index');
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
        $projectCategory = ProjectCategory::find($id);
        if (empty($projectCategory)) {
            abort(404);
        }
        return view('admin.project_categories.edit', compact('projectCategory'));
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
        $this->projectCategoryRepository->editprojectCategory($data, $id);
        Session::flash('message', 'Successfully updated!');
        return redirect()->route('project-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProjectCategory::find($id)->delete();
        return redirect()->route('project-categories.index');
    }
}
