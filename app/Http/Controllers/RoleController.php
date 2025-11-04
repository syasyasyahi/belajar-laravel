<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\role;
use Illuminate\Http\Request;
use Alert;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Role::orderBy('id', 'desc')->get();
        $title = 'Data Role';
        return view('roles.index', compact('datas', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Role';
        return view('roles.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Role::create($request->all());
        alert()->success('Success', 'Data succesfully inserted');
        return redirect()->to('role');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Role::find($id);
        $title = "Edit Roles";
        return view('role.edit', compact('edit', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update = Role::find($id);
        $update->name = $request->name;
        $update->save();
        alert()->success('Success', 'Update Sucess!');
        return redirect()->to('role');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::find($id)->delete();
        alert()->success('Success', 'Data succesfully deleted');
        return redirect()->to('role');
    }
}
