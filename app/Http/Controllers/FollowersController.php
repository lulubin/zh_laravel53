<?php

namespace App\Http\Controllers;

use App\Notifications\NewUserFollowNotification;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Auth;

class FollowersController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $user = $this->userRepository->byId($request->get('user'));
        $followers = $user->followersUser()->pluck('follower_id')->toArray();
        if(in_array(user('api')->id, $followers)){
            $followed = true;
        }else{
            $followed = false;
        }
        return response()->json(['followed'=>$followed]);
    }

    public function follow()
    {
        $userToFollow = $this->userRepository->byId(request('user'));
        $followed = user('api')->followThisUser($userToFollow->id);
        if(count($followed['attached']) > 0){
            $userToFollow->increment('followers_count');
            $followed = true;
            $userToFollow->notify(new NewUserFollowNotification());
        }else{
            $userToFollow->decrement('followers_count');
            $followed = false;
        }
        return response()->json(['followed'=>$followed]);
    }
}
