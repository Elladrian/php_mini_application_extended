<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Models\Offer;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/kontakt', function () {
    return view('contact');
})->name('contact');

Route::get('/oferta', function () {
    if (!Schema::hasTable('offers')) {
        return "Tabela 'offers' nie istnieje. Uruchom 'php artisan migrate'.";
    }
    $offers = Offer::latest()->get();
    return view('offer', ['offers' => $offers]);
})->name('offer');

Route::post('/oferta/dodaj', function (Request $request) {

    $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'price' => 'required|numeric',
    ]);

    $offer = new Offer();
    $offer->title = $request->input('title');
    $offer->description = $request->input('description');
    $offer->price = $request->input('price');
    $offer->save();

    return redirect('/oferta');
})->middleware('auth')->name('offer.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/email-test', function () {
    $mail = new PHPMailer(true);
    $message = "";
    $status = "success"; // lub 'error'

    try {
        // Konfiguracja (bez SMTP dla testu)
        $mail->setFrom('system@miniapp.pl', 'MiniApp System');
        $mail->addAddress('admin@example.com');
        $mail->isHTML(true);
        $mail->Subject = 'Test biblioteki Composer';
        $mail->Body    = '<h1 style="color:blue;">Działa!</h1><p>PHPMailer został poprawnie załadowany przez autoloader.</p>';

        // $mail->send(); // Zakomentowane, żeby nie wyrzucało błędu braku serwera SMTP

        $message = "Sukces! Biblioteka PHPMailer działa poprawnie. Obiekt został utworzony, a wiadomość wygenerowana.";
    } catch (Exception $e) {
        $status = "error";
        $message = "Wystąpił błąd: {$mail->ErrorInfo}";
    }

    return view('email-test', ['message' => $message, 'status' => $status]);
})->name('email.test');

require __DIR__.'/auth.php';
