<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admins;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    public function ViewAdmin()
    {
        return view('Admin.admin-login');
    }
    public function checkAdmin(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Get the validated credentials
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        if (Auth::guard('admins')->attempt($credentials)) {
            return view('Admin.dashboard');
        } else {
            return redirect()->back()->withErrors(['email' => 'The provided credentials do not match our records.']);
        }
    }

    public function index()
    {
        // number of posts
        $posts_count = Post::count();

        // number of categories
        $categories_count = Category::count();

        // number of admins
        $admins = Admins::count();

        return view('Admin.dashboard', compact('posts_count', 'categories_count', 'admins'));
    }

    public function GetAdmins()
    {
        $getadmins = Admins::all();
        return view('Admin.admins', compact('getadmins'));
    }

    public function CreateAdmin()
    {
        // to bring all Admins from DB
        $Admins = Admins::all();
        return view('Admin.create_admin', compact('Admins'));
    }


    public function StoreAdmin(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/Admins/create_admin')->with('error', 'Sorry, you need to be logged in to create a post.');
        }

        // Validate the request
        $request->validate([
            'username' => 'required|string|max:25',
            'email' => 'required|email|unique:admins,email|max:35',
            'password' => 'required|string',
        ]);

        // Save the admin data to the database
        Admins::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/Admin')->with('success', 'Admin created successfully!');
    }
    public function showcategory()
    {
        $category = Category::all();
        return view('Admin.Category', compact('category'));
    }
    public function Createcategory(Request $request)
    {
        $category = Category::all();
        return view('Admin.create-category', compact('category'));
    }

    public function StoreCategory(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/Admins/create-category')->with('error', 'Sorry, you need to be logged in to create a post.');
        }

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:25',

        ]);

        // Save the admin data to the database
        Category::create([
            'name' => $request->name,

        ]);

        return redirect('/Admin')->with('success', 'Category created successfully!');
    }

    public function destroy($id)
    {
        $post = Category::find($id);
        $post->delete();
        return redirect('/Admin')->with('delete', 'Category Deleted Successfully!');
    }

    public function UpdateCategory($id)
    {
        $update_category = Category::find($id);
        return view('Admin.Update-Category', compact('update_category'));
    }

    public function Editing(Request $request, $id)
    {
        $singleID = Category::findOrFail($id);
        $singleID->update($request->all());
        $request->validate([
            'name' => "required|string|max:50",
        ]);
        return redirect('/Admin/Show-Categories')->with('Update', 'Category Updated Successfully!');
    }

    public function ShowPosts()
    {
        $admin_posts = Post::all();
        return view('Admin.posts.show-posts', compact('admin_posts'));
    }

    public function DeletePost($id)
    {
        $post = Post::find($id);
        $file_path = public_path('assets/images/' . $post->image);
        unlink($file_path);
        $post->delete();
        return redirect('/Admin/Admin-Posts')->with('delete', 'Post Deleted Successfully!');
    }
}
