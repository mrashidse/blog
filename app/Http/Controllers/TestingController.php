<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestingController extends Controller
{
    private $user;

    /**
     * TestingController constructor.
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function index0(){
//        dd("I am here");
        $users = User::all();
        return view('testing.index',compact('users'));
    }

    public function index(){
//        dd("I am here");
//        $users = User::skip(0)->take(20)->get();
        $users = User::paginate(4);
        return view('testing.index',compact('users'));
    }

    public function create(){
        $title = 'Create User';
        $user = $this->user;
        return view('testing.create',compact('user','title'));
    }

    public function edit($id){
//        dd($id);
        $title = 'Edit User';
        $user = User::find($id);
        return view('testing.edit',compact('user','title'));
    }

    public function saveTestingUser1(Request $request){
        $formData = $request->all();
        $validator = Validator::make($formData, [
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'email' => 'required|email|max:30|unique:users',
        ]);

        if($validator->fails()){
            return redirect()->route('testingCreate')->withErrors($validator)->withInput();
        }else{
            $id = $request->get('id',null);
            if($id){
                $formData = array_except($formData,['_token','btnSave',"password"]);
                $user = User::where('id',$id)->update($formData);
            }else{
                $user = User::create($formData);
            }
            //***** After Save
            if($user){
                return redirect()->route('testingIndex')->with('success', 'You data has been saved successfully!');
            }else{
                return redirect()->route('testingCreate')->with("error","Error!");
            }
        }
    }

    public function saveTestingUser(UserStoreRequest $request){
        $formData = $request->all();
        $id = $request->get('id',null);
        if($id){
            $formData = array_except($formData,['_token','btnSave',"password"]);
            $user = User::where('id',$id)->update($formData);
        }else{
            $user = User::create($formData);
        }
        //***** After Save
        if($user){
            return redirect()->route('testingIndex')->with('success', 'You data has been saved successfully!');
        }else{
            return redirect()->route('testingCreate')->with("error","Error!");
        }
    }
}
