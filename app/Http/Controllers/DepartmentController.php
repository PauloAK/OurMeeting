<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\Department\Store;
use App\Http\Requests\Department\Update;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::orderBy('name')->get();

        return view("modules.departments.index")->with(compact(
            'departments'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("modules.departments.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Department\Store $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $department = Department::create($request->all());
        
        if ($department) {
            toastr()->success('Setor cadastrado com sucesso');
            return redirect()->route('departments.index');
        } else {
            toastr()->error('Houve um erro ao cadastrar o setor!');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view("modules.departments.edit")->with(compact(
            'department'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Department\Update  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Department $department)
    {
        $department = $department->update($request->all());

        if ($department) {
            toastr()->success('Setor atualizado com sucesso');
            return redirect()->route('departments.index');
        } else {
            toastr()->error('Houve um erro ao atualizar o setor!');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department = $department->delete();

        if ($department) {
            toastr()->success('Setor removido com sucesso');
            return redirect()->back();
        } else {
            toastr()->error('Houve um erro ao remover o setor!');
            return redirect()->back();
        }
    }
}
