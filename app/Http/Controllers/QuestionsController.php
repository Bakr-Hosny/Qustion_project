<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Questions\QuestionsCategory;
use App\Models\Subject;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{

    public $qType; // كمي - لفظي
    public $categories; // كمي - لفظي


    public function __construct()
    {

        $this->qType = request('type');
    }

    public function questionCategories()
    {
        return QuestionsCategory::where('type', $this->qType)->get(['id', 'name', 'type']);
    }



    public function index()
    {
        return Question::all();
    }

     public function create()
    {

        // if ($this->qType != null) {

        //     if (!in_array($this->qType, questionTypes())) {
        //         return redirect(route('questions.create'));
        //     }
        // }

        // return view('dashboard.questions.create', [
        //     'pageTitle' => 'اضافة سؤال جديد',
        //     'qType' => $this->qType,
        //     'categories' => $this->questionCategories(),
        // ]);

        $subjects = Subject::all();
        return view('dashboard.questions.create', compact('subjects'));
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            //'type' => 'required|in:لفظئ,كمي',
            'question' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'correct_answer' => 'required|string',
            'explane_answer' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        if ($request->type == 'multiple_choice') {
            $data['options'] = json_encode([
                $request->option_1,
                $request->option_2,
                $request->option_3,
                $request->option_4,
            ]);
        }
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('questions_photos', 'public');
        }

        $question = Question::create($data);

        return response()->json(['message' => 'create successfully']);
        return redirect()->route('questions.index')->with('success', 'Question created successfully!');

    }

    public function show(Question $question)
    {
        return $question;
    }

    public function update(Request $request, Question $question)
    {
        $data = $request->validate([
            'subject_id' => 'sometimes|exists:subjects,id',
            'type' => 'sometimes|in:لفظئ,كمي',
            'question' => 'sometimes|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'options' => 'nullable|array',
            'correct_answer' => 'sometimes|string',
            'explane_answer' => 'sometimes|string',
            'notes' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            // حذف الصورة القديمة
            if ($question->photo) {
                Storage::disk('public')->delete($question->photo);
            }

            $data['photo'] = $request->file('photo')->store('questions_photos', 'public');
        }

        $question->update($data);


        return redirect()->route('questions.index')->with('success', 'Question created successfully!');
    }

    public function destroy(Question $question)
    {
        if ($question->photo) {
            Storage::disk('public')->delete($question->photo);
        }

        $question->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }

    public function getAllQuestions()
    {
        $questions = Question::all();



        return view('dashboard.questions.index', compact('questions'));
    }



    // public function index()
    // {
    //     return  view('dashboard.questions.index');
    // }


    // public function create()
    // {

    //     if ($this->qType != null) {

    //         if (!in_array($this->qType, questionTypes())) {
    //             return redirect(route('questions.create'));
    //         }
    //     }

    //     return view('dashboard.questions.create', [
    //         'pageTitle' => 'اضافة سؤال جديد',
    //         'qType' => $this->qType,
    //         'categories' => $this->questionCategories(),
    //     ]);
    // }

    // public function store(Request $request)
    // {
    //    dd($request->all());
    // }



    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Dashboard\Questions  $questions
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Questions $questions)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Dashboard\Questions  $questions
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Questions $questions)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Dashboard\Questions  $questions
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Questions $questions)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Dashboard\Questions  $questions
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Questions $questions)
    // {
    //     //
    // }
}
