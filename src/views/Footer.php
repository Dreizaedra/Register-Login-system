

    <?php // load les js automatiquement si ils existent
    if (isset($singleton['scripts'][$url])): 
        foreach ($singleton['scripts'][$url] as $js): ?>
            <script type="text/javascript" src="<?= JS . $js; ?>"></script>
        <?php endforeach;
    endif; ?>

</body>
</html>