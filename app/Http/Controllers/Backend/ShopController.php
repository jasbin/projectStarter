<?php

namespace App\Http\Controllers\Backend;

use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.shops.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getData()
    {
        if(auth()->user()->hasAnyRole('Administrator')){
            $shop = Shop::get();
        }else{
            $shop = Shop::where('user_id', auth()->id())->get();
        }

        return DataTables::of($shop)
            ->addColumn('description', function($shop){
                //replacing all html tags using regix
                return substr(preg_replace('#\<(.*?)\>#', '', $shop->description),0,50);
            })
            ->addColumn('creator', function ($shop) {
                return User::select('name')->where('id',$shop->user_id)->first()->name;
            })
            ->addColumn('action', function ($shop) {
                if (auth()->user()->hasAnyRole(['administrator','admin']) ) {
                    return '<div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Choose
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="shop/show/'.$shop->id.'">View</a>
                      <a class="dropdown-item" href="shop/edit/'.$shop->id.'">Edit</a>
                      <a class="dropdown-item" href="shop/delete/'.$shop->id.'" onclick="return confirm(\'Are you sure?\')">Delete</a>
                    </div>
                  </div>';
                }else{
                    return '<div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Choose
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="shops/show/'.$shop->id.'"><i class="fas fa-search"></i>&nbsp;&nbsp; View</a>
                      <a class="dropdown-item" href="'.route('shops.edit',$shop->id).'"><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp; Edit</a>
                      <a class="dropdown-item" href="shops/destroy/'.$shop->id.'" onclick="return confirm(\'Are you sure?\')"><i class="fas fa-trash"></i>&nbsp;&nbsp; Delete</a>
                    </div>
                  </div>';
                }})
            ->make(true);
    }

    public function create()
    {
        return view('backend.shops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shop = Shop::firstOrCreate([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->id()
        ]);

        return back()->with('flash_success','Shop Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['shop'] = Shop::find($id);
        return view('backend.shops.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['shop'] = Shop::find($id);
        return view('backend.shops.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Shop::find($id)->update($request->only(['name','description','ratings']));

        return back()->with('flash_success', 'Shop updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Shop::find($id)->delete();

        return view('backend.shops.index')->with('flash-message','shop deleted successfully');
    }
}
