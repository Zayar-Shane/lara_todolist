<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //customer create Page
    public function create()
    {
        $posts = Post::when(request('searchKey'), function ($query) {
            $searchKey = request('searchKey');
            $query->orWhere('title', 'like', '%' . $searchKey . '%')
                ->orWhere('description', 'like', '%' . $searchKey . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(2);
        return view('create', compact('posts'));
    }

    // post create
    public function postCreate(Request $request)
    {
        $this->checkValidation($request);
        $data = $this->getPostData($request);
        Post::create($data);
        return redirect()->route('post#createPage')->with(["insertSuccess" => "Post ဖန်တီးခြင်း အောင်မြင်ပါသည်။"]);

    }

    // delete user data
    public function delete($id)
    {
        // first way
        // Post::where('id', $id)->delete();
        // return back();
        Post::find($id)->delete();
        return redirect()->route('post#createPage')->with(["deleteSuccess" => "Data အောင်မြင်စွာ ဖျက်ပြီးပါပြီ။"]);
    }

    // details of user data
    public function updatePage($id)
    {
        $post = Post::where('id', $id)->first();
        return view('update', compact('post'));
    }

    // edit details of user data
    public function editPage($id)
    {
        $post = Post::where('id', $id)->first()->toArray();
        return view('edit', compact('post'));
    }

    // update details of the data
    public function update(Request $request)
    {
        $this->checkValidation($request);
        $data = $this->getPostData($request);
        $id = $request->postID;
        Post::where('id', $id)->update($data);
        return redirect()->route('post#createPage')->with(["updateSuccess" => "Update လုပ်ခြင်း အောင်မြင်ပါသည်။"]);
    }

    // get post Data
    private function getPostData($request)
    {
        $response = [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'price' => $request->postFee,
            'address' => $request->postAddress,
            'rating' => $request->postRating,
        ];

        return $response;

    }

    // checks validation
    private function checkValidation($request)
    {
        $validate_rule = [
            'postTitle' => 'required|min:5|unique:posts,title,' . $request->postID,
            'postDescription' => 'required|min:5',
            'postFee' => 'required|min:4',
            'postAddress' => 'required',
            'postRating' => 'required|max:1',
        ];

        $validationMess = [
            'postTitle.required' => "Post Title ဖြည့်ရန်လိုအပ်ပါသည်။",
            'postTitle.min' => "အနည်းဆုံ ၅လုံး ရှိရမည်။",
            'postTitle.unique' => "Post Title တူနေပါသည်။ ထပ်မံစမ်းကြည်ပါ။",
            'postDescription.required' => "Post Description ဖြည့်ရန်လိုအပ်ပါသည်။",
            'postFee.required' => "Post တန်ကြေး ဖြည့်ရန်လိုအပ်သည်။",
            'postFee.min' => "Post တန်ကြေးသည် အနည်းဆုံး 4လုံး အထက်ရှိရမည်။",
            'postAddress' => "Address ဖြည့်ရန် လိုအပ်သည်။",
            'postRating' => "Rating ပေးရန်် လိုအပ်သည်။",
            'postRating.max' => "0မှ 5အတွင်း တန်ဖိုးတစ်ခုသာ ပေးရမည်။",
        ];

        Validator::make($request->all(), $validate_rule, $validationMess)->validate();

    }
}
