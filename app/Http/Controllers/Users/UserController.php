<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


class UserController extends Controller
{
    public function EditProfile($id)
    {

        $user = User::findOrFail($id);
        return view('users.update-profile', compact('user'));
    }
    public function UpdateProfile(Request $request, $id)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return back()->with('error', 'Sorry, You need to be logged in to Update Your Information.');
        }

        $request->validate([
            'email'  => 'required|string|email|max:25',
            'name'   => 'required|string|max:25',
            'bio'    => 'required|string|max:255',
        ]);


        $user = User::findOrFail($id);

        if (Auth::user()->id != $user->id) {
            return back()->with('error', 'You are not authorized to update this profile.');
        }

        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->bio = $request->input('bio');
        $user->save();
        return redirect('/index')->with('Update', 'User Information Updated Successfully!');
    }
    public function profile($id)
    {
        $user = User::findOrFail($id);
        $latest_posts = Post::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        return view('users.profile', array('user' => $user, 'latest_posts' => $latest_posts));
    }
    // In your Controller
    public function uploadCertificate(Request $request)
    {
        $request->validate([
            'certificates.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $uploadPath = 'assets/images/certificates';
        $user = Auth::user();
        $certificatePaths = [];

        if ($user) {
            if ($request->hasFile('certificates')) {
                foreach ($request->file('certificates') as $file) {
                    $imageName = time() . '-' . uniqid() . '.' . $file->extension();
                    $file->move(public_path($uploadPath), $imageName);
                    $certificatePaths[] = $uploadPath . '/' . $imageName;
                }
                foreach ($certificatePaths as $path) {
                    $user->certificates()->create([
                        'path' => $path,
                    ]);
                }

                return back()
                    ->with('success', 'You have successfully uploaded the certificates.')
                    ->with('certificate_paths', $certificatePaths);
            } else {
                return back()->with('error', 'No files were uploaded.');
            }
        }

        return back()->with('error', 'User not found.');
    }
}
