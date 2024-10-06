<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
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
        $response = $this->get('/tasks');

        $response->assertStatus(200);
        $response->assertSee(__('main.app.tasks'));
        $response->assertDontSee(__('main.tasks.create'));

        $responseAuthenticated = $this->actingAs($this->user)->get('/tasks');
        $responseAuthenticated->assertStatus(200);
        $responseAuthenticated->assertSee(__('main.app.tasks'));
        $responseAuthenticated->assertSee(__('main.tasks.create'));
        $responseAuthenticated->assertSee(__('main.tasks.edit'));
    }

    public function testCreate(): void
    {
        $response = $this->get('/tasks/create');
        $response->assertForbidden();

        $responseAuthenticated = $this->actingAs($this->user)->get(route('tasks.create'));
        $responseAuthenticated->assertStatus(200);
        $responseAuthenticated->assertSee(__('main.tasks.create'));
        $responseAuthenticated->assertSee(__('main.tasks.name'));
        $responseAuthenticated->assertSee(__('main.tasks.description'));
        $responseAuthenticated->assertSee(__('main.tasks.status'));
        $responseAuthenticated->assertSee(__('main.tasks.assigned_to'));
        $responseAuthenticated->assertSee(__('main.tasks.tags'));
    }

    public function testStore(): void
    {
        $body = [
            'name' => 'test task name',
            'description' => 'test task description',
            'status_id' => TaskStatus::all()->first()->id
        ];
        $response = $this->post(route('tasks.store'));
        $response->assertForbidden();

        $responseAuthenticated = $this->actingAs($this->user)->post(route('tasks.store'), $body);
        $responseAuthenticated->assertCreated();
        $responseAuthenticated->assertSessionHas('status', __('main.flashes.task_added'));
        $this->assertDatabaseHas('tasks', $body);

        // test double name
        $countBefore = Task::all()->count();
        $responseAuthenticatedDouble = $this->actingAs($this->user)->post(route('tasks.store'), $body);
        $responseAuthenticatedDouble->assertInvalid([
            'name' => __('validations.task_name_must_be_unique'),
        ]);
        $countAfter = Task::all()->count();
        $this->assertEquals($countBefore, $countAfter);

        $invalidBody = ['name' => '', 'description' => 'test task description'];
        $responseAuthenticatedDouble = $this->actingAs($this->user)->post(route('tasks.store'), $invalidBody);
        $responseAuthenticatedDouble->assertInvalid([
            'name' => __('validations.task_name_required'),
        ]);
        $responseAuthenticatedDouble->assertRedirect();
        $countAfter = Task::all()->count();
        $this->assertEquals($countBefore, $countAfter);
    }

    public function testStoreWrongAssignedTo(): void
    {
        $body = [
            'name' => 'test task name',
            'description' => 'test task description',
            'status_id' => TaskStatus::first()->id,
            'assigned_to_id' => -1,
        ];
        $countBefore = Task::all()->count();
        $responseAuthenticated = $this->actingAs($this->user)->post(route('tasks.store'), $body);
        $responseAuthenticated->assertInvalid([
            'assigned_to_id' => __('validations.task_has_wrong_assigned_to_id'),
        ]);
        $responseAuthenticated->assertRedirect();
        $countAfter = Task::all()->count();
        $this->assertEquals($countBefore, $countAfter);
    }

    public function testWrongStatus(): void
    {
        $body = [
            'name' => 'test task name',
            'description' => 'test task description',
            'status_id' => -1,
        ];
        $countBefore = Task::all()->count();
        $responseAuthenticated = $this->actingAs($this->user)->post(route('tasks.store'), $body);
        $responseAuthenticated->assertInvalid([
            'status_id' => __('validations.task_has_wrong_status'),
        ]);
        $responseAuthenticated->assertRedirect();
        $countAfter = Task::all()->count();
        $this->assertEquals($countBefore, $countAfter);
    }

    public function testEdit(): void
    {
        $task = Task::first();
        $response = $this->get(route('tasks.edit', $task->id));
        $response->assertForbidden();

        $responseAuthenticated = $this->actingAs($this->user)->get(route('tasks.edit', $task->id));
        $responseAuthenticated->assertStatus(200);
        $responseAuthenticated->assertSee(__('main.tasks.update'));
    }

    public function testUpdate(): void
    {
        $updatedTask = Task::first()->toArray();
        $taskId = $updatedTask['id'];
        $oldName = $updatedTask['name'];
        $updatedName = 'updated name';
        $updatedTask['name'] = $updatedName;
        $updatedTask['description'] = 'updated description';
        unset($updatedTask['created_at']);
        unset($updatedTask['updated_at']);

        $response = $this->patch(route('tasks.update', $taskId), $updatedTask);
        $response->assertForbidden();

        $responseAuthenticated = $this->actingAs($this->user)->patch(route('tasks.update', $taskId), $updatedTask);
        $responseAuthenticated->assertRedirect();
        $responseAuthenticated->assertSessionHas('status', __('main.flashes.task_changed'));
        $this->assertDatabaseHas('tasks', $updatedTask);
        $this->assertDatabaseMissing('tasks', ['name' => $oldName]);

        // test double name
        $secondTask = Task::firstWhere('id', '<>', $taskId)->toArray();
        $secondTask['name'] = $updatedName;
        unset($updatedTask['created_at']);
        unset($updatedTask['updated_at']);
        $secondTaskId = $secondTask['id'];
        $responseAuthenticatedDouble = $this->actingAs($this->user)->patch(route('tasks.update', $secondTaskId), $secondTask);
        $responseAuthenticatedDouble->assertInvalid([
            'name' => __('validations.task_name_must_be_unique'),
        ]);

        // test empty name
        $updatedTask['name'] = '';
        $responseAuthenticatedDouble = $this->actingAs($this->user)->patch(route('tasks.update', $taskId), $updatedTask);
        $responseAuthenticatedDouble->assertInvalid([
            'name' => __('validations.task_name_required'),
        ]);
        $responseAuthenticatedDouble->assertRedirect();

        // test wrong assigned_to
        $updatedTask['assigned_to_id'] = -1;
        $responseAuthenticatedDouble = $this->actingAs($this->user)->patch(route('tasks.update', $taskId), $updatedTask);
        $responseAuthenticatedDouble->assertInvalid([
            'assigned_to_id' => __('validations.task_has_wrong_assigned_to_id'),
        ]);
        $responseAuthenticatedDouble->assertRedirect();

        // test empty wrong status
        $updatedTask['status_id'] = -1;
        $responseAuthenticatedEmpty = $this->actingAs($this->user)->patch(route('tasks.update', $taskId), $updatedTask);
        $responseAuthenticatedEmpty->assertInvalid([
            'status_id' => __('validations.task_has_wrong_status'),
        ]);
        $responseAuthenticatedEmpty->assertRedirect();
    }

    public function testDelete(): void
    {
        $deletableTask = Task::factory()->for($this->user, 'created_by')->create();
        $deletableTaskName= $deletableTask->name;
        $deletableTaskId = $deletableTask->id;

        $response = $this->delete(route('tasks.destroy', $deletableTaskId));
        $response->assertForbidden();

        $responseAuthenticated = $this->actingAs($this->user)->delete(route('tasks.destroy', $deletableTaskId));
        $responseAuthenticated->assertRedirect();
        $responseAuthenticated->assertSessionHas('status', __('main.flashes.task_deleted'));
        $this->assertDatabaseMissing('tasks', ['name' => $deletableTaskName]);

        $nonDeletableTask = Task::where('created_by_id', '!=', $this->user->id)->first();
        $responseAuthenticatedNonDeletable = $this->actingAs($this->user)->delete(route('tasks.destroy', $nonDeletableTask));
        $responseAuthenticatedNonDeletable->assertForbidden();
    }

}
