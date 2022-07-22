<?php
namespace App\Http\Controllers;

use App\Models\Todo;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TodoController extends Controller
{
    protected $task;
    public function __construct()
    {
        $this->task = new Todo();
    }

    public  function index()
    {
        //assign variable
        $response['tasks'] = $this->task->all(); //here "all()" command equal to sql command-SELECT * FROM todo
        return view('pages.todo.index')->with($response);
    }

    public function store(Request $request)
    {
        $this->task->create($request->all());
        // return redirect()->back();
        return redirect()->route('home');
    }
    public function delete($task_id)
    {
        // dd($task_id);
        $task = $this->task->find($task_id);
        $task->delete();

        return redirect()->back();
    }
    public function done($task_id)
    {
        // dd($task_id);
        $task = $this->task->find($task_id);
        $task-> done = 1;
        $task->update();

        return redirect()->back();
    }
}
