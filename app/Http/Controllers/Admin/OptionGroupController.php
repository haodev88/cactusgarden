<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\OptionGroup;
use App\Http\Requests\cms\OptionGroupRequest;

class OptionGroupController extends Controller {

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
        $input  = $request->all();
        $stt    = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0; 
        $data['stt'] = $stt;
        $listGroup   = OptionGroup::orderBy('id','DESC')->paginate($this->_rowperpage);
        $data['listGroup'] = $listGroup;
        return view('cms.option.list-group',$data);
    }

    public function search(Request $request) {
        $input     = $request->all();
        if (isset($input['optionname']) && $input['optionname']!='') {
            $listGroup = OptionGroup::where('name','LIKE','%'.$input['optionname'].'%')->orderBy('id','DESC')->paginate($this->_rowperpage);
            $stt       = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0; 
            $data['stt']       = $stt;
            $data['input']     = $input;
            $data['listGroup'] = $listGroup;
            $data['append']['optionname'] = $input['optionname'];
            return view('cms.option.list-group',$data);
        } else {
            return Redirect()->route('admin_shop.option-group.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('cms.option.add-group');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OptionGroupRequest $request) {
        $input = $request->all();
        OptionGroup::create([
            'name'  => $input['txtName']
        ]);
        return Redirect()->route('admin_shop.option-group.index');
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
        $optionGroup = OptionGroup::findOrfail($id);
        $data['optionGroup'] = $optionGroup;
        return view('cms.option.edit-group',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OptionGroupRequest $request, $id) {
        $input = $request->all();
        OptionGroup::find($id)->update([
            'name'  => $input['txtName']
        ]);
        return Redirect()->route('admin_shop.option-group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        OptionGroup::findOrfail($id)->delete();
        return Redirect()->route('admin_shop.option-group.index');
    }
}
