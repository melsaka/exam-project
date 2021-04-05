<?php

namespace Tests\Feature\Api;

// use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Subject;
use App\Models\Exam;
use Tests\TestCase;

class SubjectsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function auth_user_can_fetch_subjects()
    {
        $this->login();

        $subjects = create(new Subject, 10);

        $response = $this->json('GET', '/api/subjects');
        
        foreach ($subjects as $subject) {
            $this->assertJsonHave($subject, $response);
        }
        
        $response->assertOk();
    }

    /** @test */
    public function guest_cant_fetch_subjects()
    {
        $this->expectException('\Illuminate\Auth\AuthenticationException');

        $response = $this->json('GET', '/api/subjects');
        
        $response->assertUnauthorized();
    }

    /** @test */
    public function auth_user_can_fetch_subjects_and_include_exams()
    {
        $this->login();

        $subject = create(new Subject);
        
        $exams = create(new Exam, 10, ['subject_id' => $subject->id]);

        $response = $this->json('GET', '/api/subjects?include=exams');
        
        foreach ($exams as $exam) {
            $this->assertJsonHave($exam, $response);
        }
        
        $response->assertOk();
    }

    /** @test */
    public function auth_user_can_fetch_subjects_and_count_its_related_exams()
    {
        $this->login();

        $subject = create(new Subject);
        
        $exams = create(new Exam, 10, ['subject_id' => $subject->id]);

        $response = $this->json('GET', '/api/subjects?count=exams');
        
        $response->assertJsonFragment(['exams_count' => "10"]);
        
        $response->assertOk();
    }

    /** @test */
    public function auth_user_can_fetch_subject()
    {
        $this->login();

        $subject = create(new Subject);

        $response = $this->json('GET', '/api/subjects/'. $subject->id);

        $this->assertJsonHave($subject, $response);

        $response->assertOk();
    }

    /** @test */
    public function guest_cant_fetch_subject()
    {
        $this->expectException('\Illuminate\Auth\AuthenticationException');

        $response = $this->json('GET', '/api/subjects/'. rand());
        
        $response->assertUnauthorized();
    }

    /** @test */
    public function auth_user_cant_fetch_subject_that_doesnt_exist()
    {
        $this->expectException('\Illuminate\Database\Eloquent\ModelNotFoundException');

        $this->login();

        $response = $this->json('GET', '/api/subjects/'. rand());

        $this->assertNotFound(Subject::class, $response);
    }

    /** @test */
    public function auth_user_can_create_subject()
    {
        $this->login();

        $subject = make(new Subject);

        $response = $this->json('POST', '/api/subjects/', $subject->toArray());

        $this->assertDatabaseHas('subjects', $subject->toArray());

        $response->assertCreated();
    }

    /** @test */
    public function auth_user_cant_create_subject_without_description()
    {
        $this->expectException('\Illuminate\Validation\ValidationException');

        $this->login();

        $subject = make(new Subject, 1, ['description' => '']);

        $response = $this->json('POST', '/api/subjects/', $subject->toArray());

        $this->assertValidationError($response);
    }

    /** @test */
    public function auth_user_cant_create_subject_without_name()
    {
        $this->expectException('\Illuminate\Validation\ValidationException');

        $this->login();

        $subject = make(new Subject, 1, ['name' => '']);

        $response = $this->json('POST', '/api/subjects/', $subject->toArray());

        $this->assertValidationError($response);
    }

    /** @test */
    public function guest_cant_create_subject()
    {
        $this->expectException('\Illuminate\Auth\AuthenticationException');

        $subject = make(new Subject);

        $response = $this->json('POST', '/api/subjects/', $subject->toArray());
        
        $response->assertUnauthorized();
    }

    /** @test */
    public function auth_user_can_update_subject()
    {
        $this->login();

        $subject = create(new Subject);

        $newData = make(new Subject);
        
        $response = $this->json('PATCH', '/api/subjects/'.$subject->id, $newData->toArray());
        
        $this->assertDatabaseHas('subjects', $newData->toArray());

        $response->assertOk();
    }


    /** @test */
    public function guest_cant_update_subject()
    {
        $this->expectException('\Illuminate\Auth\AuthenticationException');

        $subject = create(new Subject);

        $newData = make(new Subject);

        $response = $this->json('PATCH', '/api/subjects/'.$subject->id, $newData->toArray());
        
        $response->assertUnauthorized();
    }

    /** @test */
    public function user_can_delete_subject()
    {
        $this->login();

        $subject = create(new Subject);

        $response = $this->json('DELETE', '/api/subjects/'. $subject->id);

        $response->assertNoContent();
    }

    /** @test */
    public function guest_cant_delete_subject()
    {
        $this->expectException('\Illuminate\Auth\AuthenticationException');

        $subject = create(new Subject);

        $response = $this->json('DELETE', '/api/subjects/'.$subject->id);
        
        $response->assertUnauthorized();
    }
}
