<?php

namespace App\Repositories;

use App\Topic;

class TopicRepository
{
    public function getTopicsForTagging()
    {
        return Topic::select(['id','name'])
            ->where('name','like','%'.request('q').'%')
            ->get();
    }
}