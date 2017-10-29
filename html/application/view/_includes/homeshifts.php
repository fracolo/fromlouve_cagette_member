<div class="container">
    <div class="col-xs-12 col-sm-5">
    <h3  class="entete ui horizontal divider"><strong>Mon prochain service</strong></h3>
    <div class="louve-creneau">
    <?php

    $shifts = $user->getNextShifts();
	 
    if ( isset($shifts[0]) && null !== $shifts[0])
    {
		
		$myshift = $shifts[0];
        $nexttime = $myshift->date;
		 
        echo ('<h3> '. $nexttime .'</h3>');
        /**
		echo ('<h3> Coordinateurs</h3>');
	    $countCoordinator = count($myshift->coordinators);
            for($j = 0; $j < $countCoordinator ; $j++)
            {
		    echo ($myshift->coordinators[$j]->getFirstname() . " " . $myshift->coordinators[$j]->getLastname()  . "<br>");
			echo ('<a href="mailto:' . $myshift->coordinators[$j]->getEmail() . '">' . $myshift->coordinators[$j]->getEmail() );
            echo ("</a><br>");
		    echo ("<a href='tel:" . $myshift->coordinators[$j]->getPhone()  . "'>" . $myshift->coordinators[$j]->getPhone()  . "</a><br>");
            }
        **/
        echo ("<b>En cas d'absence :</b> votre seule solution est d'échanger votre créneau avec un autre coopérateur. <br />");
        echo ("<b>Pour un échange :</b> pas la peine de contacter le bureau des membres, il ne peut rien pour vous. C'est à vous de trouver un autre coopérateur pour vous remplacer (utilisez le forum en ligne et le tableau blanc). <br />");
        echo ("<b>Pour un retard :</b> pas la peine de nous prévenir. Les retards pénalisent le travail de votre équipe, vous risquez des rattrapages ! <br />");
        echo ("Pour trouver une réponse relative à votre participation, référez vous au manuel des membres : c'est notre bible ! <br/>");
        echo ("Pour toute question spécifique, contactez le bureau des membres :<br />");
        echo ("<b>Par téléphone : </b> 04 11 80 25 31<br />");
        echo ("<b>Sur place : </b>  les mercredi, jeudi, vendredi et samedi entre 13h30 et 19h au bureau des membres, 11 rue Balard. " );
 
    }
    else {
        echo ("<h3>Vous n'êtes inscrit a aucun service.</h3>");
    }
    ?>
  </div>
</div>:

<div>
    <div class="col-xs-12 col-sm-2">
        <h3 class="entete ui horizontal divider"><strong>Semaine<br />en cours</strong></h3>
        <div class="louve-creneau">
        
            <div id="current_week">
                <?php /**echo $user->getCurrentWeek();**/ ?>
            </div>
        
            <a href="pdfs/CalendrierABCD.pdf" target="_blank">Calendrier ABCD</a>
        </div>
    </div>
</div>

<div class="col-xs-12 col-sm-5">
    <h3  class="entete ui horizontal divider"><strong>Le magasin</strong></h3>
    <div class="louve-creneau">
    <?php

	$day = date('D');
	$min = date('i');
	$hrs = date('H');
	if ($day == 'Mon' || $day == 'Tue')
	{
		echo '<h3 style="color : red">Actuellement fermé</h3>';
		echo '<h4>Le magasin est fermé aujourd\'hui. Il ouvrira mercredi.</h4>';
	}
	else if ($day == 'Sun')
	{
		
		echo '<h3 style="color : red">Actuellement fermé</h3>';
		
		/*if ($hrs < 8 OR $hrs > 13)
			echo '<h3 style="color : red">Actuellement fermé</h3>';
		else if ($hrs == 8 AND $min < 30)
			echo '<h3 style="color : red">Actuellement fermé</h3>';
		else if ($hrs == 12 AND $min > 30)
			echo '<h3 style="color : red">Actuellement fermé</h3>';
		else if ($hrs == 12 AND $min < 30)
			echo '<h3 style="color : orange">Fermeture imminente</h3>';
		else 
			echo '<h3 style="color : green">Actuellement ouvert</h3>';
		echo '<h4>Le magasin est ouvert aujourd\'hui de 8h30 à 12h30.</h4>';
		*/
		echo '<h4>Le magasin est fermé aujourd\'hui. Il ouvrira mercredi.</h4>';
	}
	else
	{
		$debut = "08:00:00";
		$imminente = "20:00:00";
		$fin = "21:00:00";

		if (time() >= strtotime($debut) && time() <= strtotime($fin)) {
			if (time() >= strtotime($imminente))
			echo '<h3 style="color : orange">Fermeture imminente</h3>';
			else
			echo '<h3 style="color : green">Actuellement ouvert</h3>';
		}
		else{
			echo '<h3 style="color : red">Actuellement fermé</h3>';
		}
		
		/*

		if ($hrs < 9 OR $hrs > 21)
			echo '<h3 style="color : red">Actuellement fermé</h3>';
		else if ($hrs == 20)
			echo '<h3 style="color : orange">Fermeture imminente</h3>';
		else 
			echo '<h3 style="color : green">Actuellement ouvert</h3>';
			*/
		echo '<h4>Le magasin est ouvert aujourd\'hui de 8h à 21h00.</h4>';
	}
	//echo '<a href="http://www.openstreetmap.org/node/4437524492#map=16/48.8944/2.3530" ><button class="btn btn-default"><span class="glyphicon glyphicon-map-marker"></span> 116 Rue des Poissonniers, 75018 Paris</button></a>';
	echo '<p> Ces horaires sont susceptibles de varier lors de certains évènements. Consultez les urgences pour en savoir plus.</p>';
		
    ?>
    </div>
</div>
