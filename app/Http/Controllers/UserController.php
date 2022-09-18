<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
    
class UserController extends Controller
{    
    /**
     * __construct
     *
     * @return void
     */
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    
    /**
     * index
     * Display a list of Users
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(10);

        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
        
    /**
     * create
     * Create a new User
     *
     * @return void
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();

        return view('users.create',compact('roles'));
    }
        
    /**
     * store
     * Add the new User to the Database
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
            ->with('success','User created successfully');
    }
        
    /**
     * edit
     * Change the details of the User
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
    }
        
    /**
     * update
     * Adjust the User details in the database
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();

        // If Password is Empty
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
            ->with('success','User updated successfully');
    }
        
    /**
     * destroy
     * Delete the User
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        
        return redirect()->route('users.index')
            ->with('success','User deleted successfully');
    }
    
    /**
     * search
     * Search the Website
     *
     * @param  mixed $request
     * @return void
     */
    public function search(Request $request) {

        if($request->search == NULL)
        {
            return redirect()->route('index')
                ->with('danger','Plese enter something to Search.');
        }

        $products = DB::table("products")->where('name', 'like', '%'.$request->search.'%')->get();

        return view('search',compact('products'));
    }
}