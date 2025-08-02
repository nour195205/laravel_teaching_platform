<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{

    // عرض الامتحانات للطالب حسب سنته والحالة والوقت
    public function index()
    {
        $user = Auth::user();
        $now = now();

        $exams = Exam::where('grade', $user->grade)
            ->where('is_active', true)
            ->where(function ($query) use ($now) {
                $query->whereNull('start_time')->orWhere('start_time', '<=', $now);
            })
            ->where(function ($query) use ($now) {
                $query->whereNull('end_time')->orWhere('end_time', '>=', $now);
            })
            ->latest()
            ->get();

        return view('exams.index', compact('exams'));
    }

    // عرض تفاصيل امتحان محدد
    public function show($id)
    {
        $exam = Exam::findOrFail($id);
        $user = Auth::user();
        $now = now();

        if ($user->role === 'student') {
            if (
                $exam->grade !== $user->grade ||
                !$exam->is_active ||
                ($exam->start_time && $exam->start_time > $now) ||
                ($exam->end_time && $exam->end_time < $now)
            ) {
                abort(403, 'الامتحان غير متاح حالياً.');
            }
        }

        return view('exams.show', compact('exam'));
    }

    // لوحة التحكم – كل الامتحانات
    public function dashboard()
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        $exams = Exam::latest()->get();
        return view('dashboard.exams.index', compact('exams'));
    }

    // صفحة إنشاء امتحان
    public function create()
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        return view('exams.create');
    }

    // حفظ امتحان جديد
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
            'end_time' => 'nullable|date',
            'is_active' => 'sometimes|boolean', // ✅ ده الصح
        ]);


        Exam::create($request->all());

        return redirect()->route('exams.index')->with('success', 'تم إضافة الامتحان بنجاح.');
    }

    // صفحة تعديل امتحان
    public function edit($id)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        $exam = Exam::findOrFail($id);
        return view('exams.edit', compact('exam'));
    }

    // تعديل وحفظ الامتحان
    public function update(Request $request, $id)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        $exam = Exam::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'grade' => 'required|in:first,second,third,fourth,fifth,sixth',
            'embed_code' => 'required|string',
            'is_active' => 'required|boolean',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
        ]);

        $exam->update($request->all());

        return redirect()->route('exams.index')->with('success', 'تم تحديث الامتحان بنجاح.');
    }

    public function destroy($id)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        $exam = Exam::findOrFail($id);
        $exam->delete();

        return redirect()->route('dashboard.exams.index')->with('success', 'تم حذف الامتحان بنجاح.');
    }

}
