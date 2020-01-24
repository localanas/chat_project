<?php $this->title = "T'Chat Test Hiit Consulting" ?>

<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Chat</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="chat-panel panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-comments fa-fw"></i>
                        <strong><?= $user['username'] ?> est connecter </strong>,
                        il/elle discute avec  <strong><?= $otherUser['username'] ?></strong>
                        <div class="pull-right">
                            <a  href="home" title="vous-aimez descuter avec un autre membre ?? click ici!!">list membres</a>/
                            <a  href="authentication/logout" title="se déconnecter">Logout</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <ul id="chat_list" class="chat">

                        </ul>
                    </div>
                    <div class="panel-footer">
                        <form id="postMessage" class="">
                            <div class="input-group">
                                <input id="btn-input" type="text" name="content" class="form-control input-sm"
                                       placeholder="Type your message here..."/>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-warning btn-sm" id="btn-chat">Send</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    // un peu de manipulation de cadre de chat scroll
    var $panel = $('.chat-panel .panel-body');
    $panel.scrollTop = $panel.scrollHeight;

    // la premier function qui va exécuter le dom
    $(document).ready(function () {
        // charge est appeller la function qui recuper les messages en ajax avec un délai de 10000 
        // refresh en temps réal
        refresh();
        setInterval(
            function () {
                refresh();
            }, 10000
        );

        // ajouter les messages a la conversation entre deux utilisateur lors de la soumission de formulaire
        $("#postMessage").submit(function (e) {
            e.preventDefault();
            $.post("chat/addMessage/<?php echo $idConversation; ?>", $(this).serialize(),
                function (data, status) {
                    data = JSON.parse(data);
                    if (data.code === 200) {
                        $('#btn-input').val('');
                        refresh();
                    }
                }
            );
        });

        //récuper tous les messages de la conversation entre deux utilisateur
        function refresh() {
            $.get("chat/chatMessenger/<?php echo $idConversation; ?>", function (data) {
                $("#chat_list").html(data);
            });
        }
    });
</script>