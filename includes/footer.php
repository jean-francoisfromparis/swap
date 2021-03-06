</main>
<footer class="container-fluid navbar-dark bg-dark text-info text-center fixed-bottom ">
  <div class="row">
    <div class="col-md-4">
    <?php require_once ('fonction.php') ;
    ajouter_vue();
    $vues = nombre_vues();
    ?>
    Il y a <?= $vues ?> visite<?php if ($vues >1): ?>s<?php endif ?> sur le site
    </div>
    <div class="col-md-4">
      <?php echo "Swap.fr ~ 10 Rue de la Bienfaisance ~ 75008 Paris ~ France " ?>
    </div>
    <div class="col-md-4">
      &copy; ~ <?= date('Y') ?> ~ <?php echo "Tous droit réservé "  ?>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<!-- Jquery cdn -->

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src='https://code.jquery.com/jquery-3.2.1.min.js' type='text/javascript'></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
<script src="https://secure-apijs.viamichelin.com/apijsv2/api/js?key=JSV2GP20210620215654904290831666$165380&lang=fra&protocol=https" type="text/javascript"> </script>
<!-- cdn databasetable -->
<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"></script>
<script src="<?php echo URL ?>js/jquery.fancybox.min.js"></script>
<!---JS-->

<script src="<?php echo URL ?>js/swap.js"></script>
<script src="<?php echo URL ?>js/tableau.js"></script>
<script src="<?php echo URL ?>js/star.js"></script>
<script src="<?php echo URL ?>js/geocodage.js"></script>
</body>

</html>