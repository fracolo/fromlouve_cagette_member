<?php
namespace Louve\Controller;

use Louve\Core\OdooProxy;
use Louve\Model\Session;
use Louve\Model\User;

include $_SERVER['DOCUMENT_ROOT'].'/../application/libs/functions.jsconnect.php';

class SsoController
{
    public function __construct()
    {
        $this->session = new Session();
        //TODO ACL and redirect

    }

    private static function vanilla_auth() {
        $response = NULL;
        $u_conn = new User();
        if ($u_conn->hasData()) {
            $name = $u_conn->getFirstName(). ' '.$u_conn->getLastName();
            $user = array (
                            'uniqueid' => $u_conn->getIdOdoo(),
                            'name'=> $name,
                            'email' => $u_conn->getEmail(),
                            'roles' => "member"
                          );
            $request = $_GET;
            var_dump($u_conn);
            $response = writeJsConnect($user, $request, VANILLA_CID, VANILLA_SECRET);
            
        }
        return $response;
    }

    public function vanilla($string) {
        $elts = explode('?',$string);
        $fn_called = array_shift($elts);
        switch ($fn_called) {
            case 'auth':
             return self::vanilla_auth();
            break;
            case 'signin':
            break;
            case 'subscribe':
            break;
            case 'logout':
            break;

        }
    }
}
?>