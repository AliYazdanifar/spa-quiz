<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Inertia\Inertia;
class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('choices')->get();
        return Inertia::render('Questions/Index', ['questions' => $questions]);
    }

    public function create()
    {
        return Inertia::render('Questions/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_text' => 'required|string',
            'choices' => 'required|array|min:2',
            'choices.*.choice_text' => 'required|string',
            'choices.*.is_correct' => 'required|boolean',
        ]);

        $question = Question::create(['question_text' => $request->question_text]);

        foreach ($request->choices as $choice) {
            $question->choices()->create($choice);
        }

        return redirect()->route('questions.index')->with('success', 'Question created successfully');
    }

    public function edit(Question $question)
    {
        return Inertia::render('Questions/Edit', ['question' => $question->load('choices')]);
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question_text' => 'required|string',
            'choices' => 'required|array|min:2',
            'choices.*.choice_text' => 'required|string',
            'choices.*.is_correct' => 'required|boolean',
        ]);

        $question->update(['question_text' => $request->question_text]);
        $question->choices()->delete();

        foreach ($request->choices as $choice) {
            $question->choices()->create($choice);
        }

        return redirect()->route('questions.index')->with('success', 'Question updated successfully');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted successfully');
    }
}
