<?php

namespace Louve\Controller;

use Louve\Core\OdooProxy;
use Louve\Model\Session;
use Louve\Model\User;
use Louve\Model\VanillaAPI;

class DebugController {
    public function vanilla_discussions() {
        $va = new VanillaAPI();
        $va->getDiscussions();
    } 
}