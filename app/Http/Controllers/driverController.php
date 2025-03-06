<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class driverController extends Controller
{
    public function index(){

        return view('driver.awaitingRides');

    }

    public function test(){

        return view('driver.driverRegistration');

    }

    public function driverRegistration(){

        return view('driver.driverRegistration');

    }

    public function driverRegistrationStore(Request $request){
        // dd($request);
        $validated = $request->validate([
            // Driver fields
            'user_id' => 'required|exists:users,id',
            'license_number' => 'required|string|max:255|unique:drivers,license_number',
            'license_expiry' => 'required|date|after:today',
            'license_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
            // Vehicle fields
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:255',
            'plate_number' => 'required|string|max:255|unique:vehicles,plate_number',
            'type' => ['required', Rule::in(['share', 'comfort', 'Black', 'WAV'])],
            'capacity' => 'required|integer|min:1|max:50',
            'vehicle_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'insurance_expiry' => 'required|date|after:today',
            'registration_expiry' => 'required|date|after:today',
        ]);

        // Handle file uploads
        if ($request->hasFile('license_photo')) {
            $validated['license_photo'] = $request->file('license_photo')->store('licenses', 'public');
        }

        if ($request->hasFile('vehicle_photo')) {
            $validated['vehicle_photo'] = $request->file('vehicle_photo')->store('vehicles', 'public');
        }

        // Use a database transaction to ensure both records are created or none
        try {
            DB::beginTransaction();
            
            // Separate driver and vehicle data
            $driverData = [
                'user_id' => $validated['user_id'],
                'license_number' => $validated['license_number'],
                'license_expiry' => $validated['license_expiry'],
                'license_photo' => $validated['license_photo'] ?? null,
            ];
            
            // Create the driver
            $driver = Driver::create($driverData);
            
            // Create the vehicle with the new driver's ID
            $vehicleData = [
                'driver_id' => $driver->id,
                'make' => $validated['make'],
                'model' => $validated['model'],
                'year' => $validated['year'],
                'color' => $validated['color'],
                'plate_number' => $validated['plate_number'],
                'type' => $validated['type'],
                'capacity' => $validated['capacity'],
                'vehicle_photo' => $validated['vehicle_photo'] ?? null,
                'insurance_expiry' => $validated['insurance_expiry'],
                'registration_expiry' => $validated['registration_expiry'],
            ];
            
            $vehicle = Vehicle::create($vehicleData);
            
            DB::commit();
            
            // return response()->json([
            //     'message' => 'Driver and vehicle created successfully',
            //     'driver' => $driver,
            //     'vehicle' => $vehicle
            // ], 201);
            // return redirect(route{{'driver.index'}});
            return redirect()->route('driver.under.review');

            
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Clean up any uploaded files if transaction failed
            if (isset($validated['license_photo'])) {
                Storage::disk('public')->delete($validated['license_photo']);
            }
            if (isset($validated['vehicle_photo'])) {
                Storage::disk('public')->delete($validated['vehicle_photo']);
            }
            
            return response()->json(['message' => 'Failed to create driver and vehicle', 'error' => $e->getMessage()], 500);
        }
       
    }

    public function underReview(){
        return view('driver.underReview');
    }
}
