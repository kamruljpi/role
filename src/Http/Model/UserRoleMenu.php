<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\ProjectModel;

class UserRoleMenu extends ProjectModel
{
    protected $table = "user_role_menus";
    protected $primaryKey = "id_user_role_menu";
}