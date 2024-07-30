<?php

namespace App\Http\Controllers\Admin;

use File;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\FeautureController;
use App\Models\UserGroup;
// use Illuminate\Routing\Route;
use App\Http\Requests\cms\UserRequest;
use Carbon\Carbon;
use DateTime;
use App\Models\Role;
use DB;
use League\Flysystem\Config;

class UserController extends Controller {

    private $_rowperpage;
    private $_pathImage;
    private $_pathStore;
    private $_resize;

    public function __construct(Request $request) {
        $actionName         = getActionName($request);
        if (in_array($actionName,['store','update','delete'])) {
            $this->_pathImage   = Config('global.path_upload_root').'avatars/'.forderStore('avatars');
            $this->_pathStore   = Config('global.path_upload_root').'avatars/'.forderStore('avatars').'/thumbs';
        }
        $this->_rowperpage  = config('global.row_per_page');
        $this->_resize      = Config('global.size_avatar');
        $this->_path_delete = Config('global.path_upload_root').'avatars/';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $res    = User::paginate($this->_rowperpage);
        $data['listUser'] = $res;
        $input  = $request->all();
        $stt    = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0;
        $data['stt'] = $stt;
        return view('cms.user.list',$data);
    }

    public function search(Request $request) {
        $input  = $request->all();
        $user   = new User();
        if (isset($input['username']) && !empty($input['username'])) {
            $user = $user->where('username','LIKE','%'.$input['username'].'%');
            $data['append']['username'] = $input['username'];
        }

        if (isset($input['email']) && !empty($input['email'])) {
            $user = $user->where('email','LIKE','%'.$input['email'].'%');
            $data['append']['email']    = $input['email'];
        }

        if (isset($input['name']) && !empty($input['name'])) {
            $user = $user->where('name','LIKE','%'.$input['name'].'%');
            $data['append']['name']     = $input['name'];
        }

        if (isset($input['date']) && !empty($input['date'])) {
            $date   = date("Y-m-d",strtotime(str_replace('/', '-', $input['date'])));
            $user   = $user->where('created_at','LIKE','%'.$date.'%');
            $data['date'] = $input['date'];
        }
        $data['input'] = $input;
        $res    = $user->paginate($this->_rowperpage);
        $data['listUser'] = $res;
        $input  = $request->all();
        $stt    = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0;
        $data['stt'] = $stt;
        return view('cms.user.list',$data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $userGroup          = UserGroup::select('id','name')->get()->toArray();
        $data['userGroup']  = $userGroup;
        $roles = Role::lists('display_name','id');
        $data['roles'] = $roles;
        // $feautureController = FeautureController::with('action')->get()->toArray();
        // $data['feautureController'] = $feautureController;
        return view('cms.user.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request) {
        $input = $request->all();
        // upload file
        $filename = NULL;
        if (isset($input['txtFile']) && !empty($input['txtFile'])) {
            $file      = $input['txtFile'];
            $newFile   = changeFileName($file->getClientOriginalName());
            $file->move($this->_pathImage, $newFile);
            $filename  = forderStore().'/'.$newFile;
            if (!empty($this->_resize)) {
                foreach ($this->_resize as $k => $v) {
                    $outPutFile = $v[0].'x'.$v[1].'_'.$newFile;
                    resizeImage($this->_pathImage,$this->_pathStore,$newFile,$outPutFile,$v[0],$v[1]);
                }
            }
        }
        // create user
        $u = User::create([
            'username'  => $input['txtUser'],
            'email'     => $input['txtEmail'],
            'password'  => bcrypt($input['txtPass']),
            'activated' => 1,
            'name'      => $input['txtName'],
            'avatar'    => $filename
        ]);
        $uid = $u->id;
        $user = User::find($uid);
        // insert user group
        if (isset($input['sltGroup']) && !empty($input['sltGroup'])) {
            foreach ($input['sltGroup'] as $groupId) {
                $user->group()->attach($uid,['user_group_id' => $groupId]);
            }
        }
        if (isset($input['roles']) && !empty($input['roles'])) {
            foreach ($input['roles'] as $key => $value) {
                $user->attachRole($value);
            }
        }
        return Redirect()->route('admin_shop.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $data['user'] = User::where('id',$id)->first()->toArray();
        $data['path'] = Config('global.path_upload_root');
        return View('cms.user.Profile',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        // get data user by id
        $ugroup  = User::with('group')->find($id)->toArray();
        $listGroupId  = [];
        if (isset($ugroup['group']) && !empty($ugroup['group'])) {
            foreach($ugroup['group'] as $groupId) {
                $listGroupId[] = $groupId['id'];
            }
        }
        $u = User::find($id);
        $data['listGroupId'] = $listGroupId;
        $data['id']         = $id;
        $userGroup          = UserGroup::select('id','name')->get()->toArray();
        $data['userGroup']  = $userGroup;
        $data["roles"]      = Role::lists('display_name','id');
        $data["userRole"]   = $u->roles->lists('id')->toArray();
        $data['user']       = $u->toArray();
        return view('cms.user.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id) {
        $user   = User::find($id);
        $input    = $request->all();

        $filename = $input['oldAvatar'];
        if (isset($input['txtFile']) && !empty($input['txtFile'])) {
            $fileDelete = $input['oldAvatar'];
            if (File::exists($this->_path_delete.$fileDelete)) {
                File::delete($this->_path_delete.$fileDelete);
            }
            // delete image resize
            foreach ($this->_resize as $key => $size) {
                $s      = $size[0].'x'.$size[1];
                $outPut = sizeOfFileName($fileDelete,$s);
                if (File::exists($this->_path_delete.$outPut['path'].$outPut['filename'])) {
                    File::delete($this->_path_delete.$outPut['path'].$outPut['filename']);
                }
            }
            $file      = $input['txtFile'];
            $newFile   = changeFileName($file->getClientOriginalName());
            $file->move($this->_pathImage, $newFile);
            $filename  = forderStore().'/'.$newFile;
            if (!empty($this->_resize)) {
                foreach ($this->_resize as $k => $v) {
                    $outPutFile = $v[0].'x'.$v[1].'_'.$newFile;
                    resizeImage($this->_pathImage,$this->_pathStore,$newFile,$outPutFile,$v[0],$v[1]);
                }
            }
        }
        // update user
        $dataUser = [
            'username'  => $input['txtUser'],
            'email'     => $input['txtEmail'],
            'activated' => 1,
            'name'      => $input['txtName'],
            'avatar'    => $filename
        ];

        if (isset($input['txtPass']) && $input['txtPass']!='') {
            $dataUser['password'] = bcrypt($input['txtPass']);
        }

        $user   = User::find($id);
        $update = $user->update($dataUser);

        // Detach user group
        $user->group()->detach();
        // Attach user
        if (isset($input['sltGroup']) && !empty($input['sltGroup'])) {
            foreach ($input['sltGroup'] as $key => $idGroup) {
                $user->group()->attach($id,['user_group_id' => $idGroup]);
            }
        }
        // Detach userActionController
        DB::table('role_user')->where('user_id',$id)->delete();
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }
        return Redirect()->route('admin_shop.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $u = User::find($id);
        if ($u) {
            $u->userController()->detach();
            $u->group()->detach();
            $u->destroy($id);
        }
        return Redirect()->route('admin_shop.user.index');
    }

    private function proccessArray($arrayParam) {
        $dataReturn = [];
        if (isset($arrayParam) && !empty($arrayParam)) {
            foreach ($arrayParam as $key => $value) {
                $dataReturn[] = $value['id'];
            }
        }
        return $dataReturn;
    }

}