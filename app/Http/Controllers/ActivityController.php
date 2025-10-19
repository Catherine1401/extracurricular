<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Dashboard - Hiển thị tất cả activities của toàn bộ user
        $activities = Activity::with(['category', 'organization'])->paginate(10);
        return view('activities.index', compact('activities'));
    }
    
    public function myActivities()
    {
        /** @var User $user */
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin xem tất cả activities
            $activities = Activity::with(['category', 'organization'])->paginate(10);
        } else {
            // Organization chỉ xem activities của mình
            $activities = Activity::with(['category', 'organization'])
                ->where('organization_id', $user->id)
                ->paginate(10);
        }
        
        return view('activities.my', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /** @var User $user */
        $user = Auth::user();
        
        // Chỉ organization mới có thể tạo activities
        if (!$user->isOrganization()) {
            abort(403, 'Bạn không có quyền tạo hoạt động');
        }
        
        $categories = Category::all();
        return view('activities.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        
        // Chỉ organization mới có thể tạo activities
        if (!$user->isOrganization()) {
            abort(403, 'Bạn không có quyền tạo hoạt động');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'points' => 'required|integer|min:0|max:20',
            'type' => 'required|integer|in:1,2,3',
            'category_id' => 'required|exists:categories,id',
            'start_at' => 'required|date|before:end_at',
            'end_at' => 'required|date|after:start_at',
        ]);

        $data = $request->only([
            'title',
            'content',
            'link',
            'points',
            'type', 
            'category_id',
            'start_at',
            'end_at',
        ]);
        
        // Organization tự động gán organization_id
        $data['organization_id'] = $user->id;

        Activity::create($data);

        return redirect()->route('activities.my');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        // Tất cả user đều có thể xem activities (read-only)
        $activity->load(['category', 'organization']);
        return view('activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        /** @var User $user */
        $user = Auth::user();
        
        // Chỉ admin và organization sở hữu activity mới có thể edit
        if (!$user->isAdmin() && (!$user->isOrganization() || $activity->organization_id !== $user->id)) {
            abort(403, 'Bạn không có quyền chỉnh sửa hoạt động này');
        }
        
        $categories = Category::all();
        return view('activities.edit', compact('activity', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        /** @var User $user */
        $user = Auth::user();
        
        // Chỉ admin và organization sở hữu activity mới có thể update
        if (!$user->isAdmin() && (!$user->isOrganization() || $activity->organization_id !== $user->id)) {
            abort(403, 'Bạn không có quyền cập nhật hoạt động này');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'points' => 'required|integer|min:0|max:20',
            'type' => 'required|integer|in:1,2,3',
            'category_id' => 'required|exists:categories,id',
            'start_at' => 'required|date|before:end_at',
            'end_at' => 'required|date|after:start_at',
        ]);

        $data = $request->only([
            'title',
            'content',
            'link',
            'points',
            'type', 
            'category_id',
            'start_at',
            'end_at',
        ]);
        
        // Organization giữ nguyên organization_id
        if ($user->isOrganization()) {
            $data['organization_id'] = $user->id;
        }

        $activity->update($data);

        return redirect()->route('activities.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        /** @var User $user */
        $user = Auth::user();
        
        // Chỉ admin và organization sở hữu activity mới có thể delete
        if (!$user->isAdmin() && (!$user->isOrganization() || $activity->organization_id !== $user->id)) {
            abort(403, 'Bạn không có quyền xóa hoạt động này');
        }
        
        $activity->delete();
        return redirect()->route('activities.index');
    }
}
