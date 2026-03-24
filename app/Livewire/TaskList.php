<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskList extends Component
{
    public function updateStatus($taskId, $newStatus)
    {
        $task = Task::where('id', $taskId)
                    ->where('assigned_user_id', auth()->id())
                    ->first();

        if ($task && in_array($newStatus, ['pending', 'in_progress', 'completed'])) {
            $task->update(['status' => $newStatus]);
            
            $this->dispatch('task-updated');
        }
    }

    public function render()
    {
        $tasks = Task::where('assigned_user_id', auth()->id())
                    ->orderByRaw("CASE WHEN status = 'in_progress' THEN 1 WHEN status = 'pending' THEN 2 WHEN status = 'completed' THEN 3 ELSE 4 END")
                    ->orderBy('due_date', 'asc')
                    ->get();

        return view('livewire.task-list', [
            'tasks' => $tasks
        ]);
    }
}
