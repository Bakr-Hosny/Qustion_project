<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Questions;
use App\Models\Questions\QuestionsCategory;
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
        return  view('dashboard.questions.index');
    }


    public function create()
    {

        if ($this->qType != null) {

            if (!in_array($this->qType, questionTypes())) {
                return redirect(route('questions.create'));
            }
        }

        return view('dashboard.questions.create', [
            'pageTitle' => 'اضافة سؤال جديد',
            'qType' => $this->qType,
            'categories' => $this->questionCategories(),
        ]);
    }

    public function store(Request $request)
    {
       dd($request->all());
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dashboard\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function show(Questions $questions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashboard\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function edit(Questions $questions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dashboard\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questions $questions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dashboard\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questions $questions)
    {

    }

    public function getAllQuestions()
    {
        $questions = Question::all();



        return view('dashboard.questions.index', compact('questions'));
    }
}
