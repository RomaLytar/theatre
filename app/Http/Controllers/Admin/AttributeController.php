<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Repositories\AttributeRepository;
use App\Http\Requests\StoreAttribute;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AttributeController extends Controller
{

    protected $attributeRepository;

    public function __construct(AttributeRepository $attributeRepository)
    {
        $this->middleware('permission:attribute-list');

        $this->attributeRepository = $attributeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::paginate();
        return view('admin.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAttribute|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttribute $request)
    {
        $data = $request->all();

        $this->attributeRepository->createAttributes($data);

        Session::flash('message', 'Successfully created attribute!');
        return redirect()->route('attributes.index');
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
        if (!$attribute = Attribute::find($id)) {
            abort(404);
        }

        return view('admin.attributes.edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreAttribute|Request $request
     * @param  int $id
     * @return Response
     */
    public function update(StoreAttribute $request, $id)
    {
        if (!$attribute = Attribute::find($id)) {
            throw new NotFoundHttpException('Attribute not found');
        }
        $data = $request->all();

        $this->attributeRepository->editAttribute($data, $attribute);
        Session::flash('message', 'Successfully edited attribute!');
        return redirect()->route('attributes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute = Attribute::find($id);
        $attribute->delete();
        return redirect()->route('attributes.index');
    }
}
