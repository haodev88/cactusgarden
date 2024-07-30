<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\cms\CategoryAddRequest;
use App\Http\Requests\cms\CategoryEditRequest;
use Carbon\Carbon;


class CategoryController extends Controller {

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

        // $date = Carbon::createFromFormat('d/m/Y H:i:s', '11/06/1990 00:00:00');
        // echo $date;
        // die;
        $res    = Category::paginate($this->_rowperpage);
        $data['listCate'] = $res;
        $input  = $request->all();
        $stt    = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0; 
        $data['stt'] = $stt;
        return view('cms.category.list',$data);
    }

    /**
     * [search description]
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)  {
        $input  = $request->all();
        if (!isset($input['catename'])) {
            return Redirect()->route('admin_shop.category.index');
        }
        $append = [];
        $append['catename'] = isset($input["catename"]) ?  $input["catename"] : [];
        $res = Category::where('title','LIKE','%'.$input["catename"].'%')->paginate($this->_rowperpage);
        $data['append']   = $append;
        $data['listCate'] = $res;
        $stt   = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0; 
        $data['stt'] = $stt;
        return view('cms.category.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // show form add
        $res  = Category::all()->toArray();
        $data["listCate"] = $res;
        return view('cms.category.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryAddRequest $request) {
        $input      = $request->all();
        $rootSlug   = $input['txtSlugRoot'];
        $property   = [
            'li_class'   => ($input['sltCate'] == 0) ? 'dropdown' : 'dropdown-submenu',
            'a_property' => ($input['sltCate'] == 0) ? 'tabindex="0" data-toggle="dropdown" data-submenu' : '',
            'icon_sub'   => ($input['sltCate'] == 0) ? '<span class="caret"></span>' : '',
        ];
        Category::create([
            'title'     => ucfirst($input['txtCate']),
            'slug'      => ($input['sltCate'] == 0) ? str_slug($input['txtCate']) : $rootSlug.'/'.str_slug($input['txtCate'], '-'),
            'parent_id' => $input['sltCate'],
            'property'  => json_encode($property)
        ]);
        return Redirect()->route('admin_shop.category.index');
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
        $cate = Category::findOrfail($id)->toArray();
        $res  = Category::all()->toArray();
        $data["listCate"] = $res;
        $data['cate']     = $cate;
        return view('cms.category.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryEditRequest $request, $id) {
        $input      = $request->all();
        $rootSlug   = $input['txtSlugRoot'];
        $data = [
            'title'     => $input['txtCate'],
            'parent_id' => $input['sltCate'],
            'slug'      => ($input['sltCate'] == 0) ? str_slug($input['txtCate']) : $rootSlug.'/'.str_slug($input['txtCate'], '-')
        ];
        $property   = [
            'li_class'   => ($input['sltCate'] == 0) ? 'dropdown' : 'dropdown-submenu',
            'a_property' => ($input['sltCate'] == 0) ? 'tabindex="0" data-toggle="dropdown" data-submenu' : '',
            'icon_sub'   => ($input['sltCate'] == 0) ? '<span class="caret"></span>' : '',
        ];
        $data['property'] = json_encode($property);
        Category::where('id',$id)->update($data);
        return Redirect()->route('admin_shop.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $c = Category::findOrfail($id);
        $c->delete();
        return Redirect()->route('admin_shop.category.index');
    }
}
