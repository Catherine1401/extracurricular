<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        
        // Chỉ admin mới có thể quản lý users
        if (!$user->isAdmin()) {
            abort(403, 'Bạn không có quyền quản lý người dùng');
        }
        
        $query = User::query();
        
        // Tìm kiếm
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('email', 'like', "%{$searchTerm}%");
            });
        }
        
        $users = $query->paginate(15)->withQueryString();
        
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /** @var User $user */
        $user = Auth::user();
        
        // Chỉ admin mới có thể tạo users
        if (!$user->isAdmin()) {
            abort(403, 'Bạn không có quyền tạo người dùng');
        }
        
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        
        // Chỉ admin mới có thể tạo users
        if (!$user->isAdmin()) {
            abort(403, 'Bạn không có quyền tạo người dùng');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,organization,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Người dùng đã được tạo thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();
        
        // Chỉ admin mới có thể xem chi tiết users
        if (!$currentUser->isAdmin()) {
            abort(403, 'Bạn không có quyền xem thông tin người dùng');
        }
        
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();
        
        // Chỉ admin mới có thể edit users
        if (!$currentUser->isAdmin()) {
            abort(403, 'Bạn không có quyền chỉnh sửa người dùng');
        }
        
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();
        
        // Chỉ admin mới có thể update users
        if (!$currentUser->isAdmin()) {
            abort(403, 'Bạn không có quyền cập nhật người dùng');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,organization,user',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Chỉ cập nhật password nếu có
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Người dùng đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();
        
        // Chỉ admin mới có thể xóa users
        if (!$currentUser->isAdmin()) {
            abort(403, 'Bạn không có quyền xóa người dùng');
        }
        
        // Không cho phép xóa chính mình
        if ($user->id === $currentUser->id) {
            return redirect()->route('users.index')->with('error', 'Bạn không thể xóa chính mình!');
        }
        
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Người dùng đã được xóa thành công!');
    }
}