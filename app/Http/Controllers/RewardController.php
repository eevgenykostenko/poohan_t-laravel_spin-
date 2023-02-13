<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Reward;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::all();
        return view('rewards', ['rewards' => $rewards]);
    }

    public function home()
    {
        $rewards = Reward::all();
        $carousels = Carousel::all();
        return view('home', [
            'rewards' => $rewards,
            'carousels' => $carousels,
        ]);
    }

    /**
     * Handle an authentication attempt.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeRewards(Request $request)
    {
        Reward::truncate(); // delete all rewards

        $fields = ['name', 'percent', 'bg_color', 'text_color'];
        $data = [];
        foreach ($fields as $field) {
            foreach ($request->collect($field) as $key => $value) {
                if ($field === "name") {
                    array_push($data, []);
                }
                $data[$key][$field] = $value;
            }
        }

        Reward::upsert($data, []);

        return back()->with("status", "Rewards updated successfully!");
    }
}



