@extends('dashboard.layouts.master')
@section('title', $pageTitle)
@section('css')

@endsection
@section('content')



    @if ($qType == null)
        <h1 class="mt-5 text-center mb-4">حدد نوع السؤال</h1>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <a href="?type=لفظي">
                    <div class="box text-center">
                        <img src="{{ asset('dashboard/images/linguistic.png') }}" alt="">
                        <h1 class=" font-weight-600 text-main text-center mt-2 ">لفظي</h1>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="?type=كمي">
                    <div class="box text-center">
                        <img src="{{ asset('dashboard/images/tools.png') }}" alt="">
                        <h1 class=" font-weight-600 text-main text-center mt-2 ">كمي</h1>
                    </div>
                </a>
            </div>
        </div>
    @else
        <x-dashboard.links-bar :links="[
            [
                'name' => 'الأسئلة',
                'link' => adminUrl('messages'),
            ],
            [
                'name' => $pageTitle,
            ],
        ]" />


        <section class="mb-5">

            <form class="fo rm" action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data">
                <div class="row justify-content-center">
                    @csrf
                    <input type="hidden" name="type" value="{{ $qType }}">
                    <div class="col-xl-8 col-md-12">

                        <x-panel-with-heading title="البيانات الرئيسية">

                            <x-form-group :properties="[
                                'select' => [
                                    'name' => 'category_id',
                                    'list' => $categories,
                                    'options' => ['required', 'placeholder' => 'ما هو تصنيف السؤال ؟'],
                                ],
                                'label' => [
                                    'text' => 'تصنيف السؤال',
                                    'options' => [
                                        'class' => 'required',
                                    ],
                                ],
                            ]" /><!-- category_id -->

                            <x-form-group :properties="[
                                'textarea' => [
                                    'name' => 'question_text',
                                    'options' => ['required', 'rows' => 3],
                                ],
                                'label' => [
                                    'text' => 'نص السؤال',
                                    'options' => [
                                        'class' => 'required',
                                    ],
                                ],
                            ]" /><!-- question_text -->

                            <label class=" required mb-2">إختيارات السؤال</label>
                            <div class="row">
                                @for ($i = 0; $i <= 3; $i++)
                                    <div class="col-md-12">
                                        <x-form-group :properties="[
                                            'input' => [
                                                'name' => 'option_text[]',
                                                'type' => 'text',
                                                'options' => [
                                                    'required',
                                                    'placeholder' => 'الإختيار رقم ( ' . $i + 1 . ' )',
                                                ],
                                            ],
                                        ]" /><!-- option_text -->
                                    </div>
                                @endfor
                            </div>
                            <x-form-group :properties="[
                                'textarea' => [
                                    'name' => 'question_explanation',
                                    'options' => ['rows' => 1],
                                ],
                                'label' => [
                                    'text' => 'الاجابه الصحيحه ',
                                ],
                            ]" /><!-- question_explanation -->

                            <x-form-group :properties="[
                                'textarea' => [
                                    'name' => 'question_explanation',
                                    'options' => ['rows' => 6],
                                ],
                                'label' => [
                                    'text' => 'شرح للسؤال',
                                ],
                            ]" /><!-- question_explanation -->

                            <x-form-group :properties="[
                                'textarea' => [
                                    'name' => 'question_notes',
                                    'options' => ['rows' => 5],
                                ],
                                'label' => [
                                    'text' => 'ملاحظات',
                                ],
                            ]" /><!-- question_notes -->


                        </x-panel-with-heading><!-- end box -->


                        <x-panel-with-heading title="صورة توضيحية">
                            <x-form-group class="mb-0" :properties="[
                                'input' => [
                                    'name' => 'question_images[]',
                                    'type' => 'file',
                                    'options' => [
                                        'accept' => 'image/*',
                                        'multiple',
                                    ],
                                ],
                            ]" /><!-- question_images -->
                        </x-panel-with-heading><!-- end box -->


                        <button type="submit" class=" btn btn-main px-5">اضافة السؤال</button>
                    </div><!--  Content -->

                </div><!-- Row -->
            </form><!-- End Form -->

        </section><!-- End Section -->
    @endif


@endsection
@section('js')

@endsection
