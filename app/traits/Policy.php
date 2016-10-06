<?php

namespace app\traits;


trait Policy
{

    public static function isAdmin()
    {
        return !!$_SESSION['logged'];
    }
}