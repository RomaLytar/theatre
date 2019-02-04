<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePerformanceType;
use App\Models\PerformanceType;
use App\Repositories\PerformanceTypeRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PerformanceTypeController extends Controller
{

    protected $performanceTypeRepository;

    public function __construct(PerformanceTypeRepository $performanceTypeRepository)
    {
        $this->middleware('permission:performance-type-list');
        $this->middleware('permission:performance-type-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:performance-type-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:performance-type-delete', ['only' => ['destroy']]);

        $this->performanceTypeRepository = $performanceTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $performanceTypes = PerformanceType::paginate();
        return view('admin.performance_types.index', compact('performanceTypes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.performance_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePerformanceType $request)
    {
        $data = $request->all();
        $this->performanceTypeRepository->createPerformanceTypes($data);
        Session::flash('message', 'Successfully created nerd!');
        return redirect()->route('performance-types.index');
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
        $performanceType = PerformanceType::find($id);
        if (empty($performanceType)) {
            abort(404);
        }
        return view('admin.performance_types.edit', compact('performanceType'));
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
        $this->performanceTypeRepository->editPerformanceType($data, $id);
        Session::flash('message', 'Successfully updated nerd!');
        return redirect()->route('performance-types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PerformanceType::find($id)->delete();
        return redirect()->route('performance-types.index');
    }
}
