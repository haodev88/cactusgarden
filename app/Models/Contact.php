<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {
    protected $table    = 'dt_contacts';
    protected $guarded  = array('id');
}
