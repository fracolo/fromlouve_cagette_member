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

    private static function getUserImage($id) {
        $public_photo_dir = '/photos';
        $photos_dir = __DIR__.'/../../public'. $public_photo_dir;
        $img_path = '';
        $hash_id = hash('sha256',$id);
        try {
            $jpeg = file_exists($photos_dir.'/'.$hash_id.'.jpeg');
            $png = file_exists($photos_dir.'/'.$hash_id.'.png');
            $real_fname = '';
            if (!$jpeg && !$png) 
            {
                $imgcode = file_get_contents(IMAGE_RETRIEVE_URL . $id);

                if (strlen($imgcode) > 1) {
                    $imgdata = base64_decode($imgcode);
                    $f = finfo_open();
                    $mime_type = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);
                    list($type,$ext) = explode('/',$mime_type);
                    if (in_array($ext, array('jpeg','png'))) {
                        $fn = $hash_id.'.'.$ext;
                        $fp = $photos_dir.'/'.$fn;
                    
                        if (file_put_contents($fp,$imgdata)) {
                            $real_fname = $fn;
                           
                        }
                    }
                    
                    
                }     

                                    
            } else {
               
                $ext = $jpeg?'.jpeg':'.png';
                $real_fname = $hash_id . $ext;
               
               
            }
            
            if (strlen($real_fname) > 1) {
                $img_path = $public_photo_dir.'/'.$real_fname;
            }
        } catch(Exception $e) {
            //Unable to retrieve photo : it's not so important....
        }
        return $img_path;
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
    
            $uniqueid = $u_conn->getIdOdoo();
          
            $name = $u_conn->getFirstName(). ' '.$u_conn->getLastName();
            $user = array (
                            'uniqueid' => $uniqueid ,
                            'name'=> $name,
                            'email' => $u_conn->getEmail(),
                            'roles' => $roles
                          );
            $img = self::getUserImage($uniqueid);

            if (strlen($img)>1 && $uniqueid == 608) {
                $user['photourl'] = 'https://espace-membre.lacagette-coop.fr'.$img;
            }
           
                        
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

    private static function vanilla_logout() {
         $user = new User();
        require APP . 'view/_templates/header.php';
        
        echo "<div class=container>";
        require APP . 'view/sso/logout.php';
        echo "</div>";
        require APP . 'view/_templates/footer.php';
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
               self::vanilla_logout();
            break;

        }
    }
}
?>