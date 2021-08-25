<?php

namespace App\Http\Controllers\Admin;
use App\CategoryCourse;
use App\Country;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Course;
use App\Models\Voucher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Plank\Mediable\Facades\MediaUploader;
use MediaUploader;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index()
    {
        $users = Admin::all()->except(1);
        return view('admin.users.index', compact('users'));
    }
    /* teacher== alluser and student */
   public function allUsers(){
         $users = User::Where('type','teacher')->get();
        return view('admin.teacher.index',compact('users'));
   }
    public function allstudent(){
        $users=User::Where('type','student')->get();
        return view('admin.student.index',compact('users'));
    }
    public function showStudent(User $user)
    {
        $courses = Course::where('student_id',$user->id)->orderBy('created_at','desc')->get();
//        dd($courses);
        $vouchers= Voucher::where('user_id',$user->id)->orderBy('created_at','desc')->get();
        return view('admin.student.show',compact('user','courses','vouchers'));
    }
    public function showTeacher(User $user)
    {
        $courses = Course::where('teacher_id',$user->id)->orderBy('created_at','desc')->get();
//        dd($courses);
        $vouchers= Voucher::where('user_id',$user->id)->orderBy('created_at','desc')->get();
        $appointment =$user->teacherAppointment;
//        dd($appointment);
        return view('admin.teacher.show',compact('user','courses','vouchers','appointment'));
    }
    public function payToTeacher(User $user)
    {
       if ($user->remaining >0 ){
           $voucher = Voucher::Create([
               'type'=>'expense',
               'amount'=>$user->remaining,
               'paid_for' => 'Pay To Teacher',
               'user_id' => $user->id
           ]);
           $user->remaining = 0;
       }
        $user->save();
        return redirect()->back()->with('success','Done');
    }
    public function show(User $user)
    {
        if ($user->showHome){

            $user->showHome = 0;
        }else{

            $user->showHome = 1;
        }
        $user->save();
        return redirect()->back()->with('success','Done');
    }
    public function editUser(User $user){

        return view('admin.teacher.edit',compact('user'));
    }

    public function updateTeacher(Request $request, User $user){

        $request->validate([
            'img'=>'nullable|image|mimes:jpg,png,jpeg,svg|max:30048',
            'name' => 'required|max:255',
            'video' => 'nullable|url',
            'hourly_price' => 'nullable'
        ]);
        $user->name = $request->get('name');
        $user->video = $request->get('video');
        $user->hourly_price = $request->get('hourly_price');
        $user->save();

        if($request->file('img')):
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $user->attachMedia($media, 'userAvatar');
        endif;

        return redirect()->route('admin.teachers')->with('success', "User $user->name updated successfully");
    }


    /*end teacher and student */
    public function create()
    {
        $roles = Role::where('guard_name', 'admin')->get();

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|max:25|min:6|confirmed',
            'email' => 'required|email|max:255|unique:admins',
            'role' => 'required',
        ]);
        //dd($request);
        //        $password = str_random();

        $user = new Admin();

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->syncRoles($request->get('role'));

        $user->save();
        Alert::success('User '.$user->name .' Created successfully');
        return redirect('admin/users/all');
    }
    public function addTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|max:25|min:6|confirmed',
            'email' => 'required|email|max:255|unique:users',
        ]);

        $request->merge(['password'=>bcrypt($request->get('password')),'type'=>'teacher',
            'approved'=>1]);
        $user = User::create($request->all());
        Alert::success('Teacher '.$user->name .' Created successfully');
        return redirect('admin/teachers');
    }
    public function addStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|max:25|min:6|confirmed',
            'email' => 'required|email|max:255|unique:users',
        ]);


        $request->merge(['password'=>bcrypt($request->get('password')),'type'=>'student',
            'approved'=>1]);
        $user = User::create($request->all());
        Alert::success('Student '.$user->name .' Created successfully');
        return redirect('admin/students');
    }

    public function edit(Admin $user)
    {
        $roles = Role::where('guard_name', 'admin')->get();
        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(Request $request, Admin $user)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'roles' => 'required',
            'password' => 'nullable|max:25|min:6|confirmed',
        ]);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if($request->password){
            $user->password =Hash::make( $request->get('password'));
        }
        $user->syncRoles($request->get('roles'));

        $user->save();

        return redirect()->route('admin.users.all')->with('success', "User $user->name updated successfully");
    }

    public function destroy(Admin $user)
    {
        if($user->account_id){
            Alert::error(' Can`t delete User '.$user->name .' ');
        }else{
            $user->delete();
            Alert::success('User '.$user->name .' deleted successfully');
        }
        return redirect('admin/users/all');
    }
    public function review(User $user)
    {
        $user->approved = 1;
        $user->save();
        return redirect()->back()->with('success','Done');
    }
    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success','Done');
    }
}
