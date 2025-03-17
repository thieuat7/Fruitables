<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAllUsers()
    {
        $users = $this->userService->getAllUsers();
        return view('admin.users.show', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function detailUser($id){
        $user=$this->userService->getUserById($id);
        if(!$user){
            return null;
        }
        return view('admin.users.detail', compact('user'));
    }

    public function handleCreateUser(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users,user_email',
            'user_password' => 'required|min:6',
            'user_phone' => 'nullable|string|max:20',
            'user_address' => 'nullable|string|max:255',
            'user_avatar' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        // Gọi Service để tạo user
        $this->userService->handleCreateUser($request->all());

        return redirect('/admin/user')->with('success', 'User created successfully!');
    }

    // Hiển thị form chỉnh sửa
    public function updateUser($id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }

        return view('admin.users.update', compact('user'));
    }

    public function deleteUser($id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }

        return view('admin.users.delete', compact('user'));
    }

    // Xử lý cập nhật
    public function handleUpdateUser(Request $request, $id)
    {

        // Validate dữ liệu
        $validatedData = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users,user_email,' . $id,
            'user_phone' => 'nullable|string|max:20',
            'user_address' => 'nullable|string|max:255',
            'user_avatar' => 'nullable|image|mimes:jpg,jpeg,png',
            'user_role' => 'required|in:1,2,3', // Kiểm tra giá trị hợp lệ cho user_role (1: ADMIN, 2: SHIPPED, 3: USER)
        ]);


        // Cập nhật thông tin người dùng qua Service
        $this->userService->handleUpdateUser($id, $validatedData);

        return redirect('/admin/user')->with('success', 'User created successfully!');
    }

    public function handleDeleteUser($id)
    {
        // Cập nhật thông tin người dùng qua Service
        $this->userService->deleteByUser($id);

        return redirect('/admin/user')->with('success', 'User created successfully!');
    }

}