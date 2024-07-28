<?php

namespace App\Http\Controllers\posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index()
    {
        $post = Post::all()->take(2);
        $post_2 = Post::take(1)->orderBy('id', 'desc')->get();
        $post_3 = Post::take(2)->orderBy('title', 'desc')->get();


        // business section
        $postbusiness = Post::where('category', 'business')->take(2)->orderBy('id', 'desc')->get();
        $postbusiness_2 = Post::where('category', 'business')->take(2)->orderBy('title', 'desc')->get();

        // random (culture) posts section
        $random = Post::take(4)->orderBy('category', 'desc')->get();

        // Culture section
        $culture = Post::where('category', 'culture')->take(2)->orderBy('id', 'desc')->get();
        $culture_2 = Post::where('category', 'culture')->take(2)->orderBy('category', 'desc')->get();

        // Politics section
        $Politics = Post::where('category', 'Politics')->take(9)->orderBy('created_at', 'desc')->get();

        // Travel section
        $Travel = Post::where('category', 'Travel')->take(1)->orderBy('id', 'desc')->get();
        $Travel_2 = Post::where('category', 'Travel')->take(1)->orderBy('title', 'desc')->get();
        $Travel_3 = Post::where('category', 'Travel')->take(2)->orderBy('description', 'desc')->get();

        return view('posts.index', compact(
            'post',
            'post_2',
            'post_3',
            'postbusiness',
            'postbusiness_2',
            'random',
            'culture',
            'culture_2',
            'Politics',
            'Travel',
            'Travel_2',
            'Travel_3'
        ));
    }

    public function show(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $Author = User::find($post->user_id);
        $pop_post = Post::orderBy('id', 'desc')->take(3)->get();

        $cat_post = DB::table('categories')
            ->join('posts', 'posts.category', '=', 'categories.name') // Ensure this join condition is correct
            ->select(
                'categories.name AS name',
                'categories.id AS id',
                DB::raw('COUNT(posts.category) AS total')
            )
            ->groupBy('posts.category')
            ->get();
        $comments = Comment::where('post_id', $id)->get();
        $number_comments = $comments->count();

        $moreposts = Post::where('category', $post->category)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();

        return view('posts.show', compact(
            'post',
            'Author',
            'pop_post',
            'cat_post',
            'comments',
            'moreposts',
            'number_comments'
        ));
    }
    public function store(Request $request)
    {
        // Create the new comment record
        $store = Comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::user()->id,
            'username' => Auth::user()->name,
            'post_id' => $request->post_id,
        ]);


        // Redirect to the single post view with a success message
        return redirect('/posts/show/' . $request->post_id . '')->with('success', 'Comment added Successfully');
    }


    public function CreatePost()
    {
        // to bring all categories from DB
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }
    public function StorePost(Request $request)
    {

        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/posts/Create-Post')->with('error', 'Sorry, You need to be logged in to create a post.');
        }

        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:100',
            'category' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,avif|max:2048',
        ]);

        // Set the upload path
        $uploadPath = 'assets/images/';
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path($uploadPath), $imageName);

        // Save the post data to the database
        Post::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
            'username' => Auth::user()->name,
            'description' => $request->description,
            'category' => $request->category,
            'image' => $uploadPath . $imageName,
        ]);

        return redirect('/index')->with('success', 'Post created Successfully!');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $file_path = public_path('assets/images/' . $post->image);
        unlink($file_path);
        $post->delete();
        return redirect('/index')->with('delete', 'Post Deleted Successfully!');
    }
    public function Edit($id)
    {
        $update_post = Post::find($id);

        if (!$update_post) {
            return abort(404, 'Post not found.');
        }
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You need to be logged in to edit a post.');
        }

        $categories = Category::all();
        if (Auth::user()->id == $update_post->user_id) {
            return view('posts.edit', compact('update_post', 'categories'));
        } else {
            return abort(403, 'You are not authorized to edit this post.');
        }
    }


    public function Update(Request $request, $id)
    {
        $singleID = Post::findOrFail($id);
        $singleID->update($request->all());
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:100', 'max:100000'],
            'category' => ['required'],
        ]);
        return redirect('/posts/show/' . $singleID->id . '')->with('Update', 'Post Updated Successfully!');
    }

    // Contact Function
    public function contact()
    {
        return view('Contacts.contact');
    }

    // About Function
    public function About()
    {
        return view('About-us.about');
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $result = Post::select()
            ->where('category', 'LIKE', '%' . $search . '%')
            ->get();
        return view('posts.search', compact('result'));
    }
}
