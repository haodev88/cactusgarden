<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Http\Requests\cms\BuyerRequest;


class BuyerController extends Controller {
    
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
        $res    = Buyer::paginate($this->_rowperpage);
        $data['listBuyer'] = $res;
        $input  = $request->all();
        $stt    = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0; 
        $data['stt'] = $stt;
        return view('cms.buyer.list',$data);
    }

    /**
     * Display data of search.
     */
    public function search(Request $request) {
        $input = $request->all();
        $buyer = new Buyer();
        if (isset($input['buyername']) && $input['buyername']!='') {
            $buyer = $buyer->where('name','like','%'.$input['buyername'].'%');
        } if (isset($input['email']) && $input['email']!='') {
            $buyer = $buyer->where('email','like','%'.$input['email'].'%');
        }
        $res = $buyer->paginate($this->_rowperpage);
        $data['listBuyer'] = $res;
        $input  = $request->all();
        $stt    = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0; 
        $data['stt']    = $stt;
        $data['append'] = [
            'buyername' => $input['buyername'],
            'email'     => $input['email']
        ];
        return view('cms.buyer.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('cms.buyer.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BuyerRequest $request) {
        $input = $request->all();
        Buyer::create([
            'name'      =>  $input['txtName'],
            'email'     =>  $input['txtEmail'],
            'address'   =>  $input['txtAddress'],
            'phone'     =>  $input['txtPhone']
        ]);
        return Redirect()->Route('admin_shop.buyer.index');
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
        $data['buyer'] = Buyer::findOrfail($id)->toArray();
        return view('cms.buyer.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BuyerRequest $request, $id) {
        $input = $request->all();
        Buyer::findOrfail($id)->update([
            'name'      =>  $input['txtName'],
            'email'     =>  $input['txtEmail'],
            'address'   =>  $input['txtAddress'],
            'phone'     =>  $input['txtPhone']
        ]);
        return Redirect()->route('admin_shop.buyer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Buyer::findOrfail($id)->delete();
        return Redirect()->route('admin_shop.buyer.index');
    }
}
