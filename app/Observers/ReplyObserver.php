<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        //XSS 安全威胁 使用 HTMLPurifier 来修复此问题
        $reply->content = clean($reply->content, 'user_topic_body');
    }

    public function created(Reply $reply)
    {
        // $reply->topic->increment('reply_count', 1);
        $reply->topic->reply_count = $reply->topic->replies->count();
        $reply->topic->save();
        // 通知话题作者有新的评论
        $reply->topic->user->notify(new TopicReplied($reply));

    }

    public function updating(Reply $reply)
    {
        //
    }
}