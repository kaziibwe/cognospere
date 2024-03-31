<?php

// namespace App\Services;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;
// use App\Http\Controllers\Controller;
// use App\Models\Education;

// class StoreUser extends Controller
// {
//     public function register(Request $request, $modelClass)
//     {
//         $tableName = (new $modelClass)->getTable(); // Get table name dynamically

//         $validator = Validator::make($request->all(), [
//             'name' => 'required|string',
//             'email' => 'required|email|unique:' . $tableName . ',email',
//             'account_id' => 'required|unique:' . $tableName . ',account_id',
//             'password' => 'required|string|min:6',
//         ]);

//         if ($validator->fails()) {
//             return response()->json(['error' => $validator->errors()->first()], 400);
//         }

//         $user = $modelClass::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'account_id' => $request->account_id,

//             'password' => Hash::make($request->password),
//         ]);


//         if ($user) {
//             return response()->json(['user' => $user, 'status' => true], 200);
//         } else {
//             return response()->json(['status' => false], 500);
//         }
//     }
// }
