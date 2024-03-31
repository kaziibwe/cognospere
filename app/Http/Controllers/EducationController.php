<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostUpdateResquest;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EducationController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth:education-api', ['except' => ['educationlogin', 'educationRegister']]);
    }
    // public function Educationregister(PostUpdateResquest $request)
    // {
    //     $education = Education::create($request->all());

    //     if ($education) {
    //         return response()->json([$education, 'status' => true], 200);
    //     } else {
    //         return response()->json(['status' => false], 500);
    //     }

    // }

    public function Educationregister(PostUpdateResquest $request )

    {
        try {
            // $tableName = Education::getTable();
            // $validatedData = $request->validated($tableName);

            $randomCode = '';
            for ($i = 0; $i < 6; $i++) {
                $randomCode .= mt_rand(0, 9); // Append a random digit (0-9) to the code
            }
            $randomCode = 'EDU' . $randomCode;

            // $firstThreeCharacters = substr($randomCode, 0, 3);
            // if ($firstThreeCharacters === 'EDU') {
            //     return response()->json($firstThreeCharacters);
            // }


            // switch ($firstThreeCharacters) {
            //     case 'EDU':
            //         // Handle case where first three characters are 'EDU'
            //         return response()->json('EDU case');
            //         break;

            //     case 'MLH':
            //         // Handle case where first three characters are 'MLH'
            //         return response()->json('MLH case');
            //         break;

            //     default:
            //         // Handle default case (other than 'EDU' and 'MLH')
            //         return response()->json('Default case');
            //         break;
            // }


            $education = Education::create([
                'account_id' => $randomCode,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return $education ?   response()->json([$education, 'status' => true], 200) :  response()->json(['status' => false], 500);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }


    public function Educationlogin(Request $request)
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->guard('education-api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $token;
    }

    public function profileEducation()
    {
        return response()->json(auth()->guard('education-api')->user());
    }

    // admin logout
    public function logoutEducation()
    {
        auth()->guard('education-api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
