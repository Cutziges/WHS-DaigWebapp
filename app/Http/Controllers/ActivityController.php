<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
{
    protected $activity;

    /**
     * Display the view for Activities
     */
    public function index()
    {
        $activities = Activity::all()->toArray();
        return view('activities.index')->with('activities', $activities);
    }


    /**
     * ================================================================
     *                         ADMIN FUNCTIONS
     * ================================================================
     */

    /**
     * ------------------------------------------------------------------
     *                          Create
     * ------------------------------------------------------------------
     */
    /**
     * Create an activity
     * @param Request $request
     * @return string
     * @throws ValidationException
     */
    public function create(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'max:255',
            'color' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('activity.admin')
                ->withInput()
                ->withErrors($validator);
        } else {
            // Create the DB entry
            $activity = new Activity();

            $activity->name = $request->get('name');
            $activity->description = $request->get('description');
            $activity->color = $request->get('color');

            $activity->save();

            return redirect()->route('activity.admin')
                ->with('flashType', 'success')
                ->with('message', 'Activity successfully created.');
        }
    }

    /**
     * ------------------------------------------------------------------
     *                          Read
     * ------------------------------------------------------------------
     */

    /**
     * Display the view for admins
     */
    public function admin()
    {
        $activities = Activity::all();
        return view('activities.admin')->with('activities', $activities);
    }

    /**
     * ------------------------------------------------------------------
     *                          Update
     * ------------------------------------------------------------------
     */

    /**
     * Edit an activity
     * @param Request $request
     * @return string
     * @throws ValidationException
     */
    public function edit(Request $request, $id)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'max:255',
            'color' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('activity.admin')
                ->withInput()
                ->withErrors($validator);
        } else {
            // Find activity by id
            $activity = Activity::find($id);

            // Update the data within the DB
            $activity->update([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'color' => $request->get('color'),
            ]);

            return redirect()->route('activity.admin')
                ->with('flashType', 'success')
                ->with('message', 'Activity successfully edited.');
        }
    }

    /**
     * ------------------------------------------------------------------
     *                          Delete
     * ------------------------------------------------------------------
     */

    /**
     * Delete an activity
     * @param $id
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($id)
    {
        // Find activity by id
        $activity = Activity::find($id);

        // Authorization
        //$this->authorize('delete', activity);

        // Delete the activity DB entry
        $activity->delete();

        return redirect()->route('activity.admin')
            ->with('flashType', 'success')
            ->with('message', 'Activity successfully deleted.');
    }

    /**
     * ================================================================
     *                         API FUNCTIONS
     * ================================================================
     */

    /**
     * Function for random activity proposal
     * @return mixed
     */
    public function getActivity()
    {
        $activities = Activity::all()->toArray();

        // Choose random activity
        $activity = Arr::random($activities);

        return $activity;
    }

    public function createActivity(Request $request)
    {
        $colorarray = [
            "color1" => "#e2afff",
            "color2" => "#c8e7ff",
            "color3" => "#caffbf",
            "color4" => "#bdb2ff",
            "color5" => "#ffd6a5",
            "color6" => "#ffadad",
            "color7" => "#fdffb6",
            "color8" => "#a0c4ff",
            "color9" => "#eff7f6",
            "color10" => "#eddcd2",
            "color11" => "#fde2e4",
            "color12" => "#c5dedd",
            "color13" => "#dbe7e4",
            "color14" => "#bcd4e6",
            "color15" => "#99c1de",
            "color16" => "#f08080",
            "color17" => "#ede7b1",
            "color18" => "#fcf4dd",
            "color19" => "#ddedea",
            "color20" => "#daeaf6",
        ];

        $activity = new Activity();
        $activity->name = $request->get('name');
        $activity->description = $request->get('description');
        $activity->color = Arr::random($colorarray);
        $activity->save();

        return response()->json(['message' => 'Added activity successfully.']);
    }
}
