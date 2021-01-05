<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Todo;

class ApiController extends Controller
{
    public function createTodo(Request $request){
        $array = ['error' => ''];
        $rules = [
            'title' => 'required| min:3'
        ];

        $validator = Validator::make($request->all(), $rules);

      

        if ( $validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        $title = $request->input('title');

        $todo = new Todo();
        $todo->title = $title;
        $todo->save();

        return $array;
    }

    public function readAllTodos(){
        $array = ['error' => ''];
        
        $todos = Todo::all();
        $array['list'] = $todos;

        return $array;
    }

    public function readTodo($id){
        $array = ['error' => ''];
        
        $todo = Todo::find($id);
        if ($todo) {
            $array['todo'] = $todo;
        } else {
            $array['error'] = 'ID Inexistente';
        }
        

        return $array;
    }

    public function updateTodo(Request $request, $id){
        $array = ['error' => ''];

        $rules = [
            'title' => 'min:3',
            'done' => 'boolean' //true, false, 1, 0,'1','0'
        ];


        $validator = Validator::make($request->all(), $rules);
    

        if ( $validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        $title = $request->input('title');
        $done = $request->input('done');

        $todo = Todo::find($id);
        if ($todo){
            if ($title) {
                $todo->title = $title;
            }
    
            if($done !== NULL) {
                $todo->done = $done;
            }
            
            $todo->save();
        } else {
            $array['error'] = 'ID Inexistente';
        }


        return $array;
    }

    public function deleteTodo($id){
        $array = ['error' => ''];

        $todo = Todo::find($id);
        $todo->delete();

        return $array;
    }
}
