<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Resume;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create(Request $request)
    {
        $resume = Resume::findOrFail($request->resume);


        // Проверяем, принадлежит ли резюме текущему пользователю
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('education.create', compact('resume'));
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
            'resume_id' => 'required|exists:resumes,id',
            'institution' => 'required|max:255',
            'degree' => 'required|max:255',
            'field_of_study' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable',
        ]);

        $resume = Resume::findOrFail($validated['resume_id']);

        // Проверяем, принадлежит ли резюме текущему пользователю
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $education = new Education($validated);
        $resume->educations()->save($education);

        return redirect()->route('resume.show', $resume->id)
            ->with('success', 'Информация об образовании успешно добавлена!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit($id)
    {
        $education = Education::findOrFail($id);
        $resume = $education->resume;

        // Проверяем, принадлежит ли резюме текущему пользователю
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('education.edit', compact('education', 'resume'));
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
        $education = Education::findOrFail($id);
        $resume = $education->resume;

        // Проверяем, принадлежит ли резюме текущему пользователю
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'institution' => 'required|max:255',
            'degree' => 'required|max:255',
            'field_of_study' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable',
        ]);

        $education->update($validated);

        return redirect()->route('resume.show', $resume->id)
            ->with('success', 'Информация об образовании успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $education = Education::findOrFail($id);
        $resume = $education->resume;

        // Проверяем, принадлежит ли резюме текущему пользователю
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $education->delete();

        return redirect()->route('resume.show', $resume->id)
            ->with('success', 'Информация об образовании успешно удалена!');
    }
}
