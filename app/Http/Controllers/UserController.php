<?php

namespace App\Http\Controllers;

use App\Models\PersonalInformation;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Retrive personal information
        $personalInformation = PersonalInformation::all();

        return response()->json([
            'status' => 'success',
            'data' => $personalInformation,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Create new personal information
        $user_id = Auth::id();

        try {
            PersonalInformation::create([
                'user_id' => $user_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'date_of_birth' => $request->date_of_birth,
                'NIK' => $request->NIK,
                'phone_number' => $request->phone_number,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Personal information created successfully',
            ], 200);


        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
