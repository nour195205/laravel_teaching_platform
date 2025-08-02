<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::latest()->get();
        return view('materials.index', compact('materials'));
    }

    public function create()
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        return view('materials.create');
    }

    public function store(Request $request)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'grade' => 'required|in:first,second,third',
            'file' => 'required|file|mimes:pdf,docx,zip',
        ]);

        $filePath = $request->file('file')->store('materials', 'public');

        Material::create([
            'title' => $request->title,
            'description' => $request->description,
            'grade' => $request->grade,
            'file' => $filePath,
        ]);

        return redirect()->route('materials.index')->with('success', 'تم رفع الملازم بنجاح');
    }

    public function show(Material $material)
    {
        return view('materials.show', compact('material'));
    }

    public function destroy(Material $material)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        Storage::disk('public')->delete($material->file);
        $material->delete();

        return redirect()->route('materials.index')->with('success', 'تم حذف الملف');
    }

    public function edit($id)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        $material = Material::findOrFail($id);
        return view('materials.edit', compact('material'));
    }

    // تنفيذ التحديث
    public function update(Request $request, $id)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        $material = Material::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'grade' => 'required|in:first,second,third',
            'file' => 'nullable|file|mimes:pdf,docx,zip,jpg,png,mp4,avi|max:10240', // 10MB max
        ]);

        $data = $request->only(['title', 'description', 'grade']);

        // لو فيه ملف مرفوع جديد
        if ($request->hasFile('file')) {
            // حذف القديم لو موجود
            if ($material->file) {
                Storage::delete('public/' . $material->file);
            }

            $path = $request->file('file')->store('materials', 'public');
            $data['file'] = $path;
        }

        $material->update($data);

        return redirect()->route('materials.index')->with('success', 'تم تحديث الملازم بنجاح.');
    }

    public function dashboard()
{
    if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/lessons')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
    $materials = Material::latest()->get();
    return view('dashboard.materials.index', compact('materials'));
}

}
