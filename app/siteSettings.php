<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class siteSettings extends Model
{
    protected $fillable = [
        'site_name',
        'address',
        'phone1',
        'phone2',
        'email1',
        'email2',
        'footer_Description',
        'facebook_link',
        'twitter_link',
        'linkedin_link',
        'google_plus_link',
        'copyright',
        'logo',
    ];
}
