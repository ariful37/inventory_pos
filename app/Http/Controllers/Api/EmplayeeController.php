<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Emplayee;
use DB;
use Image;
class EmplayeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Emplayee::all();
        return response()->json($employee);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $validatedData = $request->validate([
                'name' => 'required|unique:emplayees|max:255',
                'email' => 'required',
                'phone' => 'required|unique:emplayees',
            ]);

               if($request->photo){
                      $position = strpos($request->photo, ';');
                      $sub=substr($request->photo, 0 ,$position);
                      $ext=explode('/', $sub)[1];
                      $name=time().".".$ext;
                      $img=Image::make($request->photo)->resize(240,200);
                      $upload_path='backend/employee/';
                      $image_url=$upload_path.$name;
                      $img->save($image_url);

                      $employee = new Emplayee;
                      $employee->name = $request->name;
                      $employee->email = $request->email;
                      $employee->phone = $request->phone;
                      $employee->address = $request->address;
                      $employee->salary = $request->salary;
                      $employee->nid = $request->nid;
                      $employee->joining_date = $request->joining_date;
                      $employee->photo =  $image_url;
                      $employee->save();
               }else{
                      $employee = new Emplayee;
                      $employee->name = $request->name;
                      $employee->email = $request->email;
                      $employee->phone = $request->phone;
                      $employee->address = $request->address;
                      $employee->salary = $request->salary;
                      $employee->nid = $request->nid;
                      $employee->joining_date = $request->joining_date;
                      $employee->save();
               }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Emplayee::where('id',$id)->first();
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $employee = Emplayee::find($id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->salary = $request->salary;
        $employee->nid = $request->nid;
        $employee->joining_date = $request->joining_date;

        $employee->save();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee=DB::table('emplayees')->where('id',$id)->first();
        $photo=$employee->photo;
        if ($photo) {
           unlink($photo);
           DB::table('emplayees')->where('id',$id)->delete();
        }else{
         DB::table('emplayees')->where('id',$id)->delete();
        }
    }
}
