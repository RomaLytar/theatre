<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use App\Models\VacancyTranslation;
use App\Repositories\VacancyRepository;
use App\Http\Requests\StoreVacancy;
use Illuminate\Support\Facades\Session;
use App\Repositories\FileRepository;

class VacancyController extends Controller
{
    protected $fileRepository;

    protected $vacancyRepository;

    public function __construct(VacancyRepository $vacancyRepository, FileRepository $fileRepository)
    {
        $this->middleware('permission:vacancy-list');
        $this->middleware('permission:vacancy-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:vacancy-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:vacancy-delete', ['only' => ['destroy']]);

        $this->vacancyRepository = $vacancyRepository;
        $this->fileRepository = $fileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacancies = Vacancy::with('translate')->latest()->paginate();
        return view('admin.vacancies.index', compact('vacancies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vacancies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVacancy $request)
    {
        $data = $request->all();
        $this->vacancyRepository->createVacancy($data);
        Session::flash('message', 'Successfully created vacancy!');
        return redirect()->route('vacancies.index');
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
        $vacancy = Vacancy::find($id);
        if (empty($vacancy)) {
            abort(404);
        }
        return view('admin.vacancies.edit', compact('vacancy'));
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
        if (!$vacancy = Vacancy::find($id)) {
            throw new NotFoundHttpException('Vacancy plans not found');
        }
        $data = $request->all();
        $this->vacancyRepository->editVacancy($data, $id);

        Session::flash('message', 'Successfully updated vacancy plans!');
        return redirect()->route('vacancies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vacancy::find($id)->delete();
        return redirect()->route('vacancies.index');
    }
}
