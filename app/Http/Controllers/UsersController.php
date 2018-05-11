<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
use App\Models\Apps;
use App\Models\Users;
use App\Repositories\UsersRepository;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Category;

class UsersController extends AppBaseController
{
    /** @var  UsersRepository */
    private $usersRepository;

    public function __construct(UsersRepository $usersRepo)
    {
        $this->usersRepository = $usersRepo;
    }

    /**
     * Display a listing of the Users.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->usersRepository->pushCriteria(new RequestCriteria($request));
        $users = Users::where('developper',0)->get();
        $title = "Users";
        return view('users.index',compact('users','title'));

    }

    /**
     * Show the form for creating a new Users.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created Users in storage.
     *
     * @param CreateUsersRequest $request
     *
     * @return Response
     */
    public function store(CreateUsersRequest $request)
    {
        $input = $request->all();

        $users = $this->usersRepository->create($input);

        Flash::success('Users saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified Users.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $users = $this->usersRepository->findWithoutFail($id);

        if (empty($users)) {
            Flash::error('Users not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('users', $users);
    }

    /**
     * Show the form for editing the specified Users.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $users = $this->usersRepository->findWithoutFail($id);

        if (empty($users)) {
            Flash::error('Users not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('users', $users);
    }

    /**
     * Update the specified Users in storage.
     *
     * @param  int              $id
     * @param UpdateUsersRequest $request
     *
     * @return Response
     */
    public function update(UpdateUsersRequest $request)
    {
        $user = Auth::user();
        if(isset($request->newpassword) && !$request->newpassword == '') {
            if (Hash::check($request->password, $user->password)) {
                if ($request->newpassword == $request->newpasswordconf) {
                    $user->name = $request->name;
                    $user->password = Hash::make($request->newpassword);
                    $user->save();
                } else {
                    return redirect(route('users.edit',['id',$user->id]))->with('status', 'Паролі не збігаються!');
                }
            } else {
                Flash::error('Users password do not match.');
                return redirect()->back();
            }
        }
        $user->name = $request->name;
        $user->save();

        Flash::success('Users data updated successfully.');
        return redirect()->back();
    }

    /**
     * Remove the specified Users from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $users = $this->usersRepository->findWithoutFail($id);

        if (empty($users)) {
            Flash::error('Users not found');

            return redirect(route('users.index'));
        }

        $this->usersRepository->delete($id);

        Flash::success('Users deleted successfully.');

        return redirect(route('users.index'));
    }

    public function developpers(){
        $users = Users::where('developper',1)->get();
        $title = "Developpers";

        return view('users.index',compact('users','title'));
    }
    public function settings(){
        $this->categories = Category::orderBy('id')->get()->keyBy('id');
        return view('users.settings', ['categories' => $this->categories]);
    }
    public function setDevelopper(Request $request){
        $user = User::find(Auth::user()->id);
        $user->developper = 1;
        $user->save();
        return "OK";
    }
    public function userapps(){
        if(!Auth::user()->developper){
            return redirect()->back();
        }else{
            $categories = Category::orderBy('id')->get()->keyBy('id');
            $apps = Apps::where('user_id',Auth::user()->id)->get();
            return view('apps.userapp',compact('categories','apps'));
        }
    }
}
