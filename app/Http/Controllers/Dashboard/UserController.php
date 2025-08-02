<?php


namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // ✅ عرض كل المستخدمين
    public function index()
    {

        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        $users = User::latest()->get();
        return view('dashboard.users.index', compact('users'));
    }

    // ✅ حذف مستخدم
    public function destroy(User $user)
    {
        // منع الأدمن من حذف نفسه
        if (auth()->id() === $user->id) {
            return back()->with('error', 'لا يمكنك حذف نفسك.');
        }

        $user->delete();

        return redirect()->route('dashboard.users.index')->with('success', 'تم حذف المستخدم.');
    }

    // عرض صفحة تعديل المستخدم
    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    // حفظ التعديل
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
            'phone' => 'nullable|string|max:20',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_phone' => 'nullable|string|max:20',
            'grade' => 'nullable|in:first,second,third,fourth,fifth,sixth',
            'role' => 'required|in:student,admin,teacher'
        ]);

        $user->update($request->all());

        return redirect()->route('dashboard.users.index')->with('success', 'تم تحديث بيانات المستخدم بنجاح.');
    }

}

