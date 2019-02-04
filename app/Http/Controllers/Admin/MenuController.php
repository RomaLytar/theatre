<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreMenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\MenuRepository;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    protected $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->middleware('permission:menu-item-list');
        $this->middleware('permission:menu-item-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:menu-item-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:menu-item-delete', ['only' => ['destroy']]);

        $this->menuRepository = $menuRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuItems = Menu::with('translate', 'children_items', 'children_items.translate')->where('parent_id', null)->orderBy('position')->get();
        return view('admin.menu.index', compact('menuItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menuItems = Menu::where('parent_id', null)->get();
        $menuItems = array_multilanguage_formatter($menuItems, 'id', 'menu');
        return view('admin.menu.create', compact('menuItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenu $request)
    {
        $data = $request->all();
        $this->menuRepository->createMenuItem($data);
        Session::flash('message', 'Successfully created menu item!');
        return redirect()->route('menu.index');
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
        $menuItem = Menu::find($id);
        if (empty($menuItem)) {
            abort(404);
        }
        $menuItems = Menu::where('parent_id', null)->where('id', '!=', $id)->get();
        $menuItems = array_multilanguage_formatter($menuItems, 'id', 'menu');
        return view('admin.menu.edit', compact('menuItem', 'menuItems'));
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
        $this->menuRepository->editMenuItem($data, $id);
        Session::flash('message', 'Successfully updated menu item!');
        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Menu::find($id)->delete();
        return redirect()->route('menu.index');
    }
}
