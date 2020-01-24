<?php foreach ($messages as $message): ?>
        <!-- les message de user connecter dans une conversation -->
        <?php if ($user['id'] == $message['id_user']): ?>
            <li class="left clearfix">
                <span class="chat-img pull-left">
                    <img src="assets/img/moi.png" alt="User Avatar" class="img-circle"/>
                </span>
                <div class="chat-body clearfix">
                    <div class="header">
                        <strong class="primary-font">
                            <span class="status">
                                <?php if ($message['status'] == true): ?>
                                    <i class="fa fa-circle green"></i>
                                <?php else: ?>
                                    <i class="fa fa-circle orange"></i>
                                <?php endif; ?>
                            </span>
                            <?= $message['username'] ?>
                        </strong>
                        <small class="pull-right text-muted">
                            <i class="fa fa-clock-o fa-fw"></i> <?= $message['created_at'] ?>
                        </small>
                    </div>
                    <p><?= $message['content'] ?></p>
                </div>
            </li>
        <?php else: ?>
            <!-- les message  une conversation  avec laquelle on va discuter -->
            <li class="right clearfix">
                <span class="chat-img pull-right">
                    <img src="assets/img/moi.png" alt="User Avatar" class="img-circle"/>
                </span>
                <div class="chat-body clearfix">
                    <div class="header">
                        <small class=" text-muted">
                            <i class="fa fa-clock-o fa-fw"></i> <?= $message['created_at'] ?>
                        </small>
                        <strong class="pull-right primary-font">
                            <?= $message['username'] ?>
                            <span class="status">
                                <?php if ($message['status'] == true): ?>
                                    <i class="fa fa-circle green"></i>
                                <?php else: ?>
                                    <i class="fa fa-circle orange"></i>
                                <?php endif; ?>
                            </span>
                        </strong>
                    </div>
                    <p class="pull-right"><?= $message['content'] ?></p>
                </div>
            </li>
        <?php endif; ?>
<?php endforeach; ?>

