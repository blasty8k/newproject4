<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Assignment: Routing, Requests & Responses

// Task 1: Basic & Named Routes

Route::get('/courses', function () {
    return '<h1>Available Courses</h1>';
})->name('courses');

Route::get('/home', function () {
    return '<a href="' . route('courses') . '">View Courses</a>';
});


// Task 3: Request Object & Query Params

Route::get('/courses/search', function (Request $request) {
    return response()->json([
        'keyword' => $request->query('keyword'),
        'level' => $request->input('level', 'Beginner'),
        'hasKeyword' => $request->has('keyword'),
    ]);
});


// Task 4: Response Helper

Route::get('/courses/featured', function () {
    return response()
        ->json(['message' => 'Featured courses'], 200)
        ->header('X-Course-Source', 'Laravel')
        ->cookie('last_visited', 'featured');
});


// Task 2: Route Parameters & Constraints

Route::get('/courses/category/{category?}', function ($category = null) {
    if ($category) {
        return "Category: $category";
    }

    return 'All categories';
});

Route::get('/courses/{id}/{title}', function ($id, $title) {
    return "Course $id: $title";
})->whereNumber('id')->whereAlpha('title');

Route::get('/courses/{id}', function ($id) {
    return "Course $id";
})->whereNumber('id');


// Task 5: Redirect

Route::redirect('/catalog', '/courses');
