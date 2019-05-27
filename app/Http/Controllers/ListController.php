<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Checklist::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Checklist::where(['user_id' => Auth::id()])->orderBy('created_at', 'desc')->get();
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
        $input = $request->only('title', 'scheduled_at');
        $input['user_id'] = Auth::id();
        Log::info($input);
        $checklist = Checklist::create($input);
        return response()->json([
          'success' => true,
          'data' => $checklist
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function show(Checklist $checklist)
    {
        //
        $checklist->tasks = $checklist->tasks;
        return $checklist;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checklist $checklist)
    {
        //
        $input = $request->only('title', 'scheduled_at');
        $input['user_id'] = Auth::id();
        Log::info($input);
        $checklist->fill($input);
        $checklist->save();
        return $checklist;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checklist $checklist)
    {
        //
        $checklist->delete();
        return response()->json(['sucess' => true]);
    }
}
