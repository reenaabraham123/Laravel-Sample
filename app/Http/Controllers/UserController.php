<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\UserCreatedMail;
use App\Jobs\NewUserJob;
use Rap2hpoutre\FastExcel\FastExcel;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('users.index',compact('users'));
    }
    public function export()
    {
        $user = User::all();
        return (new FastExcel($user))->download('user_data.xlsx');
    }
    public function pdf()
    {
        $users = User::get();
        $pdf = Pdf::loadView('pdf.invoice', ['users'=>$users]);
        return $pdf->download('invoice.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'mobile_number'=>'required',
            'status'=>'required',
        ]);
        $input = [
            'name'=> $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password'=>bcrypt('123456'),
            'status'=>$request->status
        ];
        if($request->hasFile('image'))
        {
            $extension = $request->image->extension();
            $fileName = 'user_pic_'.time().'.'.$extension;
            $destinationPath = public_path().'/images' ;
            $request->image->move($destinationPath,$fileName);
            $input['image'] = $fileName;
        }
        $user = User::create($input);
      //  NewUserJob::dispatch($user);
        return redirect('/')->with('success', 'User created successfully');
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
        $user = User::find($id);
        return view('users.edit',compact('user'));
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
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'mobile_number'=>'required',
            'status'=>'required',
        ]);
        $user = User::find($id);
        $user->update([
            'name'=> $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password'=>bcrypt('123456'),
            'status'=>$request->status
        ]);
        return redirect('/')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/')->with('success', 'User deleted successfully');
    }
}
