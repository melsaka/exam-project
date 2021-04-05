<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Exam;
use Tests\TestCase;

class ExamsTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function auth_user_can_fetch_exams()
    {
        $this->login();

        $exams = create(new Exam, 10);

        $response = $this->json('GET', '/api/exams');
        
        foreach ($exams as $exam) {
            $this->assertJsonHave($exam, $response);
        }
        
        $response->assertOk();
    }

    /** @test */
    public function guest_cant_fetch_exams()
    {
        $this->expectException('\Illuminate\Auth\AuthenticationException');

        $response = $this->json('GET', '/api/exams');
        
        $response->assertUnauthorized();
    }

    /** @test */
    public function auth_user_can_fetch_exams_and_include_subject_and_questions()
    {
        $this->login();

        $subject = create(new Subject);
        
        $exam = create(new Exam, 1, ['subject_id' => $subject->id]);

        $questions = create(new Question, 10, ['exam_id' => $exam->id]);

        $response = $this->json('GET', '/api/exams?include=subject,questions');
        
        foreach ($questions as $question) {
            $this->assertJsonHave($exam, $response);
        }
        
        $this->assertJsonHave($subject, $response);
        
        $response->assertOk();
    }

    /** @test */
    public function auth_user_can_fetch_exams_and_count_its_related_questions()
    {
        $this->login();

        $exam = create(new Exam);
        
        $questions = create(new Question, 10, ['exam_id' => $exam->id]);

        $response = $this->json('GET', '/api/exams?count=questions');
        
        $response->assertJsonFragment(['questions_count' => "10"]);
        
        $response->assertOk();
    }

    /** @test */
    public function auth_user_can_fetch_exam()
    {
        $this->login();

        $exam = create(new Exam);

        $response = $this->json('GET', '/api/exams/'. $exam->id);

        $this->assertJsonHave($exam, $response);

        $response->assertOk();
    }


    /** @test */
    public function guest_cant_fetch_exam()
    {
        $this->expectException('\Illuminate\Auth\AuthenticationException');

        $response = $this->json('GET', '/api/exams/'. rand());
        
        $response->assertUnauthorized();
    }

    /** @test */
    public function auth_user_cant_fetch_exam_that_doesnt_exist()
    {
        $this->expectException('\Illuminate\Database\Eloquent\ModelNotFoundException');

        $this->login();

        $response = $this->json('GET', '/api/exams/'. rand());

        $this->assertNotFound(Exam::class, $response);
    }

    /** @test */
    public function auth_user_can_create_exam()
    {
        $this->login();

        $exam = make(new Exam);

        $response = $this->json('POST', '/api/exams/', $exam->toArray());

        $this->assertDatabaseHas('exams', $exam->toArray());

        $response->assertCreated();
    }

    /** @test */
    public function auth_user_cant_create_exam_without_subject_id()
    {
        $this->expectException('\Illuminate\Validation\ValidationException');

        $this->login();

        $exam = make(new Exam, 1, ['subject_id' => '']);

        $response = $this->json('POST', '/api/exams/', $exam->toArray());

        $this->assertValidationError($response);
    }

    /** @test */
    public function auth_user_cant_create_exam_without_description()
    {
        $this->expectException('\Illuminate\Validation\ValidationException');

        $this->login();

        $exam = make(new Exam, 1, ['description' => '']);

        $response = $this->json('POST', '/api/exams/', $exam->toArray());

        $this->assertValidationError($response);
    }

    /** @test */
    public function auth_user_cant_create_exam_without_name()
    {
        $this->expectException('\Illuminate\Validation\ValidationException');

        $this->login();

        $exam = make(new Exam, 1, ['name' => '']);

        $response = $this->json('POST', '/api/exams/', $exam->toArray());

        $this->assertValidationError($response);
    }

    /** @test */
    public function guest_cant_create_exam()
    {
        $this->expectException('\Illuminate\Auth\AuthenticationException');

        $exam = make(new Exam);

        $response = $this->json('POST', '/api/exams/', $exam->toArray());
        
        $response->assertUnauthorized();
    }

    /** @test */
    public function auth_user_can_update_exam()
    {
        $this->login();

        $exam = create(new Exam);

        $newData = make(new Exam);
        
        $response = $this->json('PATCH', '/api/exams/'.$exam->id, $newData->toArray());

        $this->assertDatabaseHas('exams', $newData->toArray());

        $response->assertOk();
    }


    /** @test */
    public function guest_cant_update_exam()
    {
        $this->expectException('\Illuminate\Auth\AuthenticationException');

        $exam = create(new Exam);

        $newData = make(new Exam);

        $response = $this->json('PATCH', '/api/exams/'.$exam->id, $newData->toArray());
        
        $response->assertUnauthorized();
    }

    /** @test */
    public function user_can_delete_exam()
    {
        $this->login();

        $exam = create(new Exam);

        $response = $this->json('DELETE', '/api/exams/'. $exam->id);

        $response->assertNoContent();
    }

    /** @test */
    public function guest_cant_delete_exam()
    {
        $this->expectException('\Illuminate\Auth\AuthenticationException');

        $exam = create(new Exam);

        $response = $this->json('DELETE', '/api/exams/'.$exam->id);
        
        $response->assertUnauthorized();
    }
}
