<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Http\Resources\CardCollection;
use App\Card;

class CardController extends Controller
{
    public function store(Request $request) {
        $card = new Card([
            'username' => $request->get('username'),
            'cardnum' => $request->get('cardNum'),
            'cardowner' => $request->get('cardOwner'),
            'cardmonth' => $request->get('cardMonth'),
            'cardyear' => $request->get('cardYear'),
            'cardcvc' => $request->get('cardCvc'),
            'amount' => 0.00
        ]);

        if($card->save())
            return response()->json('success');
        else
            return response()->json('failed');
    }
}
