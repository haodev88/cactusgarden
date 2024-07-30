<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
// use Illuminate\Routing\Route;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Province;
use App\Http\Requests\cms\CustomerRequest;


class CustomerController extends Controller {

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
        $data["listCustomer"] = Customer::orderBy('id','DESC')->paginate($this->_rowperpage);
        $data['stt'] = $stt;
        return view('cms.customer.list',$data);
    }

    public function search(Request $request) {
        $input    = $request->all();
        $customer = new Customer();
        if (isset($input['name']) && $input['name']!='') {
            $customer  = $customer->where('name','LIKE','%'.$input['name'].'%');
        }
        if (isset($input['email']) && $input['email']!='') {
            $customer = $customer->where('email','LIKE','%'.$input['email'].'%');
        }
        if (isset($input['phone']) && $input['phone']!='') {
            $customer = $customer->where('phone','LIKE','%'.$input['phone'].'%');
        }
        if (isset($input['date']) && $input['date']!='') {
            $date = convertDate($input['date']);
            $customer = $customer->where('created_at','LIKE','%'.$date.'%');
        }
        $data['input']        = $input;
        $stt    = isset($input["page"]) ? ($input['page']-1)*$this->_rowperpage : 0;
        $data["listCustomer"] = $customer->orderBy('id','DESC')->paginate($this->_rowperpage);
        $data['stt'] = $stt;
        return view('cms.customer.list',$data);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data['province'] = Province::all();
        return view('cms.customer.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request) {
        $input    = $request->all();
        Customer::create([
            'dt_provinceid' => isset($input['sltCity']) ? $input['sltCity'] : 0,
            'dt_districtid' => isset($input['sltDistrict']) ? $input['sltDistrict'] : 0,
            'dt_wardid'     => isset($input['sltWard']) ? $input['sltWard'] : 0,
            'name'          => $input['txtName'],
            'address'       => $input['txtAddress'],
            'email'         => $input['txtEmail'],
            'password'      => bcrypt($input['txtPassword']),
            'phone'         => $input['txtPhone'],
            'birthday'      => ($input['txtBirthday']!="") ? convertDate($input['txtBirthday']) : ''
        ]);
        return Redirect()->route('admin_shop.customer.index');
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
        $data['customer'] = Customer::findorFail($id);
        $data['province'] = Province::all();
        return view('cms.customer.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id) {
        $input    = $request->all();
        $customer = Customer::find($id);
        if ($customer) {
            $data = [
                'dt_provinceid' => isset($input['sltCity']) ? $input['sltCity'] : 0,
                'dt_districtid' => isset($input['sltDistrict']) ? $input['sltDistrict'] : 0,
                'dt_wardid'     => isset($input['sltWard']) ? $input['sltWard'] : 0,
                'name'          => $input['txtName'],
                'address'       => $input['txtAddress'],
                'email'         => $input['txtEmail'],
                'phone'         => $input['txtPhone'],
                'birthday'      => ($input['txtBirthday']!="") ? convertDate($input['txtBirthday']) : ''
            ];
            if (isset($input['txtPassword']) && $input['txtPassword']!='') {
                $data['password'] = bcrypt($input['txtPassword']);
            }
            $customer->update($data);
        }
        return Redirect()->route('admin_shop.customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $customer = Customer::findOrfail($id);
        if ($customer) {
            $customer->delete();
        }
        return Redirect()->route('admin_shop.customer.index');
    }
}
