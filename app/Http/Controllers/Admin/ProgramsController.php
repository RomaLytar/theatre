<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Program;
use Spatie\MediaLibrary\Models\Media;
use App\Models\ProgramTranslation;
use App\Repositories\ProgramRepository;
use App\Http\Requests\StorePrograms;
use Illuminate\Support\Facades\Session;
use App\Repositories\FileRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProgramsController extends Controller
{
    protected $fileRepository;

    protected $programRepository;

    public function __construct(ProgramRepository $programRepository, FileRepository $fileRepository)
    {
        $this->middleware('permission:program-list');
        $this->middleware('permission:program-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:program-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:program-delete', ['only' => ['destroy']]);

        $this->programRepository = $programRepository;
        $this->fileRepository = $fileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::with('translate', 'media')->paginate();
        return view('admin.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.programs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrograms $request)
    {
        $data = $request->all();
        $programs = $this->programRepository->createProgram($data);
        if ($img = $request->file('poster')) {
            $programs->addMedia($img)->toMediaCollection('posters');
        }

        Session::flash('message', 'Successfully created program!');
        return redirect()->route('programs.index');
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
        $program = Program::find($id);
        if (empty($program)) {
            abort(404);
        }
        return view('admin.programs.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePrograms $request, $id)
    {
        if (!$programs = Program::find($id)) {
            throw new NotFoundHttpException('Program not found');
        }
        $data = $request->all();

        if ($request->file('poster')) {
            if ($programs->getMedia('posters')->first()) {
                $programs->getMedia('posters')->first()->delete();
            }
            $programs->addMediaFromRequest('poster')->toMediaCollection('posters');
        }
        $this->programRepository->editProgram($data, $id);
        Session::flash('message', 'Successfully updated program!');
        return redirect()->route('programs.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Program::find($id)->delete();
        return redirect()->route('programs.index');
    }
}
