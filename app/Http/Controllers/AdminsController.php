<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminsRequest;
use App\Http\Requests\UpdateAdminsRequest;
use App\Repositories\AdminsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Hash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AdminsController extends AppBaseController
{
    /** @var  AdminsRepository */
    private $adminsRepository;

    public function __construct(AdminsRepository $adminsRepo)
    {
        $this->adminsRepository = $adminsRepo;
    }

    /**
     * Display a listing of the Admins.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->adminsRepository->pushCriteria(new RequestCriteria($request));
        $admins = $this->adminsRepository->all();

        return view('admins.index')
            ->with('admins', $admins);
    }

    /**
     * Show the form for creating a new Admins.
     *
     * @return Response
     */
    public function create()
    {
        return view('admins.create');
    }

    /**
     * Store a newly created Admins in storage.
     *
     * @param CreateAdminsRequest $request
     *
     * @return Response
     */
    public function store(CreateAdminsRequest $request)
    {
        $input = $request->all();

        $input["password"] = Hash::make($input["password"]);
        $admins = $this->adminsRepository->create($input);

        Flash::success('Admins saved successfully.');

        return redirect(route('admins.index'));
    }

    /**
     * Display the specified Admins.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $admins = $this->adminsRepository->findWithoutFail($id);

        if (empty($admins)) {
            Flash::error('Admins not found');

            return redirect(route('admins.index'));
        }

        return view('admins.show')->with('admins', $admins);
    }

    /**
     * Show the form for editing the specified Admins.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $admins = $this->adminsRepository->findWithoutFail($id);

        if (empty($admins)) {
            Flash::error('Admins not found');

            return redirect(route('admins.index'));
        }

        return view('admins.edit')->with('admins', $admins);
    }

    /**
     * Update the specified Admins in storage.
     *
     * @param  int              $id
     * @param UpdateAdminsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdminsRequest $request)
    {
        $admins = $this->adminsRepository->findWithoutFail($id);

        if (empty($admins)) {
            Flash::error('Admins not found');

            return redirect(route('admins.index'));
        }
        $admins = $this->adminsRepository->update($request->all(), $id);

        Flash::success('Admins updated successfully.');

        return redirect(route('admins.index'));
    }

    /**
     * Remove the specified Admins from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $admins = $this->adminsRepository->findWithoutFail($id);

        if (empty($admins)) {
            Flash::error('Admins not found');

            return redirect(route('admins.index'));
        }

        $this->adminsRepository->delete($id);

        Flash::success('Admins deleted successfully.');

        return redirect(route('admins.index'));
    }
}
