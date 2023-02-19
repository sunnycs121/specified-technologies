<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\TaskList;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taskLists = TaskList::all()->where('created_by', '=', Auth::id());
        return Inertia::render('Dashboard', [
            'taskLists' => $taskLists,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd(['hello']);
        // dd($request);
        $request->validate([
            'name' => 'required|string|unique:task_lists|max:255'
        ]);

        TaskList::create([
            'name' => $request->name,
            'created_by' => Auth::id()
        ]);
        /* return Inertia::render('Dashboard', [
            // 'taskLists' => $taskLists,
        ]); */
        return redirect()->back()
            ->with('message', 'List created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskList  $taskList
     * @return \Illuminate\Http\Response
     */
    public function show(TaskList $taskList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TaskList  $taskList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskList $taskList)
    {
        //
        dd('ooolala');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskList  $taskList
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskList $taskList)
    {
        // dd($taskList);
        $taskList->delete();
        // Tasks::where('task_list_id', $taskList->id)->delete();
        return redirect()->back()
            ->with('message', 'Task List Deleted.');
    }
}
