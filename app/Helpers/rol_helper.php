<?php

use App\Models\Rols;
use App\Models\Users;

function validate_access($access, $user)
{
    if (!is_array($access))
        return false;
    $userModel = new Users();
    $user = $userModel->find($user);
    $rolModel = new Rols();
    $rol = $rolModel->find($user->rol_id);
    $rol = $rol->rol;
    if (!in_array($rol, $access))
        return false;

    return true;
}
