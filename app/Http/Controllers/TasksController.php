<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks();
        return view('dashboard', compact('tasks'));
    }
    public function create()
    {
    	return view('tasks.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);
        $task = new Task();
        $task->title = $request->title;
    	$task->description = $request->description;
    	$task->user_id = auth()->user()->id;
    	$task->save();
    	return back()->with('message', "La tâche a bien été créée !");
    }

    public function edit(Task $task)
    {

    	if (auth()->user()->id == $task->user_id)
        {            
                return view('tasks.edit', compact('task'));
        }           
        else {
             return back();
         }            	
    }

    public function update(Request $request, Task $task)
    {
    	if(isset($_POST['delete'])) {
    		$task->delete();
    		return back(); 
    	}
    	else
    	{
            $this->validate($request, [
                'description' => 'required',
                'title' => 'required'
            ]);
            $task->title = $request->title;
    		$task->description = $request->description;
	    	$task->save();
	    	return back()->with('message', "La tâche a bien été édité !"); 
    	}    	
    }
}
