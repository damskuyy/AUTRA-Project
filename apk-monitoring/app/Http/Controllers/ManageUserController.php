<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        
        // Add initials for each user
        $users->each(function ($user) {
            $user->initials = $this->generateInitials($user->name);
            $user->avatar_color = $this->getAvatarColor($user->role);
        });
        
        return view('manage-user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email_prefix' => 'required|string|max:255',
            'role' => 'required|in:admin,guru,siswa',
            'status' => 'required|in:active,inactive',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create full email
        $email = $request->email_prefix . '@autra.com';

        // Check if email already exists
        if (User::where('email', $email)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Email sudah digunakan!'
            ], 422);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $email,
                'role' => $request->role,
                'status' => $request->status,
                'password' => Hash::make($request->password),
            ]);

            $user->initials = $this->generateInitials($user->name);
            $user->avatar_color = $this->getAvatarColor($user->role);

            return response()->json([
                'success' => true,
                'message' => 'User berhasil ditambahkan!',
                'data' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        $user->initials = $this->generateInitials($user->name);
        $user->avatar_color = $this->getAvatarColor($user->role);

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email_prefix' => 'required|string|max:255',
            'role' => 'required|in:admin,guru,siswa',
            'status' => 'required|in:active,inactive',
            'password' => 'nullable|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create full email
        $email = $request->email_prefix . '@autra.com';

        // Check if email already exists (except current user)
        if (User::where('email', $email)->where('id', '!=', $id)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Email sudah digunakan!'
            ], 422);
        }

        try {
            $user->name = $request->name;
            $user->email = $email;
            $user->role = $request->role;
            $user->status = $request->status;

            // Only update password if provided
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            $user->initials = $this->generateInitials($user->name);
            $user->avatar_color = $this->getAvatarColor($user->role);

            return response()->json([
                'success' => true,
                'message' => 'User berhasil diupdate!',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        try {
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate initials from a full name.
     */
    private function generateInitials($name)
    {
        $words = explode(' ', $name);
        $initials = '';
        
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }
        
        return substr($initials, 0, 2);
    }

    /**
     * Get avatar color based on role.
     */
    private function getAvatarColor($role)
    {
        $colors = [
            'admin' => '#f97316', // Orange
            'guru' => '#3b82f6',  // Blue
            'siswa' => '#10b981', // Green
        ];

        return $colors[$role] ?? '#f97316';
    }
}
