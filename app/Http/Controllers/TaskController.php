<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class);
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
        $list = \App\Models\Checklist::findOrFail($request->input('list_id'));
        $this->authorize('view', $list);
        $input = $request->only('name', 'list_id');
        Log::info($input);
        $data = Task::create($input);
        return response()->json([
          'success' => true,
          'data' => $data,
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
        return $task;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
        $list = \App\Models\Checklist::findOrFail($request->input('list_id'));
        $this->authorize('view', $list);
        $input = $request->only('name', 'list_id', 'done');
        Log::info($input);
        $task->fill($input);
        $task->save();
        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
        $task->delete();
        return response()->json(['sucess' => true]);
    }

    public function fetch()
    {
        $result = Task::whereHas('Checklist', function($checklist){
            $checklist->where(['user_id' => Auth::id()]);
        })->orderBy('created_at', 'desc');

        if (Input::has('scheduled_at'))
        {
            $result->whereHas('Checklist', function($checklist)
            {
                $checklist->where(['scheduled_at' => Input::get('scheduled_at')]);
            });
        }

        $done = Input::get('done');
        if (Input::has('done') and in_array($done, ['true', 'false']))
        {
            $result->where(['done' => ($done == 'true')]);
        }
        return $result->get();

    }
}
