<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Exam;
use Tests\TestCase;

class QuestionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function auth_user_can_fetch_exam_questions()
    {
        $this->login();

        $exam = create(new Exam);

        $questions = create(new Question, 10, ['exam_id' => $exam->id]);

        $response = $this->json('GET', "/api/exams/{$exam->id}/relationships/questions");

        foreach ($questions as $question) {
            $this->assertJsonHave($question, $response);
        }

        $response->assertOk();
    }

    /** @test */
    public function guest_cant_fetch_exam_questions()
    {
        $this->expectException('\Illuminate\Auth\AuthenticationException');

        $response = $this->json('GET', "/api/exams/{rand()}/relationships/questions");
        
        $response->assertUnauthorized();
    }

    /** @test */
    public function auth_user_can_fetch_questions_and_include_exam_and_answers()
    {
        $this->login();

        $exam = create(new Exam);
        
        $question = create(new Question, 1, ['exam_id' => $exam->id]);

        $answers = create(new Answer, 10, ['question_id' => $question->id]);

        $response = $this->json('GET', "/api/exams/{$exam->id}/relationships/questions?include=exam,answers");
        
        foreach ($answers as $answer) {
            $this->assertJsonHave($answer, $response);
        }
        
        $this->assertJsonHave($exam, $response);
        
        $response->assertOk();
    }

    /** @test */
    public function auth_user_can_fetch_questions_and_count_its_related_answers()
    {
        $this->login();

        $exam = create(new Exam);
        
        $question = create(new Question, 1, ['exam_id' => $exam->id]);
        
        $answers = create(new Answer, 10, ['question_id' => $question->id]);

        $response = $this->json('GET', "/api/exams/{$exam->id}/relationships/questions?count=answers");
        
        $response->assertJsonFragment(['answers_count' => "10"]);
        
        $response->assertOk();
    }

    /** @test */
    public function auth_user_can_fetch_exam_question()
    {
        $this->login();

        $question = create(new Question);

        $response = $this->json('GET', "/api/questions/". $question->id);

        $this->assertJsonHave($question, $response);

        $response->assertOk();
    }


    /** @test */
    public function guest_cant_fetch_question()
    {
        $this->expectException('\Illuminate\Auth\AuthenticationException');

        $response = $this->json('GET', "/api/questions/". rand());
        
        $response->assertUnauthorized();
    }

    /** @test */
    public function auth_user_cant_fetch_exam_question_that_doesnt_exist()
    {
        $this->expectException('\Illuminate\Database\Eloquent\ModelNotFoundException');

        $this->login();

        $response = $this->json('GET', "/api/questions/". rand());

        $this->assertNotFound(Question::class, $response);
    }

    /** @test */
    public function auth_user_can_create_exam_question()
    {
        $this->login();

        $question = make(new Question);

        $response = $this->json('POST', "/api/questions/", $question->toArray());

        $this->assertDatabaseHas('questions', $question->toArray());

        $response->assertCreated();
    }

    /** @test */
    public function auth_user_cant_create_question_without_body()
    {
        $this->expectException('\Illuminate\Validation\ValidationException');

        $this->login();

        $question = make(new Question, 1, ['body' => '']);

        $response = $this->json('POST', "/api/questions/", $question->toArray());

        $this->assertValidationError($response);
    }


    /** @test */
    public function guest_cant_create_exam_question()
    {
        $this->expectException('\Illuminate\Auth\AuthenticationException');

        $question = make(new Question);

        $response = $this->json('POST', "/api/questions/", $question->toArray());
        
        $response->assertUnauthorized();
    }

    /** @test */
    public function auth_user_can_update_exam_question()
    {
        $this->login();

        $question = create(new Question);

        $newData = make(new Question, 1, ['exam_id' => $question->exam_id]);

        $response = $this->json('PATCH', "/api/questions/{$question->id}", $newData->toArray());
        
        $this->assertDatabaseHas('questions', $newData->toArray());

        $response->assertOk();
    }


    /** @test */
    public function guest_cant_update_question()
    {
        $this->expectException('\Illuminate\Auth\AuthenticationException');

        $newData = make(new Question);

        $response = $this->json('PATCH', "/api/questions/{rand()}", $newData->toArray());
        
        $response->assertUnauthorized();
    }

    /** @test */
    public function user_can_delete_exam_question()
    {
        $this->login();

        $question = create(new Question);

        $response = $this->json('DELETE', "/api/questions/{$question->id}");

        $response->assertNoContent();
    }

    /** @test */
    public function guest_cant_delete_exam_question()
    {
        $this->expectException('\Illuminate\Auth\AuthenticationException');

        $response = $this->json('DELETE', "/api/questions/{rand()}");
        
        $response->assertUnauthorized();
    }
}
