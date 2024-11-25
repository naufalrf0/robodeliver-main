<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Show the user management page.
     *
     * @return \Illuminate\View\View
     */
    public function manageUsers()
    {
        $roles = Role::all();
        $users = User::with('roles', 'wallet')->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeUser(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'role' => 'required|exists:roles,name',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole($request->role);

            return response()->json([
                'title' => 'Success',
                'text' => 'User added successfully.',
                'icon' => 'success',
            ]);
        } catch (\Exception $e) {
            Log::error('Error adding user: ' . $e->getMessage());

            return response()->json([
                'title' => 'Error',
                'text' => 'An error occurred while adding the user. Please try again.',
                'icon' => 'error',
            ], 500);
        }
    }

    public function updateUser(Request $request, User $user)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8',
                'role' => 'required|exists:roles,name',
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);

            $user->syncRoles([$request->role]);

            return response()->json([
                'title' => 'Success',
                'text' => 'User updated successfully.',
                'icon' => 'success',
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());

            return response()->json([
                'title' => 'Error',
                'text' => 'An error occurred while updating the user. Please try again.',
                'icon' => 'error',
            ], 500);
        }
    }

    /**
     * Get transaction history for a user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function userTransactions($id)
    {
        try {
            $user = User::with('walletTransactions')->findOrFail($id);

            $transactions = $user->walletTransactions->map(function ($transaction) {
                return [
                    'date' => $transaction->created_at->format('d M Y, H:i'),
                    'type' => ucfirst($transaction->transaction_type),
                    'amount' => $transaction->amount,
                    'status' => ucfirst($transaction->transaction_status),
                ];
            });

            return response()->json($transactions);
        } catch (\Exception $e) {
            Log::error('Error retrieving transactions: ' . $e->getMessage());

            return response()->json([
                'title' => 'Error',
                'text' => 'An error occurred while fetching transactions.',
                'icon' => 'error',
            ], 500);
        }
    }
}
