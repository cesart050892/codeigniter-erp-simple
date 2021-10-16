<?php

use App\Models\Rols;

function validate_access($access, $user)
{
    if (!is_array($access))
        return false;

    $model = new Rols();
    $rol = $model->find($user->rol_id);
    if (!in_array($rol->rol, $access))
        return false;

    return true;
}
