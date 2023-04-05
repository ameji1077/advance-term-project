<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;

// use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function review(ReviewRequest $request)
    {
        $form = $request->all();
        Review::create($form);
        return redirect('/mypage');
    }
}
