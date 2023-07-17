<?php


use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;


/**
 * @return Authenticatable|null
 */
function getAddedUserName($added_by)
{

    $all_users = User::select('name')->where('id',$added_by)->get();
    return $all_users[0]->name;
}

function getTaskStatus($status)
{
    if($status==1)
    {
        return "Completed";
    }
    else
    {
        return "Pending";
    }
    
}




