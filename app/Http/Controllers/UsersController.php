<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Student;
use DB;

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

        $users = Student::orderBy('id','asc')->get();
        $pendings = Student::orderBy('id','asc')->where('statuses_id', '=', '1')->get();
        $accepteds = Student::orderBy('id','asc')->where('statuses_id', '=', '2')->get();
        $rejecteds = Student::orderBy('id','asc')->where('statuses_id', '=', '3')->get();


        return view('user.index')->with('users_id', $users_id)->with('users',$users)->with('pendings',$pendings)->with('accepteds',$accepteds)->with('rejecteds',$rejecteds);
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

        
        if ($user->statuses_id != $request->input('statuses_id')){
            $user->statuses_id = $request->input('statuses_id');

             Mail::send('emails.mailEvent', ['user' => $user], function ($message) use ($user) {
                 $status = $user->statuses['status_name'];
                 $message->from('redcamp@np.edu.sg', 'RedCamp');
                 $message->to($user->email)->subject("RedCamp Application Review");
             });
        } else if (!empty($request->input('password'))){
            $user->password = sha1($request['password']);
            $user->statuses_id = $request->input('statuses_id');
        } else {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->nric = $request->input('nric');
            $user->dob = $request->input('dob');
            $user->mobile = $request->input('mobile');
            $user->school = $request->input('school');
            $user->diet_requirements = $request->input('diet_requirements');
            $user->statuses_id = $request->input('statuses_id');
        }
        $user->save();

        return redirect('/user')->with('success', 'User Updated');
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

        $userexcel = DB::table('statuses')
        ->join('users', 'statuses.id', '=', 'users.statuses_id')
        ->select('users.id', 'users.name', 'users.email', 'users.nric', 'users.dob', 'users.mobile', 'users.school', 'users.diet_requirements', 'users.password', 'statuses.status_name')
        ->orderBy('users.id')
        ->get()
        ->toArray();
        $data= json_decode( json_encode($userexcel), true);

        return \Excel::create('user', function($excel) use ($data) {

            $excel->sheet('sheet name', function($sheet) use ($data)

            {

                $sheet->fromArray($data);

            });

        })->download($type);

    }       
}
