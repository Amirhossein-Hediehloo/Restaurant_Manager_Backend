<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Custom\Utils;
use App\Custom\Validators;
use Illuminate\Http\Request;

class CommentController extends Controller {
    public function store(Request $request, $order_id) {
        $validator = Validators::itemStoreValidator($request);

        if($validator->fails()) {
            return Utils::makeJsonResponse(false, $validator->errors());
        }

        $comment = new Comment();

        $comment->order_id = $order_id;
        $comment->message = $request->message;
        $comment->approved = false;

        try{
            $comment->save();
            return Utils::makeJsonResponse(true, $comment);
        } catch (\Exception $exception){
            return Utils::makeJsonResponse(false, $exception->getMessage());
        }

    }

}
