<?php
namespace Controller;
use Model\User;
use Src\View;
use Src\Request;

class Admin {
    public function admin(Request $request): string
    {
        if ($request->method === 'POST' && User::create($request->all())) {
            app()->route->redirect('/admin');
        }
        return new View('site.admin');
    }
}