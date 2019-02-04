<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create() {
        return view('user');
    }
    public function index() {
      $users = User::all();   
      return $users;
    }
}
