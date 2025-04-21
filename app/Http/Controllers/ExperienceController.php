<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Resume;
use Illuminate\Http\Request;

class ExperienceController extends Controller
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

        return view('experience.create', compact('resume'));
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
            'company' => 'required|max:255',
            'position' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable',
            'location' => 'nullable|max:255',
        ]);

        $resume = Resume::findOrFail($validated['resume_id']);

        // Проверяем, принадлежит ли резюме текущему пользователю
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $experience = new Experience($validated);
        $resume->experiences()->save($experience);

        return redirect()->route('resume.show', $resume->id)
            ->with('success', 'Информация о месте работы успешно добавлена!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit($id)
    {
        $experience = Experience::findOrFail($id);
        $resume = $experience->resume;

        // Проверяем, принадлежит ли резюме текущему пользователю
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('experience.edit', compact('experience', 'resume'));
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
        $experience = Experience::findOrFail($id);
        $resume = $experience->resume;

        // Проверяем, принадлежит ли резюме текущему пользователю
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'company' => 'required|max:255',
            'position' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable',
            'location' => 'nullable|max:255',
        ]);

        $experience->update($validated);

        return redirect()->route('resume.show', $resume->id)
            ->with('success', 'Информация о месте работы успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $experience = Experience::findOrFail($id);
        $resume = $experience->resume;

        // Проверяем, принадлежит ли резюме текущему пользователю
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $experience->delete();

        return redirect()->route('resume.show', $resume->id)
            ->with('success', 'Информация о месте работы успешно удалена!');
    }
}
