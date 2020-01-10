<?php


namespace App\Helpers\Facades;


use Illuminate\Support\Facades\Facade;

class ACL extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'acl';
    }
}
