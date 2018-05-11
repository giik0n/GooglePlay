<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRateRequest;
use App\Http\Requests\UpdateRateRequest;
use App\Models\Apps;
use App\Models\Rate;
use App\Repositories\RateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class RateController extends AppBaseController
{
    /** @var  RateRepository */
    private $rateRepository;

    public function __construct(RateRepository $rateRepo)
    {
        $this->rateRepository = $rateRepo;
    }

    /**
     * Display a listing of the Rate.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->rateRepository->pushCriteria(new RequestCriteria($request));
        $rates = $this->rateRepository->all();

        return view('rates.index')
            ->with('rates', $rates);
    }

    /**
     * Show the form for creating a new Rate.
     *
     * @return Response
     */
    public function create()
    {
        return view('rates.create');
    }

    /**
     * Store a newly created Rate in storage.
     *
     * @param CreateRateRequest $request
     *
     * @return Response
     */
    public function store(CreateRateRequest $request)
    {
        $input = $request->all();

        $rate = $this->rateRepository->create($input);

        Flash::success('Rate saved successfully.');

        return redirect(route('rates.index'));
    }

    /**
     * Display the specified Rate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rate = $this->rateRepository->findWithoutFail($id);

        if (empty($rate)) {
            Flash::error('Rate not found');

            return redirect(route('rates.index'));
        }

        return view('rates.show')->with('rate', $rate);
    }

    /**
     * Show the form for editing the specified Rate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $rate = $this->rateRepository->findWithoutFail($id);

        if (empty($rate)) {
            Flash::error('Rate not found');

            return redirect(route('rates.index'));
        }

        return view('rates.edit')->with('rate', $rate);
    }

    /**
     * Update the specified Rate in storage.
     *
     * @param  int $id
     * @param UpdateRateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRateRequest $request)
    {
        $rate = $this->rateRepository->findWithoutFail($id);

        if (empty($rate)) {
            Flash::error('Rate not found');

            return redirect(route('rates.index'));
        }

        $rate = $this->rateRepository->update($request->all(), $id);

        Flash::success('Rate updated successfully.');

        return redirect(route('rates.index'));
    }

    /**
     * Remove the specified Rate from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rate = $this->rateRepository->findWithoutFail($id);

        if (empty($rate)) {
            Flash::error('Rate not found');

            return redirect(route('rates.index'));
        }

        $this->rateRepository->delete($id);

        Flash::success('Rate deleted successfully.');

        return redirect(route('rates.index'));
    }

    public function saveRating(Request $request)
    {
        $rate = new Rate();
        $rate->app_id = $request->app_id;
        $rate->comment = $request->comment;
        $rate->rate = $request->rate;
        $rate->created_at = date('Y-m-d H:i:s');
        $rate->updated_at = date('Y-m-d H:i:s');
        $rate->save();

        $app = Apps::find($request->app_id);
        $app->rate += $request->rate;
        $app->ratecount += 1;
        $app->save();

        return redirect()->back();
    }
}
