<?php
namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    // عرض الاجتماعات للطلاب حسب الصف الدراسي
    public function index()
    {
        $user = auth()->user();

        $IsActive = Meeting::all();;

        $meetings = Meeting::where('grade', $user->grade)
            ->where(function ($query) {
                $query->whereNull('start_time')
                    ->orWhere('start_time', '<=', now());
            })
            ->latest()
            ->get(); // <-- هنا خليها Collection مش array

        return view('meetings.index', compact('meetings') , ['IsActive' => $IsActive]);
    }

    // عرض صفحة اجتماع واحد
    public function show($id)
    {
        $meeting = Meeting::findOrFail($id);
        $user = Auth::user();

        if ($user->role === 'student' && $user->grade !== $meeting->grade) {
            abort(403, 'غير مصرح لك بحضور هذا الاجتماع.');
        }

        return view('meetings.show', compact('meeting'));
    }

    // لوحة التحكم - عرض كل الاجتماعات
    public function dashboard()
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        $meetings = Meeting::orderBy('start_time', 'desc')->get();
        return view('dashboard.meetings.index', compact('meetings'));
    }

    // صفحة إنشاء اجتماع
    public function create()
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        return view('meetings.create');
    }

    // حفظ اجتماع جديد
    public function store(Request $request)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'grade' => 'required|in:first,second,third,fourth,fifth,sixth',
            'embed_code' => 'required|string',
            'start_time' => 'nullable|date',
            'is_active' => 'sometimes|boolean',
        ]);

        Meeting::create($request->all());

        return redirect()->route('dashboard.meetings.index')->with('success', 'تم إضافة الاجتماع بنجاح');
    }

    // صفحة تعديل اجتماع
    public function edit($id)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        $meeting = Meeting::findOrFail($id);
        return view('meetings.edit', compact('meeting'));
    }

    // تحديث الاجتماع
    public function update(Request $request, Meeting $meeting)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'grade' => 'required|in:first,second,third,fourth,fifth,sixth',
            'embed_code' => 'required|string',
            'start_time' => 'nullable|date',
            'is_active' => 'sometimes|boolean',
        ]);

        $meeting->update($request->all());

        return redirect()->route('dashboard.meetings.index')->with('success', 'تم تحديث الاجتماع بنجاح');
    }

    // حذف الاجتماع
    public function destroy($id)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        $meeting = Meeting::findOrFail($id);
        $meeting->delete();

        return redirect()->route('dashboard.meetings.index')->with('success', 'تم حذف الاجتماع');
    }
}
