<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
       <a class="navbar-brand" href="<?php echo URL; ?>"><img alt="La Cagette" src="<?php echo URL; ?>img/Cagette_logo.png" width="37px"/></a>
       <a class="navbar-brand" href="#">La Cagette</a>
    </div>
</nav>

<div class="jumbotron" style="background-color: #ff4200">

    <!-- Main component for a primary marketing message or call to action -->
    <div class="container">
        <div class="row row-header">
            <div class="col-xs-12 col-sm-8" >
                <h2>Bienvenue dans l'Espace Membre de La Cagette</h2>
                <p style="padding:10px;"></p>
                <p>Nous n'étions pas satisfaits de l'offre alimentaire qui nous &eacute;tait propos&eacute;e,
                alors nous avons d&eacute;cid&eacute; de cr&eacute;er notre propre supermarch&eacute;.</p>
            </div>
            <div class="col-xs-12 col-sm-4" >
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    <form class="form-signin" method="post" action="<?php echo URL; ?>login/sendcredentials">
        <input type="hidden" name="token" value="<?php echo $token ?>" />
        <h3 class="form-signin-heading">Identifiant Cagette</h3>
        <label for="inputID" class="sr-only">Identifiant Membre</label>
        <p>
            <?php if (isset($error_msg)) {echo $error_msg;} ?>
        </p>
        <input type="text" id="inputID" name="login" class="form-control" placeholder="Entrez votre adresse mail" required autofocus>
        <p></p>
        <label for="inputPassword" class="sr-only">Date de naissance (jjmmaaaa)</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Date de naissance (jjmmaaaa)" required>
        <p style="padding:10px;"></p>
        <button class="btn btn-danger btn-block " type="submit">Se connecter</button>
       
        
    </form>

</div> <!-- /container -->
