<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\OptionGroup;
use App\Http\Requests\cms\OptionRequest;

class OptionController extends Controller {
    
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
        $listOption          = Option::paginate($this->_rowperpage);
        $data['listOption']  = $listOption;
        $data['optionGroup'] = OptionGroup::all();
        return view('cms.option.list-option',$data);
    }


    public function search(Request $request) {
        $input     = $request->all();
        $option    = new Option();
        $stt                 = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0; 
        $data['stt']         = $stt;
        if (isset($input['option_group']) && $input['option_group']!='') {
            $option = $option->where('dt_option_group_id',$input['option_group']);
        }
        if (isset($input['option_name']) && $input['option_name']!='') {
            $option = $option->where('name','LIKE','%'.$input['option_name'].'%');
        }
        $data['listOption']  = $option->paginate($this->_rowperpage);
        $data['optionGroup'] = OptionGroup::all();
        $data['append']['option_group']  = $input['option_group'];
        $data['append']['option_name']   = $input['option_name'];
        $data['input']  = $input;
        return view('cms.option.list-option',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $listGroup = OptionGroup::all();
        $data['listGroup'] = $listGroup;
        return view('cms.option.add-option',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OptionRequest $request) {
        $input = $request->all();
        $o     = Option::where('dt_option_group_id',$input['sltGroup'])->where('name',$input['txtName'])->count();
        if ($o !=0 ) {
            return Redirect()->back()->with('Error','Tên thuộc tính trong nhóm này đã tồn tại')->withInput();
        }
        Option::create([
            'dt_option_group_id' => $input['sltGroup'],
            'name'               => $input['txtName']
        ]);
        return Redirect()->route('admin_shop.option.index');
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
        $listGroup         = OptionGroup::all();
        $option            = Option::find($id);
        $data['listGroup'] = $listGroup;
        $data['option']    = $option;
        return view('cms.option.edit-option',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OptionRequest $request, $id) {
        $input  = $request->all();
        $o      = Option::where('dt_option_group_id','=',$input['sltGroup'])->where('id','!=',$id)->where('name',$input['txtName'])->count();
        if ($o !=0 ) {
            return Redirect()->back()->with('Error','Tên thuộc tính trong nhóm này đã tồn tại')->withInput();
        }
        $option = Option::find($id);
        if ($option) {
            $option->update([
                'dt_option_group_id' => $input['sltGroup'],
                'name'               => $input['txtName']
            ]);
        }
        return Redirect()->route('admin_shop.option.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $option = Option::find($id);
        if ($option) {
            $option->delete();
        }
        return Redirect()->route('admin_shop.option.index');
    }
}
