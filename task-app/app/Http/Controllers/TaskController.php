<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|max:255',
            'due_date' => 'nullable|date',
        ]);

        Task::create($request->all());

        return redirect()->away('https://organic-space-doodle-r7p676vxvgqcpqg9-8000.app.github.dev')->with('success', 'Task added successfully.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'task_name' => 'required|max:255',
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->all());

        return redirect()->away('https://organic-space-doodle-r7p676vxvgqcpqg9-8000.app.github.dev')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->away('https://organic-space-doodle-r7p676vxvgqcpqg9-8000.app.github.dev')->with('success', 'Task deleted successfully.');
    }
}