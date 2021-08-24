<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Http\Resources\CarResource;

class CarController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cars = $user->cars;
        return CarResource::collection($cars);
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
        ]);
        $car = Car::create([
            'user_id' => auth()->user()->id,
            'first_registration' => $request['first_registration'],
            'vehicle_identification_number' => $request['vehicle_identification_number'],
            'manufacturer_and_brand' => $request['manufacturer_and_brand'],
            'license_number' => $request['license_number'],
            'holder_name' => $request['holder_name'],
            'holder_city' => $request['holder_city'],
            'holder_postcode' => $request['holder_postcode'],
            'holder_street' => $request['holder_street'],
            'owner_name' => $request['owner_name']
        ]);

        return new CarResource($car);
    }
}
