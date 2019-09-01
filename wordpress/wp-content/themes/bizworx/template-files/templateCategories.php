<?php // Template name: Categories
	get_header();
	define('URL', 'http://diploma.work/uploads/');
	require('api/logicCategories.php');
?>
    <style>
        <?php require_once('css/categories.css'); ?>
    </style>
    <div class="section pt-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4">
					<?php if ($messageCategory == null): ?>
                        <h2>Наставен кадар</h2>
                        <!-- menu -->
                        <ul>
							<?php foreach ($categories as $k => $category): ?>
                                <li>
                                    <a href="<?= '../teachers?c=' . $category["id"] ?>">
										<?= $category["name"] ?>
                                    </a>
                                </li>
							<?php endforeach; ?>
                        </ul>
					<?php else: ?>
                        <h5><?= $messageCategory ?></h5>
					<?php endif; ?>
                    <hr>
                </div>
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <!-- users -->
                    <div class="row text-center">
						<?php if ($messageUsers == null && isset($teachers)): ?>
							<?php foreach ($teachers as $k => $teacher): ?>
                                <div class="col-sm-12 col-md-4 col-lg-3">
									<?php if ($teacher['img'] == null or $teacher['img'] == ''): ?>
                                        <img src="https://i.ibb.co/VHsf8xC/slika-1.jpg" alt="profile-img" border="0"
                                             class="center profile">
									<?php else: ?>
                                        <img src="<?= constant('URL') . $teacher['img']; ?>" alt="profile-img"
                                             border="0"
                                             class="center profile">
									<?php endif; ?>
                                    <p class="small">
                                        <a href="<?= '../teacher?t=' . $teacher['id'] ?>">
											<?= $teacher['fullName']; ?>
                                        </a>
                                    </p>
                                </div>
							<?php endforeach; ?>
						<?php else: ?>
                            <h4><?= $messageUsers ?></h4>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>