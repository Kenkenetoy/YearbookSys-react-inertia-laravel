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

    public function bannedUsers()
    {
        $users = User::where('status', 'banned')->get();
        return response()->json($users);
    }


    // UserController.php
    public function approve($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->status = 'approved';
            $user->save();

            return response()->json(['message' => 'User approved successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error approving user', 'error' => $e->getMessage()], 500);
        }
    }


    public function reject($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->status = 'rejected';
            $user->save();

            return response()->json(['message' => 'User rejected successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error rejecting user', 'error' => $e->getMessage()], 500);
        }
    }

    public function ban($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->status = 'banned';
            $user->save();

            return response()->json(['message' => 'User banned successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error banning user', 'error' => $e->getMessage()], 500);
        }
    }

}
