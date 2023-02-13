<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        return view('carousels.index', ['carousels' => $carousels]);
    }


    public function create()
    {
        return view('carousels.create');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $imageName = time().'.'.$request->image->extension();

        // Public Folder
        $request->image->move(public_path('assets/carousels'), $imageName);

        // //Store in Storage Folder
        // $request->image->storeAs('images', $imageName);

        // // Store in S3
        // $request->image->storeAs('images', $imageName, 's3');

        //Store IMage in DB
        Carousel::create([
            'img_path' => $imageName
        ]);


        return redirect()->route('carousels.index')->with('status', 'Carousel image uploaded Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $carousel = Carousel::find($id);
        unlink(public_path("assets/carousels/$carousel->img_path"));
        $carousel->delete();

        return response()->json([
            'status' => 'Carousel image deleted successfully!'
        ]);
    }
}



