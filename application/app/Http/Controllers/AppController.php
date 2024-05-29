<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public static function submission(Request $request, $step)
    {
        switch ($step) {
            case "1":
                $validated = $request->validate([
                    "firstname" => "required",
                    "lastname" => "required",
                    "email" => "required|email",
                    "phone" => "nullable",
                    "canton_id" => "required",
                    "optin" => "",
                ]);
                $validated["optin"] = (bool) $validated["optin"];
                $validated["uuid"] = (string) \Illuminate\Support\Str::uuid();
                $contact = Contact::create($validated);
                return redirect("/app/step-2/$contact->uuid");
            case "2":
                $validated = $request->validate([
                    "politicians" => "required|array",
                    "contact_id" => "required|exists:contacts,id",
                ]);
                $uuid = (string) \Illuminate\Support\Str::uuid();
                $contact = Contact::find($validated["contact_id"]);
                foreach ($validated["politicians"] as $politician) {
                    $email = new \App\Models\Email();
                    $email->uuid = $uuid;
                    $email->politician_id = $politician;
                    $email->contact_id = $validated["contact_id"];
                    $email->save();
                }
                return redirect("/app/step-3/$contact->uuid/$uuid");
            case "3":
                $validated = $request->validate([
                    "email_uuid" => "required|exists:emails,uuid",
                    "contact_uuid" => "required|exists:contacts,uuid",
                    "subject" => "required",
                    "body" => "required",
                ]);
                $emails = \App\Models\Email::where("uuid", $validated["email_uuid"])->get();
                foreach ($emails as $email) {
                    $email->subject = $validated["subject"];
                    if ($email->politician->salutation == "male") {
                        $salutation = __("flood.email.salutation.male") . " " . $email->politician->name;
                    } else if ($email->politician->salutation == "female") {
                        $salutation = __("flood.email.salutation.female") . " " . $email->politician->name;
                    } else {
                        $salutation = __("flood.email.salutation.neutral") . " " . $email->politician->name;
                    }
                    $email->body = str_replace(["[ANREDE]", "[SALUTO]", "[SALUTATION]"], $salutation, $validated["body"]);
                    $email->save();
                }
                return redirect("/app/final/$validated[contact_uuid]");
            default:
                return abort(404);
        }
    }
}
