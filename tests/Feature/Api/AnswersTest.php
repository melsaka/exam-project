<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Question;
use App\Models\Answer;
use Tests\TestCase;

class AnswersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function auth_user_can_fetch_question_answers()
    {
        $this->login();

        $question = create(new Question);

        $answers = create(new Answer, 10, ['question_id' => $question->id]);

        $response = $this->json('GET', "/api/questions/{$question->id}/relationships/answers");

        foreach ($answers as $answer) {
            $this->assertJsonHave($answer, $response);
        }

        $response->assertOk();
    }

    /** @test */
    public function guest_cant_fetch_question_answers()
    {
        $this->expectException('\Illuminate\Auth\AuthenticationException');

        $response = $this->json('GET', "/api/questions/{rand()}/relationships/answers");
        
        $response->assertUnauthorized();
    }

    /** @test */
    public function auth_user_cant_fetch_answers_of_question_that_doesnt_exist()
    {
        $this->expectException('\Illuminate\Database\Eloquent\ModelNotFoundException');

        $this->login();

        $question = create(new Question);

        $response = $this->json('GET', "/api/questions/{rand()}/relationships/answers");

        $this->assertNotFound(Question::class, $response);
    }

    /** @test */
    public function auth_user_can_create_question_answer()
    {
        $this->login();

        $question = create(new Question);

        $answer = make(new Answer)->toArray();

        $answer['status'] = 'wrong';

        $response = $this->json('POST', "/api/questions/{$answer['question_id']}/answers", $answer);
        
        $answer['status'] = false;

        $this->assertDatabaseHas('answers', $answer);

        $response->assertCreated();
    }

    /** @test */
    public function auth_user_cant_create_answer_without_body()
    {
        $this->expectException('\Illuminate\Validation\ValidationException');

        $this->login();

        $answer = make(new Answer, 1, ['body' => '']);

        $response = $this->json('POST', "/api/questions/{$answer->question->id}/answers", $answer->toArray());

        $this->assertValidationError($response);
    }


    /** @test */
    public function guest_cant_create_question_answer()
    {
        $this->expectException('\Illuminate\Auth\AuthenticationException');

        $question = create(new Question);

        $answer = make(new Answer);

        $response = $this->json('POST', "/api/questions/{$question->id}/answers", $answer->toArray());
        
        $response->assertUnauthorized();
    }

    /** @test */
    public function user_can_delete_question_answer()
    {
        $this->login();

        $question = create(new Question);
        
        $answer = create(new Answer, 1, ['question_id' => $question->id]);

        $response = $this->json('DELETE', "/api/questions/{$question->id}/answers/{$answer->id}");

        $response->assertNoContent();
    }

    /** @test */
    public function guest_cant_delete_question_answer()
    {
        $this->expectException('\Illuminate\Auth\AuthenticationException');

        $response = $this->json('DELETE', "/api/questions/{rand()}/answers/{rand()}");
        
        $response->assertUnauthorized();
    }
}
