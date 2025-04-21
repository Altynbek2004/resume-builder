<?php


namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Resume;
use Illuminate\Http\Request;

class SkillController extends Controller
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

        return view('skill.create', compact('resume'));
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
            'name' => 'required|max:255',
            'level' => 'nullable|max:255',
        ]);

        $resume = Resume::findOrFail($validated['resume_id']);

        // Проверяем, принадлежит ли резюме текущему пользователю
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $skill = new Skill($validated);
        $resume->skills()->save($skill);

        return redirect()->route('resume.show', $resume->id)
            ->with('success', 'Навык успешно добавлен!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit($id)
    {
        $skill = Skill::findOrFail($id);
        $resume = $skill->resume;

        // Проверяем, принадлежит ли резюме текущему пользователю
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('skill.edit', compact('skill', 'resume'));
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
        $skill = Skill::findOrFail($id);
        $resume = $skill->resume;

        // Проверяем, принадлежит ли резюме текущему пользователю
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|max:255',
            'level' => 'nullable|max:255',
        ]);

        $skill->update($validated);

        return redirect()->route('resume.show', $resume->id)
            ->with('success', 'Навык успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $resume = $skill->resume;

        // Проверяем, принадлежит ли резюме текущему пользователю
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $skill->delete();

        return redirect()->route('resume.show', $resume->id)
            ->with('success', 'Навык успешно удален!');
    }
}
