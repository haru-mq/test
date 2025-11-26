<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Person;
use App\Models\Greeting;

// User情報取得API (認証済みユーザー)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// People API Endpoints
Route::prefix('people')->group(function () {
    // 全ての人を取得
    Route::get('/', function () {
        return response()->json([
            'success' => true,
            'data' => Person::with('greetings')->get()
        ]);
    });

    // 特定の人を取得
    Route::get('/{id}', function ($id) {
        $person = Person::with('greetings')->find($id);

        if (!$person) {
            return response()->json([
                'success' => false,
                'message' => '人が見つかりません'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $person
        ]);
    });

    // 人を作成
    Route::post('/', function (Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $person = Person::create($validated);

        return response()->json([
            'success' => true,
            'message' => '人が作成されました',
            'data' => $person
        ], 201);
    });

    // 人を更新
    Route::put('/{id}', function (Request $request, $id) {
        $person = Person::find($id);

        if (!$person) {
            return response()->json([
                'success' => false,
                'message' => '人が見つかりません'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'role' => 'sometimes|required|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $person->update($validated);

        return response()->json([
            'success' => true,
            'message' => '人が更新されました',
            'data' => $person
        ]);
    });

    // 人を削除
    Route::delete('/{id}', function ($id) {
        $person = Person::find($id);

        if (!$person) {
            return response()->json([
                'success' => false,
                'message' => '人が見つかりません'
            ], 404);
        }

        $person->delete();

        return response()->json([
            'success' => true,
            'message' => '人が削除されました'
        ]);
    });
});

// Greetings API Endpoints
Route::prefix('greetings')->group(function () {
    // 全ての挨拶を取得
    Route::get('/', function () {
        return response()->json([
            'success' => true,
            'data' => Greeting::with('person')->get()
        ]);
    });

    // 特定の挨拶を取得
    Route::get('/{id}', function ($id) {
        $greeting = Greeting::with('person')->find($id);

        if (!$greeting) {
            return response()->json([
                'success' => false,
                'message' => '挨拶が見つかりません'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $greeting
        ]);
    });

    // 挨拶を作成
    Route::post('/', function (Request $request) {
        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'meaning' => 'required|string|max:255',
            'time_of_day' => 'nullable|string|max:255',
            'person_id' => 'nullable|exists:people,id',
        ]);

        $greeting = Greeting::create($validated);

        return response()->json([
            'success' => true,
            'message' => '挨拶が作成されました',
            'data' => $greeting->load('person')
        ], 201);
    });

    // 挨拶を更新
    Route::put('/{id}', function (Request $request, $id) {
        $greeting = Greeting::find($id);

        if (!$greeting) {
            return response()->json([
                'success' => false,
                'message' => '挨拶が見つかりません'
            ], 404);
        }

        $validated = $request->validate([
            'text' => 'sometimes|required|string|max:255',
            'meaning' => 'sometimes|required|string|max:255',
            'time_of_day' => 'nullable|string|max:255',
            'person_id' => 'nullable|exists:people,id',
        ]);

        $greeting->update($validated);

        return response()->json([
            'success' => true,
            'message' => '挨拶が更新されました',
            'data' => $greeting->load('person')
        ]);
    });

    // 挨拶を削除
    Route::delete('/{id}', function ($id) {
        $greeting = Greeting::find($id);

        if (!$greeting) {
            return response()->json([
                'success' => false,
                'message' => '挨拶が見つかりません'
            ], 404);
        }

        $greeting->delete();

        return response()->json([
            'success' => true,
            'message' => '挨拶が削除されました'
        ]);
    });
});
