<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //




    public function store(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'comment' => 'required',
        ], [], [
            'comment' => 'Bình luận'
        ]);

        $comment = Comment::create([
            'user_id' => auth()->user()->id,
            'product_id' => $product->id,
            'content' => $validatedData['comment'],
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }


    // reply cmt

    public function relystore(Request $request, $commentId)
    {
        $parentComment = Comment::findOrFail($commentId);
        $validatedData = $request->validate(
            [
                'relycomment.' . $commentId => 'required',
            ],
            [],
            [
                'relycomment.' . $commentId => 'Phản hồi bình luận'
            ]
        );

        Comment::create([
            'user_id' => auth()->user()->id,
            'content' => implode('', $request->input('relycomment')),
            'parent_id' => $parentComment->id,
            'product_id' => $parentComment->product_id,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    //action comment
    function delete( $id)
    {

        $cmt = Comment::find($id);
        if (!$cmt) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $cmt->delete();
        return response()->json(['message' => 'Record deleted successfully'], 200);

    }

}