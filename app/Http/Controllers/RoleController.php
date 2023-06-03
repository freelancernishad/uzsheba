<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class RoleController extends Controller
{

    public function deleteuser(Request $request,$id)
    {

        $User =  User::find($id);
        $User->delete();
        return 'User deleted!';


    }
    public function getuser(Request $request,$id)
    {
       $data =  User::find($id);

    //    if($data->words){

    //        $data['words'] = json_decode($data->words);
    //     }else{
    //         $data['words'] = [];

    //    }

       return $data;



    }


    public function updateuser(Request $request)
    {
        $id = $request->id;


          $data = $request->except(['password','signature']);

          $signatureCount =  count(explode(';', $request->signature));
          if ($signatureCount > 1) {
              $data['signature'] =  fileupload($request->signature, "sonod/signature/");
          }


          if($id){
            $users = User::find($id);
$changepass =   $request->changepass;
            if($changepass){

                $oldpassword =   $request->oldpassword;
               $oldpasscheck =  Hash::check($oldpassword, $users->password);
               if($oldpasscheck){

                $newpassword =   $request->newpassword;
                // if($newpassword===$oldpasscheck){
                    $data['password'] = hash::make($request->newpassword);
                    return $users->update($data);
                // }
                // else{
                // //naew and old password does not match

                //     return 2;
                // }

               }else{
                //old password does not match

                return 0;
               }


            }else{
                return $users->update($data);
            }




            }else{
                $data['password'] = hash::make($request->password);
                return User::create($data);
          }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            $position = $request->position;
             $upozila = $request->upozila;
             $unioun = $request->unioun;

            if($position=='Thana_admin'){
                $positions = ['Secretary', 'Chairman'];
                return User::whereIn('position',$positions)
                ->where(['upozila'=>$upozila])
                ->get();
            }

            if($upozila){

                return User::where(['upozila'=>$upozila])->get();
            }
            if($unioun){

                return User::where(['unioun'=>$unioun])->get();
            }
            return User::all();

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
