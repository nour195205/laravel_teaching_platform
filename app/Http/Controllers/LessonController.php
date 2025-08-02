<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;



class LessonController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            // مش مسجل دخول
            $lessons = collect(); // مجموعة فاضية
            $message = "يجب تسجيل الدخول لرؤية الدروس.";
        } elseif ($user->role === 'student') {
            // طالب: نعرض الدروس الخاصة بالسنة بتاعته
            $lessons = Lesson::where('grade', $user->grade)->latest()->get();
            $message = null;
        } else {
            // غير طالب: مثلا أدمن أو مدرس
            $lessons = Lesson::latest()->get();
            $message = null;
        }

        return view('lessons.index', compact('lessons', 'message'));
    }

    public function show($id)
    {
        $lesson = Lesson::findOrFail($id);
        $user = auth()->user();

        // لو المستخدم طالب
        if ($user && $user->role === 'student') {
            // لو سنة الطالب مختلفة عن سنة الدرس
            if ($lesson->grade !== $user->grade) {
                abort(403, 'غير مصرح لك بعرض هذا الدرس.');
            }
        }

        return view('lessons.show', compact('lesson'));
    }

    public function create()
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        return view('lessons.create');
    }


    public function store(Request $request)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'grade' => 'required|in:first,second,third,fourth,fifth,sixth',
            'video_url' => 'required|url',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,zip|max:20480',
        ]);

        $data = $request->all();

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('attachments', $filename, 'public');
            $data['attachment'] = $path;
        }

        Lesson::create($data);

        return redirect()->route('lessons.index')->with('success', 'تم إضافة الدرس بنجاح.');
    }



    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'grade' => 'required|in:first,second,third,fourth,fifth,sixth',
    //         'video_url' => 'required|url',
    //         'attachment' => 'nullable|file|mimes:pdf,doc,docx,zip|max:20480', // 20MB max
    //     ]);

    //     $data = $request->all();

    //     if ($request->hasFile('attachment')) {
    //         $file = $request->file('attachment');
    //         $filename = time() . '_' . $file->getClientOriginalName();
    //         $path = $file->storeAs('attachments', $filename, 'public');
    //         $data['attachment'] = $path;
    //     }

    //     Lesson::create($data);

    //     return redirect()->route('lessons.index')->with('success', 'تم إضافة الدرس بنجاح.');
    // }

    public function edit($id)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        $lesson = Lesson::findOrFail($id);

        if (auth()->user()->role !== 'admin') {
            abort(403, 'غير مصرح لك.');
        }

        return view('lessons.edit', compact('lesson'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'grade' => 'required|in:first,second,third,fourth,fifth,sixth',
            'video_url' => 'required|url',
            'attachment' => 'nullable|file|max:10240', // 10MB max
        ]);

        $data = $request->only(['title', 'description', 'grade', 'video_url']);

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        $lesson->update($data);

        return redirect()->route('lessons.index')->with('success', 'تم تحديث الدرس بنجاح.');
    }


    public function destroy($id)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        $lesson = Lesson::findOrFail($id);

        if (auth()->user()->role !== 'admin') {
            abort(403, 'غير مصرح لك.');
        }

        $lesson->delete();

        return redirect()->route('dashboard')->with('success', 'تم حذف الدرس.');
    }

    public function dashboard()
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        $lessonsByGrade = Lesson::all()->groupBy('grade');
        return view('dashboard.lessons', compact('lessonsByGrade'));
    }



}
