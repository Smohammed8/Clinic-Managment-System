<?php

namespace App\Helper;

use Exception;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LDAPHelper
{

    public static function authenticate($credentials)
    {
        $ldapconn = ldap_connect(env('LDAP_HOST'), env('LDAP_PORT'));
        // $ldapconn = ldap_connect(env('LDAP_HOST'), 389);

        $uid = $credentials['username'];
        $password = $credentials['password'];


        try {

            ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
            ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
            $ldapbind = ldap_bind($ldapconn, "uid=$uid,ou=people,dc=ju,dc=edu,dc=et", $password);
            if ($ldapbind) {
                $search = ldap_search($ldapconn, 'dc=ju,dc=edu,dc=et', "uid=$uid");
                $info = ldap_get_entries($ldapconn, $search);
                // dd($info);
                $first_name = $info[0]['givenname'][0];
                $middle_name = 'Unknown';
                $last_name = 'Unknown';
                if (isset($info[0]['sn'])) {
                    if ($info[0]['sn']['count'] > 0) {
                        $middle_name = $info[0]['sn'][0];
                    }
                }
                if (isset($info[0]['sn'])) {
                    if ($info[0]['sn']['count'] > 1) {
                        $last_name = $info[0]['sn'][1];
                    }
                }
                $email = 'Unknown';
                if (isset($info[0]['mail'])) {
                    if ($info[0]['mail']['count'] > 0) {
                        $email = $info[0]['mail'][0];
                    }
                }

                $user = User::where('username', $uid);
                if ($user->count() < 1) {

                    $new_user = user::create(['username' => $uid, 'name' => $first_name . ' ' . $middle_name, 'email' => $email, 'password' => Hash::make($password)]);
                    return $new_user;
                } else {
                    return $user->first();
                }
            } else {
                return new ModelNotFoundException();
            }
        } catch (Exception $e) {


            return 0;
        }
    }
}
