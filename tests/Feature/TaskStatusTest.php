<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->user = User::factory()->create();
    }

    public function testIndex(): void
    {
        $response = $this->get('/task_statuses');

        $response->assertStatus(200);
        $response->assertSee(__('main.app.statuses'));

        $response->assertDontSee(__('main.statuses.create'));

        $responseAuthenticated = $this->actingAs($this->user)->get('/task_statuses');
        $responseAuthenticated->assertStatus(200);
        $responseAuthenticated->assertSee(__('main.app.statuses'));
        $responseAuthenticated->assertSee(__('main.statuses.create'));
        $responseAuthenticated->assertSee(__('main.statuses.delete'));
    }

    public function testCreate(): void
    {
        $response = $this->get('/task_statuses/create');
        $response->assertForbidden();

        $responseAuthenticated = $this->actingAs($this->user)->get(route('task_statuses.create'));
        $responseAuthenticated->assertStatus(200);
        $responseAuthenticated->assertSee(__('main.statuses.create_status'));
    }

    public function testStore(): void
    {
        $body = ['name' => 'test task status'];
        $response = $this->post(route('task_statuses.store'));
        $response->assertForbidden();

        $responseAuthenticated = $this->actingAs($this->user)->post(route('task_statuses.store'), $body);
        $responseAuthenticated->assertCreated();
        $responseAuthenticated->assertSessionHas('status', __('main.flashes.status_added'));
        $this->assertDatabaseHas('task_statuses', $body);

        $countBefore = TaskStatus::all()->count();
        $responseAuthenticatedDouble = $this->actingAs($this->user)->post(route('task_statuses.store'), $body);
        $responseAuthenticatedDouble->assertInvalid([
            'name' => __('validations.status_name_not_unique'),
        ]);
        $responseAuthenticatedDouble->assertRedirect();
        $countAfter = TaskStatus::all()->count();
        $this->assertEquals($countBefore, $countAfter);
    }

    public function testEdit(): void
    {
        $taskStatus = TaskStatus::first();
        $response = $this->get(route('task_statuses.edit', $taskStatus->id));
        $response->assertForbidden();

        $responseAuthenticated = $this->actingAs($this->user)->get(route('task_statuses.edit', $taskStatus->id));
        $responseAuthenticated->assertStatus(200);
        $responseAuthenticated->assertSee(__('main.statuses.update'));
    }

    public function testUpdate(): void
    {
        $taskStatus = TaskStatus::first();
        $oldTaskStatus = ['name' => $taskStatus->name];
        $updatedTaskStatus = ['name' => 'updated name'];
        $secondTaskStatus = TaskStatus::firstWhere('name', '<>', $oldTaskStatus['name']);

        $response = $this->patch(route('task_statuses.update', $taskStatus->id), $taskStatus->toArray());
        $response->assertForbidden();

        $responseAuthenticated = $this->actingAs($this->user)->patch(route('task_statuses.update', $taskStatus->id), $updatedTaskStatus);
        $responseAuthenticated->assertRedirect();
        $responseAuthenticated->assertSessionHas('status', __('main.flashes.status_changed'));
        $this->assertDatabaseHas('task_statuses', $updatedTaskStatus);
        $this->assertDatabaseMissing('task_statuses', $oldTaskStatus);

        $updatedTaskStatus['name'] = $secondTaskStatus->name;
        $responseAuthenticatedDouble = $this->actingAs($this->user)->patch(route('task_statuses.update', $taskStatus->id), $updatedTaskStatus);
        $responseAuthenticatedDouble->assertInvalid([
            'name' => __('validations.status_name_not_unique'),
        ]);
        $responseAuthenticatedDouble->assertRedirect();
    }

    public function testDelete(): void
    {
        $deletableTaskStatus = TaskStatus::factory()->create();
        $deletableTaskStatusName= $deletableTaskStatus->name;
        $deletableTaskStatusId = $deletableTaskStatus->id;

        $response = $this->delete(route('task_statuses.destroy', $deletableTaskStatusId));
        $response->assertForbidden();

        $responseAuthenticated = $this->actingAs($this->user)->delete(route('task_statuses.destroy', $deletableTaskStatusId));
        $responseAuthenticated->assertRedirect();
        $responseAuthenticated->assertSessionHas('status', __('main.flashes.status_deleted'));
        $this->assertDatabaseMissing('task_statuses', ['name' => $deletableTaskStatusName]);

        $nonDeletableTaskStatus = TaskStatus::first();
        $responseAuthenticatedNonDeletable = $this->actingAs($this->user)->delete(route('task_statuses.destroy', $nonDeletableTaskStatus));
        $responseAuthenticatedNonDeletable->assertRedirect();
        $responseAuthenticatedNonDeletable->assertSessionHas('status', __('main.flashes.status_has_tasks'));
        $this->assertDatabaseHas('task_statuses', ['name' => $nonDeletableTaskStatus->name]);
    }

}
