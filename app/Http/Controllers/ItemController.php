<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use App\Item;
use App\Helper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * ================================================================
     *               ITEMS CRUD-Operations
     * ================================================================
     */
    /**
     * ------------------------------------------------------------------
     *                          Read
     * ------------------------------------------------------------------
     */
    public function index()
    {
        $items = Item::all();
        return view('item.index')->with('items', $items);
    }

    /**
     * ------------------------------------------------------------------
     *                          Create
     * ------------------------------------------------------------------
     */

    /**
     * Create an item
     * @param Request $request
     * @return string
     * @throws ValidationException
     */
    public function create(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'item_image' => 'image|dimensions:min_width=500,min_height=500',
        ]);

        if ($validator->fails()) {
            return redirect()->route('item.index')
                ->withInput()
                ->withErrors($validator);
        } else {
            // Attributes
            $category = $request->get('category_id');

            // Create the DB entry
            $item = new Item;
            $item->name = $request->get('name');
            $item->category_id = $category;
            $item->save();

            if ($request->hasFile('item_image')) {

                // Image operations
                $image = $request->file('item_image');
                $image_name = Str::random(15) . '.' . $image->guessExtension();
                $path = '/public/docs/' . $category . '/' . $item->id . '/';
                $external_path = '/storage/docs/' . $category . '/' . $item->id . '/';
                $item->update([
                    'item_image_path' => $external_path,
                    'item_image' => $image_name,
                ]);
                Helper::processImage($image, $image_name, $path, 500, 500);

            } else {
                $item->update([
                    'item_image' => 'item_image_default.jpg',
                    'item_image_path' => '/images/',
                ]);
                Storage::makeDirectory('/public/docs/' . $category . '/' . $item->id . '/');
            }

            return redirect()->route('item.index')
                ->with('flashType', 'success')
                ->with('message', 'Item ' . $item->name . ' successfully created.');
        }
    }


    /**
     * ------------------------------------------------------------------
     *                          Update
     * ------------------------------------------------------------------
     */

    /**
     * Edit an item
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function edit(Request $request, $id)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'item_image' => 'image|dimensions:min_width=500,min_height=500',
        ]);

        // Authorization
        //$this->authorize('edit', $item);


        if ($validator->fails()) {
            return redirect()->route('item.index')
                ->withInput()
                ->withErrors($validator);
        } else {
            // Attributes
            $item = Item::find($id);
            $category = $request->get('category_id');
            $name_old = $item->name;

            // If item has a new category
            if ($item->category_id != $category) {
                $old_path = '/public/docs/' . $item->category_id . '/' . $item->id . '/';
                $path = '/public/docs/' . $category . '/' . $item->id . '/';

                // Add new image path to DB if the standard image isn't used
                if ($item->item_image_path != '/images/') {
                    $doc_path = '/storage/docs/' . $category . '/' . $item->id . '/';
                    $external_path = $doc_path;
                } else {
                    $doc_path = '/storage/docs/' . $category . '/' . $item->id . '/';
                    $external_path = $item->item_image_path;
                }

                $this->updateDocPath($id, $doc_path);
                Storage::move($old_path, $path);

            } else {
                $external_path = $item->item_image_path;
            }

            // New item image submitted
            if ($request->hasFile('new_item_image')) {

                $item_image_old = $item->item_image;
                $image = $request->file('new_item_image');
                $image_name = Str::random(15) . '.' . $image->guessExtension();
                $path = '/public/docs/' . $category . '/' . $item->id . '/';
                $external_path = '/storage/docs/' . $category . '/' . $item->id . '/';

                // Image operations
                $item->update(['item_image_path' => $external_path]);
                Storage::delete($path . $item_image_old);
                Helper::processImage($image, $image_name, $path, 500, 500);

            } else {
                $image_name = $item->item_image;
            }

            // Update the data within the DB
            $item->update([
                'name' => $request->get('name'),
                'category_id' => $category,
                'item_image' => $image_name,
                'item_image_path' => $external_path,
            ]);

            $items = Item::all();
            return redirect()->route('item.index')
                ->with('flashType', 'success')
                ->with('message', 'Item ' . $name_old . ' successfully edited.')
                ->with('items', $items);
        }
    }

    /**
     * Update the doc paths of the updated item
     * @param $id
     * @param $path
     */
    public function updateDocPath($id, $path)
    {
        $docs = Document::all()->where('item_id', $id);

        foreach ($docs as $doc) {
            $doc->file_path = $path;
            $doc->save();
        }
    }

    /**
     * ------------------------------------------------------------------
     *                          Delete
     * ------------------------------------------------------------------
     */

    /**
     * Delete an item
     * @param $id
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($id)
    {
        $item = Item::find($id);

        // Authorization
        //$this->authorize('delete', $item);

        Storage::deleteDirectory('public/docs/' . $item->category_id . '/' . $item->id);
        $item->docs()->delete();
        $item->delete();

        $items = Item::all();
        return redirect()->route('item.index')
            ->with('flashType', 'success')
            ->with('message', 'Item ' . $item->name . ' successfully deleted.')
            ->with('items', $items);
    }
}
