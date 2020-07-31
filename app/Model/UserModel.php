<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    public $table="user";   //表名
    protected $primaryKey="uid";  //声明表字段
}
