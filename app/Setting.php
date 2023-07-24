<?php

namespace App;

class Setting
{
    protected $allowed = ['city','bio'];

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function merge(array $attribute)
    {
        $setting = array_merge($this->user->setting, array_only($attribute,$this->allowed));
        return $this->user->update(['setting'=>$setting]);
    }
}