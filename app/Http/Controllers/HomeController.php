<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use app\Models\User;
Use app\Models\Ride;




// class HomeController extends Controller
// {
    // public function index(){

    //     return view('admin.dashboard');

    // }

    // public function index()
    // {
    //     $users = User::with(['driver', 'passenger'])
    //                 ->orderBy('created_at', 'desc')
    //                 ->paginate(10);
        
    //     return view('admin.users.index', compact('users'));
    // }
    
    // /**
    //  * Update user status
    //  */
    // public function updateStatus(Request $request, User $user)
    // {
    //     $validated = $request->validate([
    //         'account_status' => 'required|in:deactivated,pending,activated,suspended,deleted',
    //     ]);
        
    //     $user->update([
    //         'account_status' => $validated['account_status']
    //     ]);
        
    //     return redirect()->route('admin.users.index')
    //                     ->with('success', "User status updated successfully");
    // }
    
    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(User $user)
    // {
    //     return view('admin.users.edit', compact('user'));
    // }
    
    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, User $user)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
    //         'phone' => 'required|string|max:20|unique:users,phone,' . $user->id,
    //         'birthday' => 'nullable|date',
    //         'role' => 'required|in:driver,passenger,admin',
    //         'account_status' => 'required|in:deactivated,pending,activated,suspended,deleted',
    //     ]);
        
    //     $user->update($validated);
        
    //     return redirect()->route('admin.users.index')
    //                     ->with('success', 'User updated successfully');
    // }
    
    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(User $user)
    // {
    //     $user->delete();
        
    //     return redirect()->route('admin.users.index')
    //                     ->with('success', 'User deleted successfully');
    // }

    class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function testx(){
        return view('driver.newRide');


    }


    public function index()
    {
        // Redirect based on user role
        $user = auth()->user();
        
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role == 'driver') {
            return redirect()->route('driver.dashboard');
        } else {
            return redirect()->route('passenger.dashboard');
        }
    }
    
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminDashboard()
    {
        // Get statistics for admin dashboard
        $totalUsers = User::count();
        $totalDrivers = User::where('role', 'driver')->count();
        $totalPassengers = User::where('role', 'passenger')->count();
  
        
        // Get recent users for dashboard
        $recentUsers = User::orderBy('created_at', 'desc')
                         ->take(5)
                         ->get();
        
        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalDrivers', 
            'totalPassengers', 
          
            'recentUsers'
        ));
    }
        public function updateStatus(Request $request, User $user)
    {
        $validated = $request->validate([
            'account_status' => 'required|in:deactivated,pending,activated,suspended,deleted',
        ]);
        
        $user->update([
            'account_status' => $validated['account_status']
        ]);
        
        return redirect()->route('admin.users.index')
                        ->with('success', "User status updated successfully");
    }
}
