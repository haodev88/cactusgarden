<?php

namespace App\Http\Controllers\shop;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Http\Requests\shop\ContactRequest;
use App\cactus\Breadcrumb;
use URL;

class ContactController extends Controller {

    public function getContact() {
        $data["breadcrumb"]["items"] = [
            [
                'url'   => URL::to('/'),
                'label' => 'Trang chủ'
            ],
            [
                'url'   => '',
                'label' => 'Liên hệ'
            ]
        ];
        $data["breadcrumb"]["title"] = "Liên hệ";
        $data["breadcrumb"]["bg"]    = Breadcrumb::getBreadcrumb();
        return view('cactus.contact', $data);
    }

    public function postContact(ContactRequest $request) {
        $input   = $request->all();
        $contact = Contact::create([
            'name'      => $input['name'],
            'email'     => $input['email'],
            'phone'     => $input['phone'],
            'content'   => strip_tags($input['content']),
            'subject'   => strip_tags($input['subject'])
        ]);
        if ($contact) {
            return Redirect()->route('contact')->with('successMessage', 'Thông tin liên hệ của bạn được gửi thành công, chúng tôi sẽ trả lời bạn trong thời gian sớm nhất.');
        } else {
            return Redirect()->route('contact');
        }
    }
}
