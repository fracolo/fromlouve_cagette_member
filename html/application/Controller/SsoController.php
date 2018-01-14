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
            $roles = "member";
            $email = $u_conn->getEmail();
            if (in_array($email, VANILLA_MODERATORS)){
                $roles .= ",moderator";
            }
            if (in_array($email, VANILLA_ADMINS)){
                $roles .= ",administrator";
            }

            $name = $u_conn->getFirstName(). ' '.$u_conn->getLastName();
            $user = array (
                            'uniqueid' => $u_conn->getIdOdoo(),
                            'name'=> $name,
                            'email' => $u_conn->getEmail(),
                            'roles' => $roles
                          );
            $request = $_GET;
            var_dump($u_conn);
            $response = writeJsConnect($user, $request, VANILLA_CID, VANILLA_SECRET);
            
        }
        return $response;
    }

    private static function vanilla_signin() {
        if(isset($_GET['redirect'])) {
            $_SESSION['forum_redirect'] = $_GET['redirect'];
        }
        header('location: ' . URL);
    }

    public function vanilla($string) {
        $elts = explode('?',$string);
        $fn_called = array_shift($elts);
        switch ($fn_called) {
            case 'auth':
             return self::vanilla_auth();
            break;
            case 'signin':
              self::vanilla_signin();
            break;
            case 'subscribe':
            break;
            case 'logout':
            break;

        }
    }
}
?>