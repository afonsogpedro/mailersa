<?php

namespace App\Http\Controllers;

use App\Http\Request\UserCreateRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use DB;
use Hash;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store','getUsers']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    public function getusers(Request $request)
    {
        $var = json_decode($request->params);
        $users = User::getusers();

        if (count($var->filters) > 0) {
            $users = $users->where($var->filters[0]->field, $var->filters[0]->type, $var->filters[0]->value);
        }
        if (count($var->sorters) > 0) {
            $users = $users->orderby($var->sorters[0]->field, $var->sorters[0]->dir);
        }

        $perPage = $var->size;
        $users = $users->paginate($perPage, ['*'], 'page', $var->page);

        return response()->json($users, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get(["name", "id"]);
        $roles = Role::pluck('name', 'id')->all();
        $status = ['1' => 'Active', '0' => 'Inactive'];

        return view('users.create',compact('roles', 'status', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $validated = $request->validated();
        if(isset($input['photo'])) {
            $imageName = md5(time()) . '.' . $input['photo']->extension();
            $input['photo']->move(public_path('dist/images'), $imageName);
            $input['photo'] = $imageName;
        }
        $input = $request->all();

        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('success','Usuario creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $city = City::find($user->citycod);
        $state = State::find($city->state_id);
        $country = Country::find($state->country_id);

        return view('users.show',compact('user', 'city', 'state', 'country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','id')->all();
        $userRole = $user->roles->pluck('id','id')->all();
        $status = ['1' => 'Active', '0' => 'Inactive'];
        $countries = Country::get(["name", "id"]);

        return view('users.edit',compact('user','roles', 'userRole', 'status', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserCreateRequest $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:usuarios,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
        ]);
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input,array('password'));
        }
        if(isset($input['photo'])) {
            $filePath = $this->UserImageUpload($input['photo']);
            $input['photo'] = $filePath;
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect()->route('users.index')->with('success','Usuario borrado con éxito');
    }

    public function deletephoto($id)
    {
        $current_user = User::find($id);
        $current_user->photo = null;
        $current_user->save();
    }

    public function UserImageUpload($query) // Taking input image as parameter
    {
        $image_name = Str::random(20);
        $ext = strtolower($query->extension());
        $image_full_name = $image_name.'.'.$ext;
        $upload_path = 'dist/images';    //Creating Sub directory in Public folder to put image
        $image_url = $image_full_name;
        $success = $query->move($upload_path,$image_full_name);

        return $image_url;
    }
}
