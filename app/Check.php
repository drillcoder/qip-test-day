<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int count_proxy_checks
 * @property int count_working_proxy
 * @property int time
 * @property string date_time
 */
class Check extends Model
{
    public $timestamps = false;

    public function proxyCheck()
    {
        return $this->hasMany(ProxyCheck::class);
    }
}
