<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
        public function index()
    {
        $tasks = Auth::user()->tasks()->with('category')->get();
        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Auth::user()->category()->orderBy('name')->get();

        return view('task.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        Auth::user()->tasks()->create($request->validated());

        Auth::user()->tasks()->create($request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
        ])
        );

        return redirect()->route('tasks.index')->with('success', "Task created");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $categories = Auth::user()->category()->orderBy('name')->get();

        return view('task.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
//        $task->update($request->validated());

        $task->update($request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
            'completed_at' => 'nullable|date',
        ]));

        return redirect()->route('categories.index')->with('success', 'Task updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }
}
