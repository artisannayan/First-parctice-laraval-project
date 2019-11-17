<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Division;
 use App\Models\District;


class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //To Call CreateCategory form page
  public function division_create()
  {
  
    return view('Backend.pages.division.createdivision');
  }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
      $divisions = Division::orderBy('priority', 'asc')->get();
      return view('Backend.pages.division.manage',compact('divisions'))
  ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Category Store korar jonno
  public function division_store(Request $request)
  {
    // Validate The Form Data
    $request->validate(
      [
        'name'              => 'required|max:255',
        'priority'              => 'required|max:120',
        
      ],
      [
        'name.required'     => 'Please Provide Division Name',
        'priority.required'     => 'Please Provide Division of the Priority',
        
      ]
    );

    $divisions = new Division();
    $divisions->name = $request->name;
    $divisions->priority = $request->priority;



    $divisions->save();

    session()->flush('success', 'A New brand Has Division Added Successfully');
    return redirect()->route('admin.division');
  }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function division_edit($id)
    {
     
      $division = division::find($id);
      if(!is_null($division)){
        return view('Backend.pages.division.editdivision', compact('division'));
      }else{
        return route('admin.division');
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function division_update(Request $request, $id)
    {
      // Validate The Form Data
      $request->validate(
        [
          'name'              => 'required|max:255',
          'priority'              => 'required|max:120',
          
        ],
        [
          'name.required'     => 'Please Provide Division Name',
          'priority.required'     => 'Please Provide Division of the Priority',
         
        ]
      );
  
      $divisions = Division::find($id);
      $divisions->name = $request->name;
      $divisions->priority = $request->priority;
  
      $divisions->save();
  
      session()->flush('success', 'A New Divisions Has Been Added Successfully');
      return redirect()->route('admin.division');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function division_delete($id)

//If It is Parent Category , Then we will delete all its sub Category

  {
    $division = Division::find($id);
    if (!is_null($division)) {

        $district = District::where('division_id',$division->id)->get();
        foreach($districts as $district){
            $district->delete();
        }
      
      $division->delete();
      return back();
    }
  }

}
