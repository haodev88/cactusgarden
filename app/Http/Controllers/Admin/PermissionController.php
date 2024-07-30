<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\cms\PermissionActionRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\FeautureAction;
use App\Models\FeautureController;
use App\Models\User;

class PermissionController extends Controller {
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
        $input                  = $request->all();
        $stt                    = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0; 
        $data['stt']            = $stt;
        $data['listAction']     = FeautureController::paginate($this->_rowperpage);
        return view('cms.action.list',$data);
    }

    /**
     * [search permission]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function search(Request $request) {
        $input                  = $request->all();
        $input['permission']    = trim($input['permission']); 
        $stt                    = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0; 
        $data['stt']            = $stt;
        $data['listPermission'] = Permission::where('name','LIKE','%'.$input['permission'].'%')->paginate($this->_rowperpage);
        return view('cms.action.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // $a = Permission::with('action')->find(2)->toArray();
        return view('cms.action.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionActionRequest $request) {
        $input      = $request->all();
        // add controller to database
        $feautureController = FeautureController::create([
            'controller_name'  =>  $input['txtPermission'],
            'display_name'     =>  $input['txtDesc'],
        ]);
        // add action to database
        $action = explode(',', $input['txtAction']);
        foreach ($action as $key => $value) {
            FeautureAction::create([
                'controller_id' => $feautureController->id,
                'action_name'   => $value,
                'display_name'  => $value
            ]);
        }
        return Redirect()->route('admin_shop.permission.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $data['permission'] = $per = FeautureController::with('action')->find($id)->toArray();
        $actionName         = $data['permission']['action'];
        $exportAction       = "";
        foreach ($actionName as $key => $value) {
            $exportAction.= $value["action_name"].",";
        }
        $exportAction = rtrim($exportAction,',');
        $data['actionName'] = $exportAction;
        return view('cms.action.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionActionRequest $request, $id) {
        $input = $request->all();
        // update permission
        FeautureController::findOrfail($id)->update([
            'controller_name'  =>  $input['txtPermission'],
            'display_name'     =>  $input['txtPermission'],
        ]);
        FeautureAction::where('controller_id',$id)->delete();
        // add new action
        $action = explode(',', $input['txtAction']);
        foreach ($action as $key => $value) {
            FeautureAction::create([
                'controller_id' => $id,
                'action_name'   => $value,
                'display_name'  => $value
            ]);
        }
        return redirect()->route('admin_shop.permission.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $permission = FeautureController::find($id);
        if ($permission) {
            $permission->user()->detach();
            $permission->action()->delete();
            $permission->delete();
        }
        return redirect()->route('admin_shop.permission.index');
    }
}
