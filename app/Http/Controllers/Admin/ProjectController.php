<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectTranslation;
use App\Repositories\ProjectRepository;
use App\Http\Requests\StoreProject;
use Illuminate\Support\Facades\Session;
use App\Repositories\FileRepository;

class ProjectController extends Controller

{
    protected $fileRepository;

    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository, FileRepository $fileRepository)
    {
        $this->middleware('permission:project-list');
        $this->middleware('permission:project-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:project-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:project-delete', ['only' => ['destroy']]);

        $this->projectRepository = $projectRepository;
        $this->fileRepository = $fileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('translate', 'category', 'category.translate', 'media')->latest()->paginate();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projectCategories = ProjectCategory::all();
        $projectCategories = array_multilanguage_formatter($projectCategories, 'id', 'title');

        return view('admin.projects.create', compact('projectCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProject $request)
    {
        $data = $request->all();

        $project = $this->projectRepository->createProject($data);
        if ($img = $request->file('poster')) {
            $project->addMedia($img)->toMediaCollection('posters');
        }
        Session::flash('message', 'Successfully created project!');
        return redirect()->route('projects.index');
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
        $project = Project::find($id);
        if (empty($project)) {
            abort(404);
        }
        $projectCategories = ProjectCategory::all();
        $projectCategories = array_multilanguage_formatter($projectCategories, 'id', 'title');
        return view('admin.projects.edit', compact('projectCategories', 'project'));
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
        if (!$project = Project::find($id)) {
            throw new NotFoundHttpException('Project not found');
        }
        $data = $request->all();

        if ($request->file('poster')) {
            if ($project->getMedia('posters')->first()) {
                $project->getMedia('posters')->first()->delete();
            }
            $project->addMediaFromRequest('poster')->toMediaCollection('posters');
        }
        $this->projectRepository->editProject($data, $id);

        if (isset($data['uploadedImages'])) {
            $ids = [];
            foreach ($data['uploadedImages'] as $id) {
                $ids[] = $id;
            }

            $this->projectRepository->editProject($data, $id);
        }
        Session::flash('message', 'Successfully updated project!');
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::find($id)->delete();
        return redirect()->route('projects.index');
    }
}
