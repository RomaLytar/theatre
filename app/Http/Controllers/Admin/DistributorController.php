<?php

namespace App\Http\Controllers\Admin;

use App\Models\Distributor;
use App\Http\Requests\StoreDistributor;
use App\Repositories\UserRepository;
use App\Transformers\DistributorTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\DistributorRepository;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DistributorController extends Controller
{

    protected $distributorRepository;
    protected $userRepository;

    public function __construct(DistributorRepository $distributorRepository, UserRepository $userRepository)
    {
        $this->middleware('permission:distributor-list');
        $this->middleware('permission:distributor-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:distributor-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:distributor-delete', ['only' => ['destroy']]);

        $this->distributorRepository = $distributorRepository;
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distributors = Distributor::latest()->paginate();

        return view('admin.distributors.index', compact('distributors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.distributors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistributor $request)
    {
        $data = $request->all();

        $user = $this->userRepository->createDistributor($data);
        $data['user_id'] = $user->id;

        $distributor = $this->distributorRepository->createDistributor($data);

        return response()->json([
            'data' => $distributor
        ]);
    }

    public function getList()
    {
        $distributors = Distributor::all();

        return fractal()
            ->collection($distributors)
            ->transformWith(new DistributorTransformer)
            ->toArray();
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
        if (!$distributor = Distributor::find($id)) {
            abort(404);
        }

        return response()->json([
            'data' => $distributor
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDistributor $request, $id)
    {
        $data = $request->all();

        $distributor = $this->distributorRepository->editDistributor($data, $id);

        return response()->json([
            'data' => $distributor
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$distributor = Distributor::find($id)) {
            abort(404);
        }
        $distributor->delete();
    }
}
