<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int check_id
 * @property string proxy
 * @property string type
 * @property string location
 * @property string status
 * @property string timeout
 * @property string real_ip
 * @property string time_checked
 * @property string date_time
 */
class ProxyCheck extends Model
{
    public $timestamps = false;
}
