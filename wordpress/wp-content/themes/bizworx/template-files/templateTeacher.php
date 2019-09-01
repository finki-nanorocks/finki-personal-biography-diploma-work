<?php // Template name: Teacher
	get_header();
	if (!isset($_GET['t'])) {
		header('Location: /');
		exit;
	}
	require('api/logicTeacher.php');
?>
    <style>
        <?php require_once('css/teacher.css'); ?>
    </style>
    <div class="section pt-5 mt-5">
        <div class="container">
            <div class="row">
				<?php if ($messageUser == null && isset($teacher)): ?>
                    <div class="col-sm-12 col-md-4 col-lg-4 pb-info">
                        <div class="card user-info">
							<?php if ($teacher['user']['img'] == null or $teacher['user']['img'] == ''): ?>
                                <img src="https://i.ibb.co/VHsf8xC/slika-1.jpg" alt="avatar" border="0"
                                     class="center profile-img">
							<?php else: ?>
                                <img src="<?= constant('URL') . $teacher['user']['img']; ?>" alt="profile-img"
                                     class="center profile-img">
							<?php endif; ?>

                            <p class="text-center teacher-name">
								<?= $teacher['user']['fullName']; ?>
                            </p>
                            <p class="text-center">
                                <a href="mailto:<?= $teacher['user']['email']; ?>">
                                    <span class="text-center small text-primary"><?= $teacher['user']['email']; ?></span>
                                </a>
                            </p>
                            <input type="hidden" name="repoId" id="repoId" value="<?= $teacher['user']['repoId']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <!-- users -->
                        <div class="row text-center">
                            <div class="tab">
                                <button class="tablinks active" onclick="openTab(event, 't1')">Резиме</button>
                                <button class="tablinks" onclick="openTab(event, 't2')">Предмети</button>
                                <button class="tablinks" onclick="openTab(event, 't3')">Публикации</button>
                            </div>

                            <!-- Tab content -->
                            <div id="t1" class="tabcontent text-left">
                                <p class="small">
									<?php if (isset($teacher['user']['text'])): ?>
										<?= $teacher['user']['text'] ?>
									<?php else: ?>
										<?= 'Нема внесени податоци.' ?>
									<?php endif; ?>
                                </p>
                                <div style="overflow-x:auto;">
                                    <table class="table table-striped">
                                        <tr class="small">
                                            <td>Адреса на раб.</td>
                                            <td>
												<?php if (isset($teacher['user']['address'])): ?>
													<?= $teacher['user']['address'] ?>
												<?php else: ?>
													<?= '\\' ?>
												<?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr class="small">
                                            <td>Институција</td>
                                            <td>
												<?php if (isset($teacher['user']['institution'])): ?>
													<?= $teacher['user']['institution'] ?>
												<?php else: ?>
													<?= '\\' ?>
												<?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr class="small">
                                            <td>Катедра</td>
                                            <td>
												<?php if (isset($teacher['user']['department'])): ?>
													<?= $teacher['user']['department'] ?>
												<?php else: ?>
													<?= '\\' ?>
												<?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr class="small">
                                            <td>Соработник / Aсистент</td>
                                            <td>
												<?php if (isset($assistant['user']['fullName'])): ?>
													<?= $assistant['user']['fullName'] ?>
												<?php else: ?>
													<?= '\\' ?>
												<?php endif; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>

                            <div id="t2" class="tabcontent">
								<?php if ($messageSubjects == null && isset($subjects)): ?>
                                    <h5 class="text-left">Предмети</h5>
                                    <div class="overflow-auto">
                                        <table class="table table-striped text-left">
                                            <tr class="small">
                                                <th>#</th>
                                                <th>Име на предмет</th>
                                                <th>Семестар</th>
                                                <th>Статус</th>
                                                <th>Локација</th>
                                            </tr>
											<?php $i = 1; ?>
											<?php foreach ($subjects as $subject): ?>
                                                <tr class="small">
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $subject["title"] ?></td>
                                                    <td><?= $subject["semester"] ?></td>
                                                    <td><?= $subject["status"] ?></td>
                                                    <td><?= $subject["place"] ?></td>
                                                </tr>
											<?php endforeach; ?>
                                        </table>
                                    </div>
								<?php else: ?>
                                    <h4 class="text-center"><?= $messageSubjects; ?></h4>
								<?php endif; ?>
                            </div>

                            <div id="t3" class="tabcontent">
								<?php if ($repoStatus == 404): ?>
                                    <h5 class="text-center"><?= 'Нема внесени податоци.' ?></h5>
								<?php else: ?>
                                    <h5 class="text-left">Публикации</h5>
                                    <div class="overflow-auto">
                                        <table class="table table-striped text-left">
                                            <tr class="small text-left">
                                                <th>#</th>
                                                <th>Има</th>
                                                <th>Издадено на</th>
                                                <th>Линк</th>
                                            </tr>
											<?php $i = 1;?>
                                            <?php if(count($repoData) == 9): ?>
                                                <tr class="small text-center">
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $repoData["name"] ?></td>
                                                    <td><?= explode(" ", $repoData["lastModified"])[0] ?></td>
                                                    <td>
                                                        <a href="https://repository.ukim.mk/handle/<?= $repoData["handle"] ?>">тука</a>
                                                    </td>
                                                </tr>
                                            <?php else: ?>
                                                <?php foreach ($repoData as $publication): ?>
                                                    <tr class="small text-center">
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $publication["name"] ?></td>
                                                        <td><?= explode(" ", $publication["lastModified"])[0] ?></td>
                                                        <td>
                                                            <a href="https://repository.ukim.mk/handle/<?= $publication["handle"] ?>">тука</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </table>
                                    </div>
								<?php endif; ?>
                            </div>
                        </div>
                    </div>
				<?php else: ?>
                    <h3 class="text-center"><?= $messageUser; ?></h3>
				<?php endif; ?>
            </div>
        </div>
    </div>
    <script type="application/javascript">
		<?php require_once('js/teacher.js'); ?>
    </script>
<?php get_footer(); ?>