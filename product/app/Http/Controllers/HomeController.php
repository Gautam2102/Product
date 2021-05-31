<?php

namespace App\Http\Controllers;
use App\Event\UserCreate;
use App\Models\Product;
use Auth;
use File;
use Excel;
use App\Imports\EmployeeImport;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    // add Product form
    public function addproduct()
    {
        return view('add-product');
    }

    // insert product
    public function insertproduct(Request $request)
    {

        if ($request->hasFile('file')) {

            if ($jkl = $request->file('file')) {

                foreach ($jkl as $file) {

                    $name = time() . '.' . $file->getClientOriginalName();
                    $file->move('images', $name);
                    $files[] = $name;

                }
            }

        } else {
            $files[] = $request->file;

        }

        $user_id = Auth::user()->id;
        $addproduct = new Product;
        $addproduct->name = $request->name;
        $addproduct->description = $request->description;
        $addproduct->price = $request->price;
        $addproduct->file = json_encode($files);

        $addproduct->user_id = $user_id;
        $addproduct->save();
        event(new UserCreate('one product added'));
        // return redirect('addproduct')->with('success', 'One product added successfully');
    }
    // show product
    public function showproduct()
    {
        $user_id = Auth::user()->id;
        $data = Product::where('user_id', $user_id)->get();
        return view('show-product', ['data' => $data]);
    }
    // view file image and video blade template
    public function imgvid()
    {
        $user_id = Auth::user()->id;
        $data = Product::where('user_id', $user_id)->first();
        $view = json_decode($data->file, true);
        return view('imgvid', ['data' => $view]);
    }

    // edit product
    public function editproduct($id)
    {
        $editproduct = Product::where('id', $id)->first();

        return view('edit-product', ['data' => $editproduct]);

    }

    // upadate product
    public function updateproduct(Request $request)
    {
        $user_id = Auth::user()->id;
        $updateproduct = Product::find($request->id);
        if ($request->hasFile('file')) {
            foreach (json_decode($updateproduct->file) as $image) {

                if (\File::exists(public_path('images/' . $image))) {
                    \File::delete(public_path('images/' . $image));
                }}
            if ($jkl = $request->file('file')) {

                foreach ($jkl as $file) {

                    $name = time() . '.' . $file->getClientOriginalName();
                    $file->move('images', $name);
                    $files[] = $name;
                }
            }
        } 
        if (!$request->hasFile('file')) {
            $files = json_decode($updateproduct->file, true);
        }

        $updateproduct->name = $request->name;
        $updateproduct->description = $request->description;
        $updateproduct->price = $request->price;
        $updateproduct->file = json_encode($files);
      
        $updateproduct->user_id = $user_id;
        $updateproduct->save();
        event(new UserCreate('one product updated'));
        // return redirect('showproduct')->with('success', 'One product added successfully');
    }
    // delete product
    public function deleteproduct($id)
    {
        $editproduct = Product::where('id', $id)->delete();
        event(new UserCreate('one product deleted'));
        // return redirect('showproduct');
    }


    public function importForm(Request $request)
    {
        Excel::import(new EmployeeImport,$request->file);
    
        return redirect('showproduct');
    }

    public function export()
    {
        Excel::download(new showproduct)
    }
}