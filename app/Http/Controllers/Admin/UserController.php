<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

        $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = $this->userService->listUsers(
                $request->get('search')['value'] ?? null,
                $request->get('order')[0]['column'] ?? 'name',
                $request->get('order')[0]['dir'] ?? 'asc',
                $request->get('length') ?? 10
            );

            return response()->json([
                'data' => $users->items(),
                'recordsTotal' => $users->total(),
                'recordsFiltered' => $users->total(),
            ]);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        $this->userService->createUser($request->all());

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = $this->userService->findUserById($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        $this->userService->updateUser($id, $request->all());

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
