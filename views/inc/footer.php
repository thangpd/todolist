<?php

?>
<footer>
    <p class="italic"><strong><a href="<?= ROOT_URL ?>" title="Homepage">Home Page</a></strong> created for test purpose
        &nbsp; &nbsp;
		<?php if ( is_user_logged_in() ):
			?>
            |  You are connected as <?= get_current_user_name(); ?> - <a href="<?= ROOT_URL ?>?p=login&amp;a=logout">Logout</a> &nbsp; | &nbsp;
            <a href="<?= ROOT_URL ?>?p=calendar&amp;">View All Blog Posts</a>
		<?php else: ?>
            | <a href="<?= ROOT_URL ?>?p=login&amp;a=login">Backend Login</a>
            <a href="<?= ROOT_URL ?>?p=login&amp;a=signup">Backend Create</a>
		<?php endif ?>
    </p>
</footer>
<?php todo_footer(); ?>
</body>
</html>
