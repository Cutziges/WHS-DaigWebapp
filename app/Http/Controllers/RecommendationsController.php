<?php

namespace App\Http\Controllers;

use App\Recommendations;
use App\Topic;
use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RecommendationsController extends Controller
{
    /**
     * Display the view for recommended places
     */
    public function index()
    {
        return view('recommendations.index');
    }

    /**
     * ================================================================
     *                         MAIN FUNCTIONS
     * ================================================================
     */

    /**
     * Display the overview for recommended places
     */
    public function show($id)
    {
        $recommendations = Recommendations::all()->where('topic_id', $id);
        $topic = Topic::find($id);
        $topic_title = $topic->title;

        return view('recommendations.show')
            ->with('recommendations', $recommendations)
            ->with('topic', $topic_title);
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
     * Upload function
     * @param Request $request
     * @return string
     * @throws ValidationException
     */
    public function create(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|max:750',
            'address' => 'required',
            'website' => 'max:255',
            'place_image' => 'image|dimensions:min_width=500,min_height=500',
        ]);

        if ($validator->fails()) {
            return redirect()->route('recs.admin')
                ->withInput()
                ->withErrors($validator);
        } else {

            $rec = Recommendations::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'website' => $request->get('website'),
                'phone' => $request->get('phone'),
                'address' => $request->get('address'),
                'topic_id' => $request->get('topic_id'),
            ]);

            if ($request->hasFile('place_image')) {

                $image = $request->file('place_image');
                $image_name = Str::random(15) . '.' . $image->guessExtension();
                $rec->update('place_image', $image_name);
                $path = '/public/recommendations/' . $rec->id . '/';
                $external_path = '/storage/recommendations/' . $rec->id . '/';
                $rec->update(['place_image_path' => $external_path]);
                Helper::processImage($image, $image_name, $path, 500, 500);

            } else {
                $rec->update([
                    'place_image' => 'item_image_default.jpg',
                    'place_image_path' => '/images/',
                ]);
            }
            return redirect()->route('recs.admin')
                ->with('flashType', 'success')
                ->with('message', 'Recommendation ' . $rec->name . ' successfully added.');
        }
    }

    /**
     * ------------------------------------------------------------------
     *                          Read
     * ------------------------------------------------------------------
     */

    /**
     * Display the recommendations view for admins
     */
    public function admin()
    {
        $recommendations = Recommendations::all();
        return view('recommendations.admin')->with('recommendations', $recommendations);;
    }


    /**
     * ------------------------------------------------------------------
     *                          Update
     * ------------------------------------------------------------------
     */

    /**
     * Edit a recommendation
     * @param Request $request
     * @return string
     * @throws ValidationException
     */
    public function edit(Request $request, $id)
    {
        // Authorization
        //$this->authorize('edit', $item);

        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|max:750',
            'address' => 'required',
            'website' => 'max:255',
            'place_image' => 'image|dimensions:min_width=500,min_height=500',
        ]);

        if ($validator->fails()) {
            return redirect()->route('recs.admin')
                ->withInput()
                ->withErrors($validator);
        } else {
            // Attributes
            $rec = Recommendations::find($id);
            $name_old = $rec->name;

            // Add new image path to DB if the standard image isn't used
            if ($rec->place_image_path != '/images/') {
                $image_path = '/storage/recommendations/' . $rec->id . '/';
                $external_path = $image_path;
            } else {
                $external_path = $rec->place_image_path;
            }

            // New item image submitted
            if ($request->hasFile('new_place_image')) {

                $place_image_old = $rec->place_image;
                $image = $request->file('new_place_image');
                $extension = $image->guessExtension();
                $image_name = Str::random(15) . '.' . $extension;

                // Image operations
                $path = '/public/recommendations/' . $rec->id . '/';
                $external_path = '/storage/recommendations/' . $rec->id . '/';
                $rec->update(['place_image_path' => $external_path]);
                Storage::delete($path . $place_image_old);
                Helper::processImage($image, $image_name, $path, 500, 500);
            } else {
                $image_name = $rec->place_image;
            }

            $rec->update([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'address' => $request->get('address'),
                'website' => $request->get('website'),
                'phone' => $request->get('phone'),
                'topic_id' => $request->get('topic_id'),
                'place_image' => $image_name,
                'place_image_path' => $external_path,
            ]);

            $recommendations = Recommendations::all();
            return redirect()->route('recs.admin')
                ->with('flashType', 'success')
                ->with('message', 'Recommendation for ' . $name_old . ' successfully edited.')
                ->with('recommendations', $recommendations);
        }
    }

    /**
     * ------------------------------------------------------------------
     *                          Delete
     * ------------------------------------------------------------------
     */

    /**
     * Delete a recommendation
     * @param $id
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($id)
    {
        $rec = Recommendations::find($id);

        // Authorization
        //$this->authorize('delete', $rec);

        if ($rec->place_image != 'item_image_default.jpg') {
            Storage::delete('/public/recommendations/' . $rec->id);
        }

        $rec->delete();
        return redirect()->route('recs.admin')
            ->with('flashType', 'success')
            ->with('message', 'Recommendation for ' . $rec->name . ' successfully deleted.');
    }

    /**
     * ================================================================
     *                         API FUNCTIONS
     * ================================================================
     */

    /**
     * Display the recommended places for food & drinks at slack
     */
    public function getFoodDrinks()
    {
        $recommendations = Recommendations::all()->where('topic_id', '1')->toArray();

        return $recommendations;
    }
}
