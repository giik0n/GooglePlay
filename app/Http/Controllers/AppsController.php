<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAppsRequest;
use App\Http\Requests\UpdateAppsRequest;
use App\Models\Apps;
use App\Repositories\AppsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use function Sodium\compare;
use App\Models\Category;

class AppsController extends AppBaseController
{
    /** @var  AppsRepository */
    private $appsRepository;

    public function __construct(AppsRepository $appsRepo)
    {
        $this->appsRepository = $appsRepo;
    }

    /**
     * Display a listing of the Apps.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->appsRepository->pushCriteria(new RequestCriteria($request));
        $apps = $this->appsRepository->all();

        return view('apps.index')
            ->with('apps', $apps);
    }

    /**
     * Show the form for creating a new Apps.
     *
     * @return Response
     */
    public function create()
    {
        return view('apps.create');
    }

    /**
     * Store a newly created Apps in storage.
     *
     * @param CreateAppsRequest $request
     *
     * @return Response
     */
    public function store(CreateAppsRequest $request)
    {
        $input = $request->all();

        $apps = $this->appsRepository->create($input);

        Flash::success('Apps saved successfully.');

        return redirect(route('applications.index'));
    }

    /**
     * Display the specified Apps.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $apps = $this->appsRepository->findWithoutFail($id);

        if (empty($apps)) {
            Flash::error('Apps not found');

            return redirect(route('applications.index'));
        }

        return view('apps.show')->with('apps', $apps);
    }

    /**
     * Show the form for editing the specified Apps.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $apps = $this->appsRepository->findWithoutFail($id);

        if (empty($apps)) {
            Flash::error('Apps not found');

            return redirect(route('applications.index'));
        }

        return view('apps.edit')->with('apps', $apps);
    }

    /**
     * Update the specified Apps in storage.
     *
     * @param  int $id
     * @param UpdateAppsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAppsRequest $request)
    {
        $apps = $this->appsRepository->findWithoutFail($id);

        if (empty($apps)) {
            Flash::error('Apps not found');

            return redirect(route('applications.index'));
        }

        $apps = $this->appsRepository->update($request->all(), $id);

        Flash::success('Apps updated successfully.');

        return redirect(route('applications.index'));
    }

    /**
     * Remove the specified Apps from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $apps = $this->appsRepository->findWithoutFail($id);

        if (empty($apps)) {
            Flash::error('Apps not found');

            return redirect(route('applications.index'));
        }

        $this->appsRepository->delete($id);

        Flash::success('Apps deleted successfully.');

        return redirect(route('applications.index'));
    }

    public function search(Request $request)
    {
        $categories = Category::orderBy('id')->get()->keyBy('id');

        session(['search' => $request->find]);
        $category = session('category') == 'All' ? '' : session('category');

        $items = Apps::where('title', 'like', '%' . $request->find . '%')
            ->where('category', 'LIKE', "%" . $category . "%")
            ->get();
        return view('apps.find', compact('items', 'categories'));
    }
    public function uploadefile(Request $request){
            try{
                $location = public_path() . '/tmp/';

                if (!file_exists($location)) {
                    mkdir($location, 0777, true);
                }

                $files = glob($location . '*');
                foreach($files as $file){
                    if(is_file($file))
                        unlink($file);
                }
                $name = time() . '.apk';
                $request->myfile->move($location, $name);
                session(['filename' => $location . $name]);
               // rename($location . $name, public_path().'/images/'. $name);
                return "OK";

            }catch (Exception $e){
                return $e;
            }
    }
    public function storeApp(Request $request){
        $categories = Category::orderBy('id')->get()->keyBy('id');

        $app = new Apps();
        $app->title = $request->title;
        $app->description = $request->description;
        $app->company = $request->company;
        $app->user_id = Auth::user()->id;
        $app->user_email = Auth::user()->email;
        $app->version = $request->version;
        $app->size = $request->size;
        $app->category_id = $request->category;
        $app->category = $categories[$request->category]->name;
        $app->android = $request->android;
        $app->created_at = date("Y-m-d H:i:s");
        $app->updated_at = date("Y-m-d H:i:s");
        $app->save();

        $location = public_path() . '/images/apps/' . $app->id . '/';
        if (!file_exists($location)) {
            mkdir($location, 0777, true);
        }
        foreach ($request->images as $image) {
            $image->move($location, $image->getClientOriginalName());
        }

        $location = public_path() . '/apps/' . $app->id . '/' ;
        if (!file_exists($location)) {
            mkdir($location, 0777, true);
        }
        rename( session('filename'), $location . uniqid() . '.apk');

        return redirect(route('users.userapps'));
    }
}
