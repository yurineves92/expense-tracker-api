<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userInfo()
    {
        $user = Auth::user();
        return response()->json(["user" => $user], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if(empty($user)) {
            return response()->json(
                [
                    "data" => [
                        "message" => "User not found.",
                    ],
                ],
                200
            );
        }
        $user->name = $request->name;
        $user->save();
        return response()->json(
            [
                "data" => [
                    "message" => "Information updated successfully.",
                    "data" => $user,
                ],
            ],
            200
        );
    }
    
    public function delete(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(
            [
                "data" => [
                    "message" => "Record deleted successfully.",
                ],
            ],
            200
        );
    }
}
