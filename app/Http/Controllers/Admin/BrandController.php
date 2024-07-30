<?php

namespace App\Http\Controllers\Admin;
use File;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\http\requests\cms\BrandRequest;
// use Illuminate\Routing\Route;

class BrandController extends Controller {
    
    private $_rowperpage;
    private $_pathImage;
    private $_pathStore;
    private $_path_delete;

    public function __construct(Request $request) {
        $actionName         = getActionName($request);
        if (in_array($actionName,['store','update','delete'])) {
            $this->_pathImage  = Config('global.path_upload_root').'brands/'.forderStore('brands');
            $this->_pathStore  = Config('global.path_upload_root').'brands/'.forderStore('brands').'/thumbs';
        }
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
        $data["listBrand"] = Brand::orderBy('id','DESC')->paginate($this->_rowperpage);
        $data['stt'] = $stt;
        return view('cms.brand.list',$data);
    }


    public function search(Request $request) {
        $input       = $request->all();
        if (!isset($input['brandname']) || $input['brandname'] == '') {
            return Redirect()->route('admin_shop.brand.index');
        }
        $data['get'] = $input;
        $data['listBrand']  = Brand::where('name','LIKE','%'.$input['brandname'].'%')->paginate($this->_rowperpage);
        $data['stt']        = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0; 
        $data['append']['brandname'] = $input['brandname'];
        return view('cms.brand.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('cms.brand.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request) {
        $input    = $request->all();
        $fileName = null;
        if (isset($input['txtFile']) && !empty($input['txtFile'])) {
            $file     = $input['txtFile'];
            $fileName = changeFileName($file->getClientOriginalName());
            $file->move($this->_pathImage, $fileName);
            // resize image follow config
            $sieOfImage = Config('global.size_brand');
            foreach ($sieOfImage as $key => $item) {
                $outPutName = $item[0].'x'.$item[1].'_'.$fileName;
                resizeImage($this->_pathImage,$this->_pathStore,$fileName,$outPutName,$item[0],$item[1]);
            }
        }
        Brand::create([
            'user_id'       => Auth::user()->id,
            'name'          => $input['txtBrand'],
            'slug'          => str_slug($input['txtBrand']),
            'filename'      => !empty($fileName) ? forderStore().'/'.$fileName : null,
            'short_desc'    => $input['txtShort'],
            'long_desc'     => $input['txtLong'],
            'active'        => 1,
        ]);
        return Redirect()->route('admin_shop.brand.index');
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
        $data['brand'] = Brand::findOrfail($id)->toArray();
        return view('cms.brand.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id) {
        $input    = $request->all();
        $fileName = null;
        $resize   = Config('global.size_brand');
        // remove image brand
        if (isset($input['txtDeleteImage']) && $input['txtDeleteImage']!='') {
            $fileDelete = $input['txtDeleteImage'];
            $this->deleteImage($fileDelete);
        }
        // upload new image if exists
        if (isset($input['txtFile']) && !empty($input['txtFile'])) {
            $file        = $input['txtFile'];
            $fileName    = changeFileName($file->getClientOriginalName());
            $file->move($this->_pathImage,$fileName);
            // resize image
            foreach ($resize as $key => $size) {
                $outputFile = $size[0].'x'.$size[1].'_'.$fileName;
                resizeImage($this->_pathImage, $this->_pathStore, $fileName, $outputFile, $size[0], $size[1]);
            }
        }
        // update brand with id
        Brand::findOrfail($id)->update([
            'user_id'       => Auth::user()->id,
            'name'          => $input['txtBrand'],
            'slug'          => str_slug($input['txtBrand']),
            'filename'      => !empty($fileName) ? forderStore().'/'.$fileName : null,
            'short_desc'    => $input['txtShort'],
            'long_desc'     => $input['txtLong'],
            'active'        => 1,
        ]);
        return Redirect()->Route('admin_shop.brand.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $brand = Brand::findOrfail($id);
        $data  = $brand->toArray();
        // check images
        if (isset($data["filename"]) && !empty($data["filename"])) {
            $this->deleteImage($data["filename"]);
        }
        // delete brand with id
        if ($brand) {
            $brand->delete();
        }
        return Redirect()->Route('admin_shop.brand.index');
    }

    /**
    |------------------------------------------------------------------------
    | Function Delete images brand
    |-------------------------------------------------------------------------
    */
    private function deleteImage($fileDelete ) {
        $resize  = Config('global.size_brand');
        if (File::exists(Config('global.path_upload_root').'brands/'.$fileDelete)) {
            File::delete(Config('global.path_upload_root').'brands/'.$fileDelete);
        }
        // delete image resize
        foreach ($resize as $key => $size) {
            $s      = $size[0].'x'.$size[1];
            $outPut = sizeOfFileName($fileDelete,$s);
            if (File::exists(Config('global.path_upload_root').'brands/'.$outPut['path'].$outPut['filename'])) {
                File::delete(Config('global.path_upload_root').'brands/'.$outPut['path'].$outPut['filename']);
            }
        }
    }

}
