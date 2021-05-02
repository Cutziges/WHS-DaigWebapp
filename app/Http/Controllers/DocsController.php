<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Document;
use Illuminate\Foundation\Testing\Concerns\MocksApplicationServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DocsController extends Controller
{
    /**
     * Display the view for Documentations and Manuals
     */
    public function index()
    {
        return view('docs.index');
    }

    /**
     * ================================================================
     *                         MAIN FUNCTIONS
     * ================================================================
     */

    /**
     * Display the documents view for users
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $items = Item::all()->where('category_id', $id);
        $category = Category::find($id);
        $category_title = $category->title;

        return view('docs.show')
            ->with('items', $items)
            ->with('category', $category_title);
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
    public function create(Request $request, $id)
    {
        // Find item by id
        $item = Item::find($id);

        // Category
        $category = $item->category_id;

        // Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'file' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('docs.showAdmin', $category)
                ->withInput()
                ->withErrors($validator);
        } else {
            // Process the submitted file
            $file = $request->file('file');
            $extension = $file->guessExtension();
            $filename = Str::random(15) . '.' . $extension;

            // Paths to the file
            $path = '/public/docs/' . $category . '/' . $id . '/';
            $external_path = '/storage/docs/' . $category . '/' . $id . '/';

            // Create the DB entry
            $doc = new Document;
            $doc->title = $request->get('title');
            $doc->item_id = $id;
            $doc->file = $filename;
            $doc->file_path = $external_path;
            $doc->save();

            // Putting the file to the server
            Storage::putFileAs($path, $file, $filename);

            return redirect()->route('docs.showAdmin', $category)
                ->with('flashType', 'success')
                ->with('message', 'Document ' . $doc->name . ' successfully added.');
        }
    }

    /**
     * ------------------------------------------------------------------
     *                          Read
     * ------------------------------------------------------------------
     */

    /**
     * Display the overview of all documents for admins
     */
    public function showAdmin($id)
    {
        $items = Item::all()->where('category_id', $id);
        $category = Category::find($id);
        $category_title = $category->title;

        return view('docs.admin')
            ->with('items', $items)
            ->with('category', $category_title);
    }

    /**
     * ------------------------------------------------------------------
     *                          Update
     * ------------------------------------------------------------------
     */

    /**
     * Edit a document
     * @param Request $request
     * @return string
     * @throws ValidationException
     */
    public function edit(Request $request, $id)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);
        // Find document and item by id
        $doc = Document::find($id);
        $item = Item::find($doc->item_id);

        // Attributes
        $category = $item->category_id;


        if ($validator->fails()) {
            return redirect()->route('docs.showAdmin', $category)
                ->withInput()
                ->withErrors($validator);
        } else {
            $old_title = $doc->title;

            // New document file submitted
            if ($request->hasFile('new_file')) {
                // Process the submitted file
                $file = $request->file('new_file');
                $file_old = $doc->file;
                $filename = Str::random(15) . '.' . $file->guessExtension();

                // File operations
                $path = '/public/docs/' . $category . '/' . $item->id . '/';
                Storage::delete($path . $file_old);
                Storage::putFileAs($path, $file, $filename);
            } else {
                $filename = $doc->file;
            }

            // Update the data within the DB
            $doc->update([
                'title' => $request->get('title'),
                'file' => $filename,
            ]);

            return redirect()->route('docs.showAdmin', $category)
                ->with('flashType', 'success')
                ->with('message', 'Document ' . $old_title . ' successfully edited.');
        }
    }

    /**
     * ------------------------------------------------------------------
     *                          Delete
     * ------------------------------------------------------------------
     */

    /**
     * Delete a document
     * @param $id
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($id)
    {
        // Objects
        $doc = Document::find($id);
        $item = Item::find($doc->item_id);
        $category = Category::find($item->category_id);

        // Authorization
        //$this->authorize('delete', $doc);

        // Delete the document
        Storage::delete('/public/docs/' . $category . '/' . $item->id . '/' . $doc->file);
        $doc->delete();

        return redirect()->route('docs.showAdmin', $category)
            ->with('flashType', 'success')
            ->with('message', 'Document ' . $doc->name . ' successfully deleted.');
    }
}
