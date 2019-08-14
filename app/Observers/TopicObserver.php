<?php

namespace App\Observers;

use App\Models\Topic;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }

    public function saving(Topic $topic)
    {
        // HTMLPurifier for Laravel 是对 HTMLPurifier 针对 Laravel 框架的一个封装。本章节中，我们将使用此扩展包来对用户内容进行过滤
        $topic->body = clean($topic->body, 'user_topic_body');
        //excerpt 字段存储的是话题的摘录，将作为文章页面的 description 元标签使用，有利于 SEO 搜索引擎优化。
        $topic->excerpt = make_excerpt($topic->body);
    }
}