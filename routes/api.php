<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/me', 'Api\\UserController@me');
    Route::patch('/settings', 'Api\\UserController@settings');

    Route::apiResource('/subjects', 'Api\\SubjectController');
    Route::get('/subjects/{subject}/relationships/exams', 'Api\\Relationships\\SubjectController@exams');

    Route::apiResource('/exams', 'Api\\ExamController');
    Route::get('/exams/{exam}/relationships/subject', 'Api\\Relationships\\ExamController@subject');
    Route::get('/exams/{exam}/relationships/questions', 'Api\\Relationships\\ExamController@questions');

    Route::apiResource('/questions', 'Api\\QuestionController')->except('index');
    Route::get('/questions/{question}/relationships/exam', 'Api\\Relationships\\QuestionController@exam');
    Route::get('/questions/{question}/relationships/answers', 'Api\\Relationships\\QuestionController@answers');

    Route::apiResource('/questions.answers', 'Api\\AnswerController')->only(['store', 'destroy']);
});

// /subjects?filter[created]=2021-03-27&include=exams&sort=-name
