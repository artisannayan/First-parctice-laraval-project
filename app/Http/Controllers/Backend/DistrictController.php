<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Division;
use App\Models\District;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function district_create()
    {
    
      return view('Backend.pages.district.createdistrict');
    }
  
  
      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function index()
      {
        
        $districts = District::orderBy('priority', 'asc')->get();
        return view('Backend.pages.district.manage',compact('districts'))
    ;
      }
  
      /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
      //Category Store korar jonno
      public function district_store(Request $request)
      {
        // Validate The Form Data
        $request->validate(
          [
            'name'              => 'required|max:255',
            'priority'              => 'required|max:120',
            
          ],
          [
            'name.required'     => 'Please Provide District Name',
            'priority.required'     => 'Please Provide district of the Priority',
            
          ]
        );
    
        $districts = new District();
        $districts->name = $request->name;
        $districts->priority = $request->priority;
    
    
    
        $districts->save();
    
      session()->flush('success', 'A New brand Has Division Added Successfully');
     return redirect()->route('admin.district');
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
      public function district_edit($id)
      {
       
        $district = District::find($id);
        if(!is_null($district)){
          return view('Backend.pages.district.editdistrict', compact('district'));
        }else{
          return route('admin.district');
        }
      }
  
      /**
       * Update the specified resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function district_update(Request $request, $id)
      {
        // Validate The Form Data
        $request->validate(
          [
            'name'              => 'required|max:255',
            'priority'              => 'required|max:120',
            
          ],
          [
            'name.required'     => 'Please Provide District Name',
            'priority.required'     => 'Please Provide District of the Priority',
           
          ]
        );
    
        $disrticts = District::find($id);
        $disrticts->name = $request->name;
        $disrticts->priority = $request->priority;
    
        $disrticts->save();
    
        session()->flush('success', 'A New Disrticts Has Been Added Successfully');
        return redirect()->route('admin.district');
      }
  
      /**
       * Remove the specified resource from storage.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function district_delete($id)
  
  //If It is Parent Category , Then we will delete all its sub Category
  
    {
      $district = District::find($id);    
        $district->delete();
        return back();
      }
    
}
