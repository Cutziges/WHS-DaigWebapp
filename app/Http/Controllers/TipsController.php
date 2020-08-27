<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Tips;
use App\Category;

class TipsController extends Controller
{
    /**
     * Display the index view for tips & tricks
     */
    public function index(Request $request)
    {
        return view('tips.index');
    }

    /**
     * ================================================================
     *                         MAIN FUNCTIONS
     * ================================================================
     */

    /**
     * Display the user view for available tips & tricks
     */
    public function show($id)
    {
        $tips = Tips::all()->where('category_id', $id);
        $category = Category::find($id);
        $category_title = $category->title;

        return view('tips.show')
            ->with('tips', $tips)
            ->with('category', $category_title);
    }


    /**
     * ================================================================
     *                      ADMIN FUNCTIONS
     * ================================================================
     */

    /**
     * ------------------------------------------------------------------
     *                          Create
     * ------------------------------------------------------------------
     */

    /**
     * Create function
     * @param Request $request
     * @return string
     * @throws ValidationException
     */
    public function create(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'shortTip' => 'required|max:255',
            'longTip' => 'max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->route('tips.admin')
                ->withInput()
                ->withErrors($validator);
        } else {
            // Process the submitted data
            $shortTip = $request->get('shortTip');
            $longTip = $request->get('longTip');
            $category = $request->get('category_id');

            // Create the DB entry
            $tip = new Tips;

            $tip->shortTip = $shortTip;
            $tip->longTip = $longTip;
            $tip->category_id = $category;

            $tip->save();

            return redirect()->route('tips.admin')
                ->with('flashType', 'success')
                ->with('message', 'Tip or trick successfully added.');
        }
    }

    /**
     * ------------------------------------------------------------------
     *                          Read
     * ------------------------------------------------------------------
     */

    /**
     * Display the tips & tricks view for admins
     */
    public function admin()
    {
        // Get all available tips
        $tips = Tips::all();

        return view('tips.admin')
            ->with('tips', $tips);
    }

    /**
     * ------------------------------------------------------------------
     *                          Update
     * ------------------------------------------------------------------
     */

    /**
     * Edit a tip or trick
     * @param Request $request
     * @return string
     * @throws ValidationException
     */
    public function edit(Request $request, $id)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'shortTip' => 'required|max:255',
            'longTip' => 'max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->route('tips.admin')
                ->withInput()
                ->withErrors($validator);
        } else {
            // Find tip by id
            $tip = Tips::find($id);
            // Update the data within the DB
            $tip->update([
                'shortTip' => $request->get('shortTip'),
                'longTip' => $request->get('longTip'),
                'category_id' => $request->get('category_id'),
            ]);

            return redirect()->route('tips.admin')
                ->with('flashType', 'success')
                ->with('message', 'Tip successfully edited.');
        }
    }

    /**
     * ------------------------------------------------------------------
     *                          Delete
     * ------------------------------------------------------------------
     */

    /**
     * Delete a tip or trick
     * @param $id
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($id)
    {
        $tip = Tips::find($id);

        // Authorization
        //$this->authorize('delete', $tip);

        $tip->delete();

        return redirect()->route('tips.admin', $tip->id)
            ->with('flashType', 'success')
            ->with('message', 'Tip or trick successfully deleted.');
    }
}
