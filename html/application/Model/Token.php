<?php

namespace Louve\Model;

if(!function_exists('hash_equals')) {
      function hash_equals($str1, $str2) {
        if(strlen($str1) != strlen($str2)) {
          return false;
        } else {
          $res = $str1 ^ $str2;
          $ret = 0;
          for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
          return !$ret;
        }
      }
}

/**
 * Generate Token model
 */
class Token extends Session
{
    protected $token;
    
    /**
     *  generateTokea
     *  @return string
     */
    public function generateToken()
    {
        $this->token = bin2hex(openssl_random_pseudo_bytes(32));
        $_SESSION['token'] = $this->token;
        return $this->token;
    }


    /**
    *   getToken
    *
    *   @return string
    */
    public function getToken()
    {
        if (isset($_SESSION['token'])) {
            $this->token = $_SESSION['token'];
            return $this->token;
        } else {
           return '';
        }
    }
    
    /**
     *  checkToken
     *
     *  @param $token (token from form)
     *  @return bool
     */
    public function checkToken($token)
    {
        //check token
        return hash_equals($this->getToken(), $token) ? true : false;
    }

}

