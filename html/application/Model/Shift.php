<?php

namespace Louve\Model;


use Louve\Core\OdooProxy;
use Louve\Core\BaseDBModel;
use Louve\Model\Coordinator;
use Louve\Model\User;

// Un import 'use function Mini\Core\formatShifts;' devrait marcher en théorie mais
// Pas avec Mini3, le projet sur lequel on s'est basé !!
// Donc on met les fonctions dans un fichier à part eton importe avec un require à l'ancienne
//include_once(APP . 'helpers/odoo_formatting.php');


/*
 * Infos sur l'utilisateur courant récupérées directement sur le serveur Odoo.
 * AUCUNE DONNEE UTILISATEUR N'EST STOCKEE DANS LA BDD LOCALE MYSQL
 * Utilisation de XMLRPC via la classe OdooProxy
 */
class Shift
{
    /**
     *  @var null
     */
    public $date = null;

    /**
     *  @var null
     */
    public $id = null;
    public $shift_id = null;
    public $shift_ticket_id = null;


    /**
     *  liste des coordinators
     *  @var array
     */
    public $coordinators = array();

    /**
     *
     *  Shift constructor.
     */
    public function __construct()
    {
       
    }

    /**
     *  addCoordinator
     *  @param $coordinator_id
     */
    public function addCoordinator($coordinator_id)
    {
       
        if (is_numeric($coordinator_id)) {
            $proxy = new OdooProxy();
            if ($proxy->connect() === true)
            {
                
                $values = $proxy->getCoordinatorInfo($coordinator_id);
              
                if (isset($values->me['struct']['name'])) {
                    $coordinateur = new Coordinator();
                    $sep = " ";
                    if (strpos($values->me['struct']['name']->me['string'], ', ') !== FALSE) {
                        $sep = ", ";
                    }
                    $coordinateur->setEmail($values->me['struct']['email']->me['string']);
                    $coordinateur->setLastname(explode($sep, $values->me['struct']['name']->me['string'])[0]);
                    $coordinateur->setFirstname(explode($sep, $values->me['struct']['name']->me['string'])[1]);
                    $coordinateur->setPhone(isset($values->me['struct']['phone']->me['string']) ? $values->me['struct']['phone']->me['string'] : null);
                    //Import initial Cagette : seul le champ Phone a été alimenté (sans distinction de type)
                    /*
                    $coordinateur->setPhone(isset($values->me['struct']['mobile']->me['string']) ? $values->me['struct']['mobile']->me['string'] : null);
                    */

                    // Si la connexion réussit, on récupère le coordinateur du shift
                    $this->coordinators[count($this->coordinators)] = $coordinateur;
                }
            }
        }
    }

        // souscription à un ftop shift
    public function subscribe($date_begin, $shift_id, $shift_ticket_id)
    {
     
      $user = new User();
   
      $proxy = new OdooProxy();
      
      $connectionStatus = $proxy->connect();
      $values = $proxy->createFtopShiftRegistration($user->getIdOdoo(),$date_begin, $shift_id, $shift_ticket_id);
      return $values;
 
    }

    public function getDraft()
    {
     
      $user = new User();
      $values = null;
      $proxy = new OdooProxy();
      $connectionStatus = $proxy->connect();
      $values = $proxy->getDraftFtopShiftRegistration($user->getIdOdoo());
      return $values;
 
    }
}
