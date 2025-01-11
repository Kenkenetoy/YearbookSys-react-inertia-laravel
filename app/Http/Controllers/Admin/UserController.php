<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function pendingUsers()
    {
        $users = User::where('status', 'pending')->get();
        return response()->json($users);
    }

    public function approvedUsers()
    {
        $users = User::where('status', 'approved')->get();
        return response()->json($users);
    }

    public function rejectedUsers()
    {
        $users = User::where('status', 'rejected')->get();
        return response()->json($users);
    }

    // UserController.php
    public function approve($id)
    {
        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's status to 'approved'
        $user->status = 'approved'; // Adjust 'status' according to your database column
        $user->save();

        // Return a success message
        return response()->json(['message' => 'User approved successfully']);
    }


        public function reject($id)
    {
        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's status to 'rejected'
        $user->status = 'rejected'; // Adjust 'status' according to your database column
        $user->save();

        // Return a success message
        return response()->json(['message' => 'User rejected successfully']);
    }


}
