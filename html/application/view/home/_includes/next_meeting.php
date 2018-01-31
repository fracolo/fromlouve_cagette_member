<div class="clearfix"></div>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <!-- <h3  class="entete ui horizontal divider"><strong>Prochaine AG</strong></h3> -->
            <h3  class="entete ui horizontal divider"><strong>Prochaines Agoras</strong></h3>
                        <div class="louve-box">
            <?php
                /**
                $infos = $event->getNextMeeting();
                if (is_object($infos)) {
			        echo ('<h3>' . $infos->info . ' </a></h3>');
		            echo ('<a href="'. $infos->lien . '"><button class="btn btn-default type="submit">Inscription / Ordre du Jour / Questions</button></a>');
                } else {
                    echo "La date sera bientôt définie.";   
                }
                **/
                //echo "La date sera bientôt définie."; 
			?>
                
                <div>
                Jeudi 8 Février 2018 19h45 - Salle de Bridge 30 rue Balard
                </div>
                <h3><strong>Un sujet dont vous souhaitez que l'on parle en Agora ?</strong></h3>
                Remplissez <a href="<?php echo AGORA_FORM;?>">ce formulaire</a>
                <div>
                Le Groupe Agora / AG centralise les suggestions et verra comment le mettre à l'ordre du jour d'une prochaine agora !
                </div>
            </div>
        </div>
           <div class="col-xs-12 col-sm-6">
        <h3  class="entete ui horizontal divider"><strong>Bureau des membres</strong></h3>
        <div class="louve-box">
			<h3><strong> Permanences 11 rue Balard <strong/></h3>
            
            <h4>mercredi - jeudi - vendredi - samedi : 13h30 - 19h</h4>
            <h4>04 11 80 25 31</h4>
           
        </div>
        <div class="louve-box">
            <h3><strong> Planning des Volants <strong/></h3>
            
            <h4><a href="<?php echo PLANNING_VOLANT?>">Accès au document</a></h4>
            
        </div>
    </div>
    </div>
</div>
