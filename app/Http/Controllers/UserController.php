<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    protected $users;

    public function __construct(UserRepositoryInterface $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        $users = $this->users->all();
        return view('backend.users.index', compact('users'));   
    }

    public function show($id)
    {
        return $this->users->find($id);
    }

    public function create(){
        return view('backend.users.create');
    }

    public function store(Request $request){
        try {
            $validatedData = $request->validate([]);
            } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
