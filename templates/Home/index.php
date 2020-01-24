<?php $this->title = "Messages" ?>

<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">La list members sur la platform de chat </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="chat-panel panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-comments fa-fw"></i> <strong><?= $user['username'] ?> est connecté</strong>
                        <div class="pull-right">
                            <a id="lienDeco" href="authentication/logout">Logout</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <ul id="users_list" class="chat">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

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
        // cette function pour role de refresh en ajax et récuper les listes des membres (table user)
        function refresh() {
            $.get( "home/showListMembers", function( data ) {
                $( "#users_list" ).html( data );
            });
        }
    });
</script>