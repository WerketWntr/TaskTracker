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
    public function index(Request $request)
    {
        $user = Auth::user();
        // Получаем фильтры из запроса
        $categoryId = $request->input('category_id');
        $status = $request->input('status');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        // Строим базовый запрос для задач пользователя
        $query = $user->tasks()->with('category');

        // Фильтр по категории
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        // Фильтр по статусу
        if ($status === 'completed') {
            $query->whereNotNull('completed_at');
        } elseif ($status === 'pending') {
            $query->whereNull('completed_at');
        }

        // Фильтр по диапазону дат
        if ($dateFrom) {
            $query->whereDate('due_date', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->whereDate('due_date', '<=', $dateTo);
        }

        // Получаем отфильтрованные задачи
        $tasks = $query->orderBy('due_date')->get();

        // Для выпадающего списка категорий
        $categories = $user->category()->get();

        return view('task.index', compact('tasks', 'categories', 'categoryId', 'status', 'dateFrom', 'dateTo'));
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

        $task_data['completed_at'] = $request->has('completed_at') ? now() : null;
        $task->update($task_data);

        return redirect()->route('tasks.index')->with('success', 'Task updated.');
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
