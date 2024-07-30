<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\http\Requests\cms\RoleRequest;
use App\Models\UserGroup;


class UserGroupController extends Controller {

    private $_rowperpage;

    public function __construct() {
        $this->_rowperpage = config('global.row_per_page');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $input        = $request->all();
        $stt          = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0; 
        $data['stt']  = $stt;
        $listGroup         = UserGroup::paginate($this->_rowperpage);
        $data['listGroup'] = $listGroup;
        return view('cms.user-group.list',$data);
    }

    /**
     * [proccess query data]
     * @return [html] [result of search]
     */
    public function search(Request $request) {
        $input = $request->all();
        if (!isset($input['group'])) return Redirect()->route('admin_shop.group.index');
        $data['input'] = $input;
        $stt           = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0; 
        $data['stt']   = $stt;
        $listGroup         = UserGroup::where('name',$input['group'])->paginate($this->_rowperpage);
        $data['listGroup'] = $listGroup;
        $data['append']    = ['group'=>$input['group']];
        return view('cms.user-group.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('cms.user-group.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request) {
        $input = $request->all();
        UserGroup::create([
            'name'   => $input['txtName']
        ]);
        return Redirect()->route('admin_shop.group.index');
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
    public function edit($id) {
        $userGroup = UserGroup::findOrfail($id);
        return view('cms.user-group.edit')->with(['group'=>$userGroup]);
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
        UserGroup::findOrfail($id)->update([
            'name'  => $input['txtName'],
        ]);
        return Redirect()->route('admin_shop.group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $UserGroup = UserGroup::findOrfail($id); // Pull back a given role
        if ($UserGroup) {
            $UserGroup->delete();
        }
        return Redirect()->route('admin_shop.group.index');
    }
}
