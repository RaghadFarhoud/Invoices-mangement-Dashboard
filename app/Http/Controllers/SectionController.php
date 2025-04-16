<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= Section::get()->all();
        return view('sections.sections',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $input= $request->all();
//        //making sure that it has already registered
//
//        $if_exists= Section::where('section_name','=',$input['section_name'])->exists();
//        if($if_exists){
//            session()->flash('Error','section is already exists');
//            return redirect('/sections');
//           // return response('section is already exists');
//        }


        $validaedData = $request->validate([
           'section_name'=> 'required|unique:sections|max:255',
            'description'=> 'required'
        ],
        [
            'section_name.required'=>'please enter the section name',
            'description.required'=>'please describe your section',
            'section_name.unique'=>'choose another name, this name has already been taken',
             'section_name.max'=>'أي شو للشبع'
        ]
        );

//        else{
            Section::create([

                'section_name'=>$request->section_name,
                'description'=>$request->description,
                'created_by'=>(Auth::user()->name)

            ]);
            session()->flash('Add','Added sucssesfully');
            return redirect('/sections');
        }
//    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        $data= Section::get()->all();
        return $data;

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'description' => 'required',
        ],[

            'section_name.required' =>'please enter section name',
            'section_name.unique' =>'section name has already been taken',
            'description.required' =>'description is required',

        ]);

        $sections = Section::find($id);
        $sections->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
        ]);

        session()->flash('edit','section has been edited successfully');
        return redirect('/sections');
    }


    public function destroy(Request $request)
    {
        $id=$request->id;
        Section::find($id)->delete();
        session()->flash('delete','section has been deleted successfully');
         return redirect('/sections');
    }
}
