<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Form;

class FormController extends Controller
{
    public function view($users)
    {
        $output='<table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Hobby</th>
                        <th scope="col">Address</th>
                        <th scope="col">Images</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Actions</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($users as $user) {
            $output.='
                    <tr>
                        <th scope="row">'. $user->id .'</th>
                        <td>'.$user->fname.'</td>
                        <td>'. $user->lname .'</td>
                        <td>'. $user->email .'</td>
                        <td>'. $user->gender .'</td>
                        <td>'. $user->hobby .'</td>
                        <td>'. $user->address .'</td>
                        <td><img src="Image/'. $user->image .'" alt="#"></td>
                        <td>'. $user->created_By .'</td>
                        <td>
                            <button onclick="editData('. $user->id .')" type="button" class="btn btn-primary">
                              Edit
                            </button>
                            <button type="button" class="btn btn-danger" onclick="deleteUser('. $user->id .')">
                              Delete
                            </button>
                        </td>
                        <td>'. $user->created_at .'</td>
                        <td>'. $user->updated_at .'</td>
                    </tr>';
        }

        $output.='</tbody>
            </table>';

        return $output;
    }
    
    public function index()
    {   
        // dd(User::all());
        return view('index', [
            'users' => Form::all()
        ]);
    }

    public function find($search)
    {   
        if ($search != "emptyQuery") {
            $users = Form::where('fname','LIKE','%'.$search."%")->orWhere('lname', 'LIKE', '%'. $search .'%')->get();
            return FormController::view($users);
        }

        return FormController::view(Form::all());

    }

    public function store()
    {
        
        if (request()->hobby) {
        $hobby = request()->hobby;
        $hobby = implode(",", $hobby);
        }

        if(request()->file('image')){
            $file = request()->file('image');
            $extension = $file->extension();
            $filename = request()->fname . request()->lname.".".$extension;
            $filename = str_replace(".", "-T-".date("Y_m_d_H_i").".", ($filename));
            $file-> move(public_path('Image'), $filename);
        }

        $attributes = request()->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required',
            'hobby' => 'required',
            'address' => 'required',
            'image' => '',
            'created_By'=> 'required',
        ]);
        
        $attributes['hobby'] = $hobby;
        $attributes['image'] = $filename;
        
        $user = Form::create($attributes);

        return FormController::view(Form::all());

    }
    
    public function edit(Form $user)
    {
        $user = (Form::find($user->id));
        return(json_encode($user));
    }
    
    public function update()
    {   
        $user = (Form::find(request()->userId));
        
        $attributes = request()->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'hobby' => 'required',
            'address' => 'required',
            'image' => '',
            'created_By'=> 'required',
            ]);
        
        if (request()->hobby && is_array(request()->hobby)) {
        $hobby = request()->hobby;
        $hobby = implode(",", $hobby);
        $attributes['hobby'] = $hobby;
        }

        if(request()->file('image')){
            $file = request()->file('image');
            $extension = $file->extension();
            $filename = request()->fname . request()->lname.".".$extension;
            $filename = str_replace(".", "-T-".date("Y_m_d_H_i").".", ($filename));
            $file-> move(public_path('Image'), $filename);
            $attributes['image'] = $filename;
        }
        else{
            $attributes['image'] = $user->image;
        }

        $user->update($attributes);

        return FormController::view(Form::all());
    }

    public function delete(Form $user)
    {
        $user = Form::find($user->id);
        $user->delete();

        return FormController::view(Form::all());
    }
}
