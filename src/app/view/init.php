<?php ob_start() ?>
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Jhonatan Ruiz</h1>
    <p class="lead"> <?= $params['mensaje'] ?></p>
    <p class="lead"> <?= $params['mensaje2'] ?></p>
    <p class="lead"> <?= $params['mensaje3'] ?>
        <a class="linkedin" href="<?= $params['linkedin'] ?>"><i class="fab fa-linkedin"></i></a>
    </p>
    <p>Puede ver este proyecto y otros que hice en mi github <a href="https://github.com/xjhruiz"><i class="fab fa-github"></i></a></p>
</div>
<?php $contenido = ob_get_clean() ?>

<?php include   'layoutmain.php'; ?>

</body>

</html>