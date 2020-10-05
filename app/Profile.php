<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = array('id');

    // 以下を追記
    public static $rules = array(
        'shimei' => 'required',
        'gender' => 'required',
        'syumi' => 'required',
        'jikosyoukai' => 'required',

    );

    public function histories()
    {
      return $this->hasMany('App\History');

    }

}
