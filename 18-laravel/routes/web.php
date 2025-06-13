<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

use function Laravel\Prompts\table;

Route::get('/', function () {
    return view('welcome');
});

Route::get('sayhello/{name}', function () {
    return "<h1>Hello " . request()->name . " 💖</h1>";
});

Route::get('pets/all', function () {
    $pets = App\Models\Pet::all();
    //return var_dump($pets->toArray());
    dd($pets->toArray()); // Dump & Die
});

// Route::get('pets/{id}', function($id) {
//     $pet = App\Models\Pet::find($id);
//     return dd($pet);
// });
Route::get('pets/{id}', function () {
    $pet = App\Models\Pet::find(request()->id);
    dd($pet->toArray());
});

Route::get('petsview', function () {
    $pets = App\Models\Pet::all();
    return view('pets-view')->with('pets', $pets);
});

Route::get('challenge/user', function () {
    $users = User::limit(20)->get();

    $code = "<table style='border-collapse: collapse; margin: 2rem auto; font-family: Arial'>
    <tr>
      <th style='background: gray; color: white; padding: 0.4rem;'>Id</th>
      <th style='background: gray; color: white; padding: 0.4rem;'>Photo</th>
      <th style='background: gray; color: white; padding: 0.4rem;'>Fullname</th>
      <th style='bacground: gray; color: white; pading: 0.4 rem;>Age</th>
      <th style='bacground: gray; color: white; pading: 0.4 rem;>Create At</th>
    </tr>";

    foreach ($users as $user) {
       $code .= ($user->id%2 == 0) ? "<tr style='background: #ddd'>" : "<tr>";
       $code .= ("<td style='border: 1px solid black; padding: 0.4rem;'>{$user->id}</td>");
       $code .= ("<td style='border: 1px solid black; padding: 0.4rem;'><imgages src='{$user->photo}' alt='User Photo' width='50'></td>");
       $code .= ("<td style='border: 1px solid black; padding: 0.4rem;'>{$user->fullname}</td>");
       $code .= ("<td style='border: 1px solid black; padding: 0.4rem;'>{$user->age}</td>");
       $code .= ("<td style='border: 1px solid black; padding: 0.4rem;'>{$user->created_at}</td>");
       $code .= "</tr>";
    }
    return $code .= "</table>";
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
