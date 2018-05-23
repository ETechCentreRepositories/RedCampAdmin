<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Student;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);

        $users = Student::orderBy('id','asc')->paginate(10);

        return view('user.index')->with('users_id', $users_id)->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id); 

        $user = Student::find($id);

        return view('user.edit')->with('users_id', $users_id)->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Student::find($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->nric = $request->input('nric');
        $user->dob = $request->input('dob');
        $user->mobile = $request->input('mobile');
        $user->school = $request->input('school');
        $user->diet_requirements = $request->input('diet_requirements');
        $user->password = Hash::make($request['password']);
        $user->statuses_id = $request->input('statuses_id');
        $user->save();
    
        Mail::send('emails.mailEvent', ['user' => $user], function ($message) use ($user) {
            $status = $user->statuses['status_name'];
            $message->from('trueno@etechnologycentre.com', 'RedCamp');
            $message->to($user->email)->subject("RedCamp Application Approval");
        });

        return redirect('/user')->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Student::find($id);

        $user->delete();
        return redirect('/user')->with('success', 'User Removed');
    }

    public function exportFile($type){

        $userexcel = Student::select('id','name','email','nric','dob','mobile','school','diet_requirements','password')
                        ->get()->toArray();

        return \Excel::create('user', function($excel) use ($userexcel) {

            $excel->sheet('sheet name', function($sheet) use ($userexcel)

            {

                $sheet->fromArray($userexcel);

            });

        })->download($type);

    }      
}
