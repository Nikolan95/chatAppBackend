<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Group;
use App\Models\User;

use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function createGroup(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'contact' => 'required',
            'group' => 'required_without:newgroup',
            'newgroup' => 'required_without:group'
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
        else{
            if($request->newgroup){
                $group = Group::create([
                    'name' => $request['newgroup'],
                ]);
                $queryId = DB::getPdo()->lastInsertId();

                if($group){
                    $user = User::where('id', $request->contact)->update(['group_id' => $queryId]);
                    return response()->json($user);
                }
            }
            else if($request->group){
                $user = User::where('id', $request->contact)->update(['group_id' => $request->group]);
                $user = User::where('id', $request->contact)->get();
                return response()->json('group updated succesfully');
            }
        }
    }
}
