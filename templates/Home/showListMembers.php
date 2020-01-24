<?php foreach ($users as $user): ?>
    <li class="left clearfix">
        <a href="chat/<?= $user['id'] ?>" style="display: block">
            <span class="chat-img pull-left">
            <img src="assets/img/vous.png" alt="User Avatar" class="img-circle"/>
        </span>
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font"><?= $user['username'] ?></strong>
                </div>
                <div>
                <span class="status">
                    <?php if ($user['status'] == true): ?>
                        <i class="fa fa-circle green"></i> Online
                    <?php else: ?>
                        <i class="fa fa-circle orange"></i> Offline
                    <?php endif; ?>
                </span>
                </div>
            </div>
        </a>
    </li>
<?php endforeach; ?>