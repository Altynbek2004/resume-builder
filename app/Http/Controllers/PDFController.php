<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    /**
     * Generate PDF file from resume data
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($id)
    {
        $resume = Resume::with(['educations', 'experiences', 'skills'])->findOrFail($id);

        // Проверяем, принадлежит ли резюме текущему пользователю
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $pdf = PDF::loadView('pdf.resume', compact('resume'));

        return $pdf->download('resume_' . $resume->id . '.pdf');
    }

    /**
     * Preview PDF file in browser
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function previewPDF($id)
    {
        $resume = Resume::with(['educations', 'experiences', 'skills'])->findOrFail($id);

        // Проверяем, принадлежит ли резюме текущему пользователю
        if ($resume->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $pdf = PDF::loadView('pdf.resume', compact('resume'));

        return $pdf->stream('resume_preview.pdf');
    }
}
