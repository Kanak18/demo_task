<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Paginate the authenticated user's tasks.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // paginate the authorized user's tasks with 5 per page
        $tasks = Auth::user()
            ->tasks()
            ->orderBy('is_complete')
            ->orderByDesc('created_at')
            ->paginate(5);

        $all_users = User::select('*')->get();

        // return task index view with paginated tasks
        return view('home/tasks', [
            'tasks' => $tasks,
            'all_users' => $all_users
        ]);
    }

    /**
     * Store a new incomplete task for the authenticated user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // validate the given request
        $data = $this->validate($request, [
            'title' => 'required|string|max:255',
        ]);

        // create a new incomplete task with the given title
        Auth::user()->tasks()->create([
            'title' => $data['title'],
            'is_complete' => false,
        ]);

        // flash a success message to the session
        session()->flash('status', 'Task Created!');

        // redirect to tasks index
        return redirect('/tasks');
    }

    /**
     * Mark the given task as complete and redirect to tasks index.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Task $task,Request $request) {

        if($request->_method == "PUT") {
            // Update the task
            $task->title = $request->title;
            $task->user_id = $request->assign_user_id;
            $task->save();
            $msg = "Task Updated!";

        } elseif($request->_method == "PATCH") {

            // mark the task as complete and save it
            $task->is_complete = true;
            $task->save();
            $msg = "Task Completed!";
        }

        // flash a success message to the session
        session()->flash('status', $msg);

        // redirect to tasks index
        return redirect('/tasks');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        // flash a success message to the session
        session()->flash('status', 'Task Deleted!');

        // redirect to tasks index
        return redirect('/tasks');
    }

    public function edit(Task $task)
    {
        // paginate the authorized user's tasks with 5 per page
        $tasks = Auth::user()
            ->tasks()
            ->orderBy('is_complete')
            ->orderByDesc('created_at')
            ->paginate(5);

        $all_users = User::select('*')->get();

        // return task index view with paginated tasks
        return view('home/tasks', [
            'tasks' => $tasks,
            'existed_task' => $task,
            'all_users' => $all_users,
            'logged_user' => Auth::user()
        ]);
    }
}
