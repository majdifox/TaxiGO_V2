<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class driverController extends Controller
{
    public function index(){

        return view('driver.awaitingRides');

    }

    public function test(){

        return view('driver.attentionNeeded');

    }

    public function driverRegistration(){
        // If user is already pending or activated, redirect to appropriate page
        if (Auth::user()->account_status === 'pending') {
            return redirect()->route('driver.under.review');
        }
        
        if (Auth::user()->account_status === 'activated') {
            return redirect()->route('driver.index');
        }
        
        return view('driver.driverRegistration');
    }

    public function driverRegistrationStore(Request $request){
        // Prevent already pending or activated users from submitting again
        if (in_array(Auth::user()->account_status, ['pending', 'activated'])) {
            return redirect()->route(Auth::user()->account_status === 'pending' ? 'driver.under.review' : 'driver.index');
        }
        
        // Validate request
        $validated = $request->validate([
            // Driver fields
            'user_id' => 'required|exists:users,id',
            'license_number' => 'required|string|max:255|unique:drivers,license_number',
            'license_expiry' => 'required|date|after:today',
            'license_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
            // Vehicle fields
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:2005|max:' . (date('Y') + 1),
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
            
            // Update user's account status to 'pending'
            $user = User::find($validated['user_id']);
            $user->account_status = 'pending';
            $user->save();
            
            DB::commit();
            
            // Redirect to the under review page
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
        // Get current authenticated user's status
        $status = Auth::user()->account_status;
        
        // Show different messages based on account status
        $title = 'Your Account is Under Review';
        $message = 'Thank you for registering as a driver with inTime. Our team is currently reviewing your documents and vehicle information.';
        
        if ($status === 'deactivated') {
            // User with deactivated status should be redirected to registration
            return redirect()->route('driverRegistration.create');
        } else if ($status === 'activated') {
            // User with activated status should be redirected to dashboard
            return redirect()->route('driver.index');
        } else if ($status === 'suspended' || $status === 'deleted') {
            return redirect()->route('home')->with('error', 'Your account has been ' . $status . '. Please contact support for assistance.');
        }
        
        return view('driver.underReview', compact('title', 'message', 'status'));
    }
}
