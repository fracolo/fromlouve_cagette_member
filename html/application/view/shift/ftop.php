<div class="container">
    <div class="row">
    <div class="col-xs-12">
        <h3  class="entete ui horizontal divider"><strong>Services volants disponibles</strong></h3>
        <p>Vous êtes "volant" ? Inscrivez-vous à un des services suivants pour effectuer vos 3 heures mensuelles.</p>
            <div class="louve-creneau">
                <div class = "table-responsive">
                <table class = "table">
                <thead>
                <tr>
                    
                    <th>Date</th>
                    <th>Heure de début</th>
                    <th>Places disponibles</th>
                    <th>Inscription</th>
                </tr>
                </thead>
                <tbody>
                <?php
                for($i = 0; $i < count($ftopShiftDisplays); $i++)
                {
                    $shiftDisplay = $ftopShiftDisplays[$i];
                    echo ($shiftDisplay);
                }
                ?>
                </tbody>
                </table>
                </div>
            </div>
        </div>
  

    </div>
</div>
