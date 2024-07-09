<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EmailVerificationController extends Controller
{
    public function checkEmail(Request $request)
    {
        $exists = User::where('email', $request->email)->exists();
        return response()->json(['exists' => $exists]);
    }
}
