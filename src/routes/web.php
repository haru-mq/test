<?php

use Illuminate\Support\Facades\Route;
use App\Models\Greeting;
use App\Models\Person;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect('/greeting');
});

// API テストページ
Route::get('/api-test', function () {
    return view('api-test');
});

// 人のページ
Route::get('/people', function () {
    $people = Person::with('greetings')->get();
    return view('people', ['people' => $people]);
});

// 挨拶のページ
Route::get('/greeting', function () {
    $greetings = Greeting::with('person')->get();
    return view('greeting', ['greetings' => $greetings]);
});

// 人の入力フォーム
Route::get('/people/create', function () {
    return view('people-create');
});

// 人の保存
Route::post('/people', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'role' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
    ]);

    Person::create($request->all());

    return redirect('/people')->with('success', '人が追加されました');
});

// 挨拶の入力フォーム
Route::get('/greeting/create', function () {
    $people = Person::all();
    return view('greeting-create', ['people' => $people]);
});

// 挨拶の保存
Route::post('/greeting', function (Request $request) {
    $request->validate([
        'text' => 'required|string|max:255',
        'meaning' => 'required|string|max:255',
        'time_of_day' => 'nullable|string|max:255',
        'person_id' => 'nullable|exists:people,id',
    ]);

    Greeting::create($request->all());

    return redirect('/greeting')->with('success', '挨拶が追加されました');
});

// 挨拶の削除
Route::delete('/greeting/{id}', function ($id) {
    $greeting = Greeting::findOrFail($id);
    $greeting->delete();

    return redirect('/greeting')->with('success', '挨拶が削除されました');
});

// 人の削除
Route::delete('/people/{id}', function ($id) {
    $person = Person::findOrFail($id);
    $person->delete();

    return redirect('/people')->with('success', '人が削除されました');
});
