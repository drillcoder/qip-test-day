<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Check;
use App\ProxyCheck;
use ErrorException;
use Illuminate\Http\Request;

class ProxyCheckerController extends Controller
{
    public function form()
    {
        return view('proxy_checker.form');
    }

    public function check(Request $request)
    {
        $loading_time = microtime(true);
        $proxy_list = explode("\n", $request->input('proxy'));
        $result_list = [];
        $working_proxy = 0;
        $check = new Check;
        $check->count_proxy_checks = count($result_list);
        $check->count_working_proxy = $working_proxy;
        $check->time = 0;
        $check->save();
        foreach ($proxy_list as $proxy) {
            $proxy_check = $this->CheckProxy($check, $proxy);
            $proxy_check->save();
            if ($proxy_check->status === 'Работает') {
                $working_proxy++;
            }
            $result_list[] = $proxy_check;
        }
        $check->count_proxy_checks = count($result_list);
        $check->count_working_proxy = $working_proxy;
        $check->time = floor((microtime(true) - $loading_time) * 1000);
        $check->save();
        return view('proxy_checker.result', [
            'proxy_list' => $result_list,
            'count_proxy_checks' => count($result_list),
            'count_working_proxy' => $working_proxy,
        ]);
    }

    private function CheckProxy(Check $check, $proxy): ProxyCheck
    {
        $loading_time = microtime(true);
        $proxy = trim($proxy);
        $proxy_a = explode(':', $proxy);
        $ip = $proxy_a[0] ?? '';
        $port = (int)$proxy_a[1];
        $check_time = microtime(true);
        $check_http_proxy = $this->CheckHttpProxy($proxy);
        $timeout = floor((microtime(true) - $check_time) * 1000);
        $proxy_check = new ProxyCheck;
        $proxy_check->check_id = $check->id;
        $proxy_check->proxy = $proxy;
        $proxy_check->location = $this->getLocation($ip);
        $proxy_check->real_ip = '';
        if ($check_http_proxy) {
            $proxy_check->type = 'HTTP';
            $proxy_check->status = 'Работает';
            $proxy_check->timeout = $timeout;
            $proxy_check->time_checked = floor((microtime(true) - $loading_time) * 1000);
            return $proxy_check;
        }
        $check_time = microtime(true);
        $check_socks_proxy = $this->CheckSocksProxy($ip, $port);
        $timeout = floor((microtime(true) - $check_time) * 1000);
        if ($check_socks_proxy) {
            $proxy_check->type = 'SOCKS';
            $proxy_check->status = 'Работает';
            $proxy_check->timeout = $timeout;
            $proxy_check->time_checked = floor((microtime(true) - $loading_time) * 1000);
            return $proxy_check;
        }
        $proxy_check->type = '';
        $proxy_check->status = 'Не работает';
        $proxy_check->timeout = 0;
        $proxy_check->time_checked = floor((microtime(true) - $loading_time) * 1000);
        return $proxy_check;
    }

    private function CheckHttpProxy($proxy): bool
    {
        $url = "http://drillphoto.ru/";
        $theHeader = curl_init($url);
        curl_setopt($theHeader, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($theHeader, CURLOPT_TIMEOUT, 10);
        curl_setopt($theHeader, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($theHeader, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($theHeader, CURLOPT_PROXY, $proxy);
        return curl_exec($theHeader) !== false;
    }

    private function CheckSocksProxy($host, $port): bool
    {
        try {
            if ($fp = fsockopen($host, $port, $errCode, $errStr, 10)) {
                fclose($fp);
                return true;
            }
        } catch (ErrorException $e) {
        }
        return false;
    }

    private function getLocation($ip)
    {
        return json_decode(
            file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip),
            false
        )->geoplugin_countryName;
    }
}
