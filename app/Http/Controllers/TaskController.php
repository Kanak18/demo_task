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
         $login_user = Auth::user()->id;
        // paginate the authorized user's tasks with 5 per page
         $tasks = Task::select('*')->where(function ($query) use ($login_user) {
                        $query->where('user_id', '=', $login_user)->orWhere('added_by', '=', $login_user);                        
         });        
         $tasks = $tasks->orderBy('is_complete')
            ->orderByDesc('created_at')
            ->paginate(5);

        $all_users = User::select('*')->get();

        // return task index view with paginated tasks
        return view('home/tasks', [
            'tasks' => $tasks,
            'all_users' => $all_users
        ]);
    }

    public function create()
    {
        $all_users = User::select('*')->where('id','<>' , Auth::user()->id)->get();
        return view('home/tasks_form_new', [           
            'all_users' => $all_users,
            'logged_user' => Auth::user()
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
        $loginUser = Auth::User();

        // validate the given request
        $data = $this->validate($request, [
            'title' => 'required|string|max:255',
        ]);

        // create a new incomplete task with the given title
        Auth::user()->tasks()->create([
            'title' => $data['title'],
            'is_complete' => false,
            'user_id'   => $request->assign_user_id,
            'added_by' => $loginUser->id,
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
        
        // Update the task
        $task->title = $request->title;        
        $task->user_id = $request->assign_user_id;
        $task->is_complete = $request->is_completed;
        $task->save();
        $msg = "Task Updated!";
        

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
        $all_users = User::select('*')->where('id','<>' , Auth::user()->id)->get();

        // return task index view with paginated tasks
        return view('home/tasks_form', [
            'all_users' => $all_users,
            'existed_task' => $task,
            'logged_user' => Auth::user()
        ]);     
       
    }
}
