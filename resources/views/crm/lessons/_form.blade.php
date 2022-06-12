<?php
/**
 * @var \App\Models\Lesson $lesson
 * @var \App\Models\Question $question
 * @var \App\Models\Answer $answer
 */
?>
<div class="row mb-5">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6 pb-2">
                @include('forms._input', [
    'label' => 'Название',
    'required'=>'required',
    'name' => 'title',
    'type' => 'text',
    'placeholder' => 'Введите название...',
    'value' => isset($lesson) ? $lesson->getTitle() : ''
])
            </div>
            <div class="col-lg-6 pb-2">
                @include('forms._select', [
     'name'=>'chapter_id',
    'required'=>'required',
     'label'=>'Глава, к которой привязать урок',
     'list'=>$chaptersList,
    'placeholder' => '-',
     'value'=>isset($lesson) ? $lesson->getChapterId() : '',
])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 pb-2">
                @include('forms._textarea', [
    'label' => 'Описание',
    'required'=>'required',
    'name' => 'description',
   'rows' => 3,
    'type' => 'text',
    'placeholder' => 'Введите описание...',
    'value' => isset($lesson) ? $lesson->getDescription() : ''
])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 pb-2">
                @include('forms._textarea', [
    'label' => 'Контент',
    'required'=>'required',
    'name' => 'content',
    'type' => 'text',
   'rows' => 5,
    'placeholder' => 'Введите контент...',
    'value' => isset($lesson) ? $lesson->getContent() : ''
])
            </div>
        </div>
        <div class="row"
             style="font-size: 24px; font-weight: 700; font-family: Montserrat, sans-serif; color: #fff;">
            <div class="col-auto my-3">
                Вопросы к уроку
            </div>
        </div>
        @if(isset($lesson) && $lesson->getQuestions()->isNotEmpty())
            @foreach($lesson->getQuestions() as $key =>$question)
                <div class="row">
                    <div class="col-lg-12 pb-2">
                        @include('forms._input', [
            'label' => 'Вопрос '. $key+1,
            'required'=>'required',
            'name' => 'questions['. $key+1 .']',
            'type' => 'text',
            'placeholder' => 'Введите вопрос...',
            'value' => $question->getContent()
        ])
                    </div>
                    @foreach($question->getAnswers() as $index => $answer)
                        <div class="row align-items-center">
                            <div class="col-lg-1 pb-2">
                                <label style="width: 65px" class="mx-3"
                                       for="{{'answers[' . $index+1 . ']'}}">{{'Ответ '. $index+1}}</label>
                            </div>
                            <div class="col-lg-10 pb-2">
                                @include('forms._input', [
                    'required'=>'required',
                    'name' => 'answers['. $key+1 .']['. $index+1 .']',
                    'type' => 'text',
                    'placeholder' => 'Введите ответ...',
                    'value' => $answer->getContent()
                ])
                            </div>
                            <div class="col-lg-1 pb-2">
                                @include('forms._radio', [
                    'name' => 'correct['. $key+1 .']',
                    'checked' => $answer->isCorrect(),
                    'value' => $index+1,
                ])
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            @for($i = 0; $i < 5; $i++)
                <div class="row">
                    <div class="col-lg-12 pb-2">
                        @include('forms._input', [
            'label' => 'Вопрос '. $i+1,
            'required'=>'required',
            'name' => 'questions['. $i+1 .']',
            'type' => 'text',
            'placeholder' => 'Введите вопрос...',
        ])
                    </div>
                    @for($j = 0; $j < 5; $j++)
                        <div class="row align-items-center">
                            <div class="col-lg-1 pb-2">
                                <label style="width: 65px" class="mx-3"
                                       for="{{'answers[' . $j+1 . ']'}}">{{'Ответ '. $j+1}}</label>
                            </div>
                            <div class="col-lg-10 pb-2">
                                @include('forms._input', [
                    'required'=>'required',
                    'name' => 'answers['. $i+1 .']['. $j+1 .']',
                    'type' => 'text',
                    'placeholder' => 'Введите ответ...',
                ])
                            </div>
                            <div class="col-lg-1 pb-2">
                                @include('forms._radio', [
                    'name' => 'correct['. $i+1 .']',
                    'value' => $j+1,
                ])
                            </div>
                        </div>
                    @endfor
                </div>
            @endfor
        @endif
    </div>
</div>

