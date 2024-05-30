<?php

use App\Models\Contact;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Models\Canton;
use App\Models\Email;
use App\Models\Politician;

Route::get('/', function () {
    $sentEmailsCount = Email::whereNot("sent_at", null)->count();
    return view("landing.index", compact("sentEmailsCount"));
});

Route::get("{darumgehts}", function($slug) {
    return view("pages.info");
})->whereIn("darumgehts", ["darum-gehts", "de-quoi-sagit-il", "informazioni"]);

Route::prefix("app")->group(function() {
    Route::get("/", function() {
        return view("app.index");
    });

    Route::get("/step-2/{contact:uuid}", function(Contact $contact) {
        return view("app.step-2", compact("contact"));
    });

    Route::get("/step-3/{contact:uuid}/{uuid}", function(Contact $contact, $uuid) {
        return view("app.step-3", compact("contact", "uuid"));
    });

    Route::get("/final/{contact:uuid}", function(Contact $contact) {
        return view("app.final", compact("contact"));
    });

    Route::post("/submission/{step}", [AppController::class, "submission"]);
});
