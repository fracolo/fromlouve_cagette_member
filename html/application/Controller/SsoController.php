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
        $request = $_GET;
        $u_conn = new User();
        $user = array (
                            
                            'name'=> '',
                            'email' => ''
                          );
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
           
                        
        }
        return writeJsConnect($user, $request, VANILLA_CID, VANILLA_SECRET);
    }

    private static function vanilla_signin() {
        $u_conn = new User();
        if ($u_conn->hasData()) {
            header('location: ' . $_GET['redirect']);
        }
        else {
            if(isset($_GET['redirect'])) {
                $_SESSION['forum_redirect'] = $_GET['redirect'];
            }
            header('location: ' . URL);
        }
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