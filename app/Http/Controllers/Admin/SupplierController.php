<?php

namespace App\Http\Controllers\Admin;

use Auth;
use File;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\Brand;
use App\Models\Buyer;
use App\Http\Requests\cms\SupplierRequest;


class SupplierController extends Controller {
    private $_rowperpage;
    private $_pathImage;
    private $_pathStore;
    private $_resize;
    private $_path_delete;


    public function __construct(Request $request) {
        $actionName         = getActionName($request);
        if (in_array($actionName,['store','update','delete'])) {
            $this->_pathImage   = Config('global.path_upload_root').'suppliers/'.forderStore('suppliers');
            $this->_pathStore   = Config('global.path_upload_root').'suppliers/'.forderStore('suppliers').'/thumbs';
        }
        $this->_rowperpage  = config('global.row_per_page');
        $this->_resize      = Config('global.size_supplier');
        $this->_path_delete = Config('global.path_upload_root').'suppliers/'; 
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $input = $request->all();
        $stt   = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0; 
        $data['listBuyer']    = Buyer::all()->toArray();
        $data['listSupplier'] = Supplier::orderBy('id','DESC')->paginate($this->_rowperpage);
        $data['stt'] = $stt;
        return view('cms.supplier.list',$data);
    }

    /**
     * Display result search data
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $input    = $request->all();
        $supplier = new Supplier();
        $q = '';
        if (isset($input['suppliername']) && $input['suppliername']!='') {
            $q = $supplier->where('name','LIKE','%'.$input['suppliername'].'%');
        } if (isset($input['sltBuyer']) && $input['sltBuyer']!='') {
            $q = $supplier->where('dt_buyer_id','LIKE','%'.$input['sltBuyer'].'%');
        }
        $stt  = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0; 
        $data['input']        = $input;
        $data['stt']          = $stt;
        $data['listBuyer']    = Buyer::all()->toArray();
        $data['listSupplier'] = $q->paginate($this->_rowperpage);
        $data['append'] = [
            'suppliername'  =>  $input['suppliername'],
            'sltBuyer'      =>  $input['sltBuyer']
        ];
        return view('cms.supplier.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data['listBuyer']    = Buyer::all()->toArray();
        $data['listBrand']    = Brand::all()->toArray();
        return view('cms.supplier.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request) {
        $input    = $request->all();
        $filename = null;
        // check upload image.
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
        // add supplier to database with orm
        $supplier = Supplier::create([
            'user_id'       => Auth::user()->id,
            'dt_buyer_id'   => $input['sltBuyer'],
            'name'          => $input['txtSupplier'],
            'short_desc'    => $input['txtShort'],
            'long_desc'     => $input['txtLong'],
            'address'       => $input['txtAddress'],
            'filename'      => $filename
        ]);
        // add Brand to dt_supplier_brand_buyer with orm
        if (isset($input['brand_id']) && !empty($input['brand_id'])) {
            $sid     = $supplier->id;
            $s       = Supplier::find($sid); 
            foreach ($input['brand_id'] as $brandId) {
                $s->brand()->attach($sid,['dt_brand_id'=>$brandId]);
            }
        }
        return Redirect()->route('admin_shop.supplier.index');
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
        // find supplier buyId
        $supplier = Supplier::with('brand')->find($id);
        $data['supplier']     = $supplier;
        $data['listBuyer']    = Buyer::all()->toArray();
        $data['listBrand']    = Brand::all()->toArray();
        return view('cms.supplier.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, $id) {
        $input    = $request->all();
        $filename = $input['txtOldImage'];
        // Delete old image if exists data
        if (isset($input['txtDeleteImage']) && !empty($input['txtDeleteImage'])) {
            $fileDelete = $input['txtDeleteImage'];
            $this->deleteImage($fileDelete);
            $filename = null;
        }
        // upload new image if exists
        if (isset($input['txtFile']) && !empty($input['txtFile'])) {
            $file      = $input['txtFile'];
            $newFile   = changeFileName($file->getClientOriginalName());
            $file->move($this->_pathImage, $newFile);
            if (!empty($this->_resize)) {
                foreach ($this->_resize as $k => $v) {
                    $outPutFile = $v[0].'x'.$v[1].'_'.$newFile; 
                    resizeImage($this->_pathImage,$this->_pathStore,$newFile,$outPutFile,$v[0],$v[1]);
                }
            }
            $filename  = forderStore().'/'.$newFile;
        }
        // update data with orm
        $s = Supplier::find($id);
        $s->update([
            'dt_buyer_id'   => $input['sltBuyer'],
            'name'          => $input['txtSupplier'],
            'short_desc'    => $input['txtShort'],
            'long_desc'     => $input['txtLong'],
            'address'       => $input['txtAddress'],
            'filename'      => $filename
        ]);
        // Delete brand if exists
        if (isset($input['txtDeleteBrand']) && !empty($input['txtDeleteBrand'])) {
            foreach ($input['txtDeleteBrand'] as $key => $brandId) {
                $s->brand()->detach([$id,$brandId]);
            }
        }
        // attach dt_supplier_brand_buyer
        if (isset($input['brand_id']) && !empty($input['brand_id'])) {
            foreach ($input['brand_id'] as $key => $value) {
                $brand = $s->brand()->where('dt_supplier_id',$id)->where('dt_brand_id',$value)->first();
                if (is_null($brand)) {
                    $s->brand()->attach($id,['dt_brand_id' => $value]);
                }
            }
        }
        return Redirect()->route('admin_shop.supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $supplier = Supplier::findOrfail($id);
        $supplier->delete();
        $supplier->brand()->detach($id);
        $this->deleteImage($supplier->filename);
        return Redirect()->route('admin_shop.supplier.index');
        // echo "OK";
    }

    /**
    |------------------------------------------------------------------------
    | Function Delete images product
    |-------------------------------------------------------------------------
    */
    private function deleteImage($fileDelete ) {
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
    }


}
