<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class RoleMiddleware
{
    public function handle(Request $request)
    {
//Если пользователь не админ, то редирект на страницу сотрудника
        if (!Auth::checkRole()) {
            app()->route->redirect('/admin');
        }
    }
}
