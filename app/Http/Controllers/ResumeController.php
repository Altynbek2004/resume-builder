<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $resumes = auth()->user()->resumes;

        return view('dashboard', compact('resumes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        // Проверяем, есть ли уже резюме у пользователя
//        if (auth()->user()->resumes) {
//            return redirect()->route('resume.edit', auth()->user()->resume->id)
//                ->with('info', 'У вас уже есть резюме. Вы можете его отредактировать.');
//        }

        return view('resume.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'full_name' => 'required|max:255',
            'phone' => 'required|max:20',
            'email' => 'required|email',
            'about' => 'nullable',
            'position' => 'nullable|max:255',
            'address' => 'required|max:255',
            'photo' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request->file('photo')->store('images/Avatars', 'public');
        }

        // Удаляем фото из валидированных данных, так как мы храним путь
        unset($validated['photo']);


        $resume = new Resume($validated);

        auth()->user()->resumes()->save($resume);

        return redirect()->route('resume.show', $resume->id)
            ->with('success', 'Резюме успешно создано!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show($id)
    {
        $resume = Resume::with(['educations', 'experiences', 'skills'])->findOrFail($id);

        // Проверяем, принадлежит ли резюме текущему пользователю
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('resume.show', compact('resume'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit($id)
    {
        $resume = Resume::findOrFail($id);

        // Проверяем, принадлежит ли резюме текущему пользователю
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('resume.edit', compact('resume'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $resume = Resume::findOrFail($id);

        // Проверяем, принадлежит ли резюме текущему пользователю
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'full_name' => 'required|max:255',
            'phone' => 'required|max:20',
            'email' => 'required|email',
            'about' => 'nullable',
            'position' => 'nullable|max:255',
            'address' => 'required|max:255',
            'photo' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            // Удаляем старое фото, если оно было
            if ($resume->photo_path) {
                Storage::disk('public')->delete($resume->photo_path);
            }

            $validated['photo_path'] = $request->file('photo')->store('photos', 'public');
        }

        // Удаляем фото из валидированных данных, так как мы храним путь
        unset($validated['photo']);

        $resume->update($validated);

        return redirect()->route('resume.show', $resume->id)
            ->with('success', 'Резюме успешно обновлено!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $resume = Resume::findOrFail($id);

        // Проверяем, принадлежит ли резюме текущему пользователю
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Удаляем фото, если оно было
        if ($resume->photo_path) {
            Storage::disk('public')->delete($resume->photo_path);
        }

        $resume->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Резюме успешно удалено!');
    }
}

