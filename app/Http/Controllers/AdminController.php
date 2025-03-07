<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Driver;
use App\Models\Passenger;
use App\Models\Vehicle;
use App\Models\Ride;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller


{
    // public function display(){

    //     return view ('admin.x');
    // }
    public function dashboard()
    {
        // Get counts for dashboard stats
        $stats = [
            'total_drivers' => User::where('role', 'driver')->count(),
            'total_passengers' => User::where('role', 'passenger')->count(),
            'pending_drivers' => User::where('role', 'driver')->where('account_status', 'pending')->count(),
            'total_rides' => Ride::count(),
            'completed_rides' => Ride::where('ride_status', 'completed')->count(),
        ];
        
        // Get drivers with their user data
        $drivers = User::where('role', 'driver')
            ->with(['driver', 'driver.vehicle'])
            ->latest()
            ->paginate(10, ['*'], 'drivers_page');
            
        // Get passengers with their user data
        $passengers = User::where('role', 'passenger')
            ->with('passenger')
            ->latest()
            ->paginate(10, ['*'], 'passengers_page');
            
        return view('admin.x', compact('stats', 'drivers', 'passengers'));
    }
    
    public function updateUserStatus(Request $request, User $user)
    {
        $validated = $request->validate([
            'status' => 'required|in:activated,deactivated,suspended,deleted',
        ]);
        
        $user->account_status = $validated['status'];
        
        // Special handling for "deleted" status
        if ($validated['status'] == 'deleted') {
            // We're soft deleting by setting status rather than actually deleting
            $user->email = 'deleted_' . time() . '_' . $user->email;
            $user->phone = 'deleted_' . time() . '_' . $user->phone;
        }
        
        $user->save();
        
        return response()->json([
            'success' => true,
            'message' => 'User status updated successfully',
            'new_status' => $validated['status']
        ]);
    }
    
    public function verifyDriver(Request $request, Driver $driver)
    {
        // Set driver as verified
        $driver->is_verified = true;
        $driver->save();
        
        // Update user status to activated if it was pending
        $user = User::find($driver->user_id);
        if ($user->account_status === 'pending') {
            $user->account_status = 'activated';
            $user->save();
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Driver verified successfully'
        ]);
    }
    
    public function getRides()
    {
        $rides = Ride::with(['passenger.user', 'driver.user'])
            ->latest()
            ->paginate(15);
            
        return view('admin.rides', compact('rides'));
    }
    
    public function getDriverDocuments(Driver $driver)
    {
        $driver->load(['user', 'vehicle']);
        
        return response()->json([
            'driver' => $driver,
            'user' => $driver->user,
            'vehicle' => $driver->vehicle,
            'license_photo_url' => $driver->license_photo ? asset('storage/' . $driver->license_photo) : null,
            'vehicle_photo_url' => $driver->vehicle ? asset('storage/' . $driver->vehicle->vehicle_photo) : null,
        ]);
    }
    
    public function editUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|unique:users,phone,' . $user->id,
        ]);
        
        $user->update($validated);
        
        if ($user->role === 'driver' && $request->has('license_number')) {
            $driver = Driver::where('user_id', $user->id)->first();
            
            if ($driver) {
                $driver->update([
                    'license_number' => $request->license_number,
                    'license_expiry' => $request->license_expiry,
                ]);
                
                if ($request->hasFile('license_photo')) {
                    // Delete old file if exists
                    if ($driver->license_photo) {
                        Storage::disk('public')->delete($driver->license_photo);
                    }
                    
                    $path = $request->file('license_photo')->store('driver_licenses', 'public');
                    $driver->license_photo = $path;
                    $driver->save();
                }
            }
        }
        
        return response()->json([
            'success' => true,
            'message' => 'User updated successfully'
        ]);
    }
    
    public function deleteUser(User $user)
    {
        // Handle soft delete
        $user->account_status = 'deleted';
        $user->email = 'deleted_' . time() . '_' . $user->email;
        $user->phone = 'deleted_' . time() . '_' . $user->phone;
        $user->save();
        
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
    }
}