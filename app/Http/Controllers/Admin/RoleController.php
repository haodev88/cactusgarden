<?php 
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\Cms\RoleRequest;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use DB;
use Auth;

class RoleController extends Controller
{
    private $_rowperpage;
    private $_pathImage;
    private $_pathStore;
    private $_path_delete;

    public function __construct() {
        $this->_rowperpage = config('global.row_per_page');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $stt    = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0; 
        $data['stt'] = $stt;
        $data['listRole'] = Role::paginate($this->_rowperpage);
        return view('cms.role.list',$data);
    }

    public function search(Request $request) {
        $input = $request->all();
        if (!isset($input['role'])) return Redirect()->route('admin_shop.role.index');
        $data['input'] = $input;
        $stt           = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0; 
        $data['stt']   = $stt;
        $role          = Role::where('display_name','LIKE','%'.$input['role'].'%')->paginate($this->_rowperpage);
        $data['listRole'] = $role;
        $data['append']   = ['role'=>$input['role']];
        return view('cms.role.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $permission = Permission::get();
        return view('cms.role.add',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request) {
        $input = $request->all();
        $role = new Role();
        $role->name = $request->input('txtRole');
        $role->display_name = $request->input('txtDisplay');
        $role->description = $request->input('txtDesc');
        $role->save();
        return redirect()->route('admin_shop.role.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $role         = Role::find($id);
        $data["role"] = $role;
        return view('cms.role.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id) {
        $input = $request->all();
        $role = Role::find($id);
        $role->name         = $input['txtRole'];
        $role->display_name = $input['txtDisplay'];
        $role->description  = $input['txtDesc'];
        $role->save();
        return Redirect()->route('admin_shop.role.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('admin_shop.role.index');
    }
}
