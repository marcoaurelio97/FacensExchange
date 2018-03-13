<?php
require_once('controller/usuariosController.php');

session_start();
$usuario = $_SESSION['usuario'];
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php?erro=1');
}

if ($_GET['page']=='') {
    header('Location: home.php?page=pagina_inicial');
}

if (verificaCadastroPerfil($usuario) && $_GET['page']=='cadastrar_perfil') {
        header('Location: home.php?page=pagina_inicial');
}
if (!verificaCadastroPerfil($usuario) && $_GET['page']!='cadastrar_perfil') {
    header('Location: home.php?page=cadastrar_perfil');
}

?>

<html lang="en">

<head>
    <title>Connect Facens
        <?php
                                                require_once('controller/usuariosController.php');
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?erro=1');
        }
                                                $id_usuario = $_SESSION['id_usuario'];
                                                $aux = verificaQtdNotificacao($id_usuario);

        if ($aux!=0) {
            echo "($aux)";
        }
                                                
                                                
                                                ?>
                                                </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link href="lib/fa/css/font-awesome.min.css" rel="stylesheet">
    <!-- bootstrap - link cdn -->
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="lib/body.css">
    <link rel="stylesheet" href="lib/home_css.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/linearicons/style.css">
    <link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="assets/css/demo.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <!-- NAVBAR -->
        <nav class="navbar navbar-default navbar-fixed-top">
        <div class="brand">
                <a href="index.html"><img src="imagens/logo_site.png" alt="Connect Facens" class="img-responsive logo"></a>
            </div>
            <div class="container-fluid"  style="margin-top: 20px;">
                <div class="navbar-btn">
                    <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
                </div>
                <form class="navbar-form navbar-left" name="frmBusca" method="POST" id="form_pesquisar">
                    <div class="input-group">
                        <input type="text" value="" id="pesquisar_txt" name="pesquisar_txt" class="form-control" placeholder="Digite um nome">
                        <span class="input-group-btn"><button id="btn_pesquisar" type="button" class="btn btn-primary"><span clas="glyphicon glyphicon-search"></span> Pesquisar</button></span>
                    </div>
                </form>
                
                <div id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                <i class="lnr lnr-alarm"></i>
                                <span class="badge bg-danger">

                                <?php
                                                require_once('controller/usuariosController.php');
                                if (!isset($_SESSION['usuario'])) {
                                    header('Location: index.php?erro=1');
                                }
                                                $id_usuario = $_SESSION['id_usuario'];
                                                $aux = verificaQtdNotificacao($id_usuario);
                                                echo $aux;
                                                ?>


                                </span>
                            </a>
                            <ul class="dropdown-menu notifications">
                                <li>

                                <div id="notificacao"></div>
                                

                                </li>
                                <?php
                                 require_once('controller/usuariosController.php');
                                if (!isset($_SESSION['usuario'])) {
                                    header('Location: index.php?erro=1');
                                }
                                                 $id_usuario = $_SESSION['id_usuario'];
                                                 $aux = verificaQtdNotificacao($id_usuario);
                                if ($aux==0) {
                                    echo '<li><a href="#" class="notification-item"><span ></span>Não há notificações.</a></li>';
                                }
                                                    ?>
                            
                                
                            </ul>
                        </li>
                        <li><button type="button" style="margin-top: 22px;" class="btn btn-primary add-project" 
                        <?php
                        require_once('controller/usuariosController.php');

                        $id_usuario = $_SESSION['id_usuario'];
                                  
                        $resultado = retornaInfoUsuario($id_usuario);

                        if (count($resultado) <= 0) {
                            echo 'disabled'; 
                        }
                                                  


                        ?> 
                         data-toggle="modal" data-target="#add_project">Adicionar Postagem</button>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img 
                            
                            <?php
                            require_once('controller/usuariosController.php');
                            $id_usuario = $_SESSION['id_usuario'];
                            if (verificaImagemPerfil($id_usuario)) {
                                $img = retornaImagemPerfil($id_usuario);
                                echo 'src="imagens/users/'.$id_usuario.'/'.$img.'"';
                            } else {
                                echo 'src="imagens/users/user_img.jpg"';
                            }
?>
 class="img-circle" alt="Usuário"> <span> 
 
    <?php

                      require_once('controller/usuariosController.php');

                      $id_usuario = $_SESSION['id_usuario'];
                                  
                      $resultado = retornaInfoUsuario($id_usuario);

    if (count($resultado) > 0) {
        $var = $resultado[0];
        $nome = $var[0];

        echo $nome;
    } else {
    }

                        ?>
                        
                        </span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="home.php?page=meu_perfil"><i class="lnr lnr-user"></i> <span>Meu Perfil</span></a></li>
                                
                                <li><a href="sair.php"><i class="lnr lnr-exit"></i> <span>Sair</span></a></li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END NAVBAR -->
        <!-- LEFT SIDEBAR -->
        <div id="sidebar-nav" class="sidebar">
            <div class="sidebar-scroll">
                <nav>
                    <ul class="nav">
                        <li><a href="home.php?page=pagina_inicial" style="margin-top: 10px;" class="active"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
                        <li><a href="home.php?page=amigos" class=""><i class="fa fa-users"></i> <span>Amigos</span></a></li>
                        <li><a href="home.php?page=ver_perfil" class=""><i class="fa fa-user"></i> <span>Meu Perfil</span></a></li>
                        <li><a href="#" class=""><i class="fa fa-cog"></i> <span>Configuração</span></a></li>                       
                        <li>
                            <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="fa fa-external-link"></i> <span>Links</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="subPages" class="collapse ">
                                <ul class="nav">
                                <li><a target="_blank" href="http://www.facens.br/" class="">Facens</a></li>   
                                    <li><a target="_blank" href="http://blackboard.facens.br/" class="">Blackboard</a></li>
                                                                    
                                </ul>
                            </div>
                        </li>                     
                    </ul>
                </nav>
            </div>
        </div>
        <!-- END LEFT SIDEBAR -->
        <!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <!-- OVERVIEW -->
                    
                    <div id="div_home">                 
                    
                    <?php

                    if (isset($_GET['page'])) {
                        $p = $_GET['page'];
                        include($p.".php");
                    }

                    ?>
                   

                        
                    </div>
                    </div>
                    </div>
                    </div>
                           
        <div class="clearfix"></div>
        <footer>
            <div class="container-fluid">
                <p class="copyright">&copy; 2017 <a href="wwww.connectfacens.com.br" target="_blank">Connect Facens</a>. Todos direitos reservados.</p>
            </div>
        </footer>
    </div>
    <!-- END WRAPPER -->
    <!-- Javascript -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="assets/vendor/chartist/js/chartist.min.js"></script>
    <script src="assets/scripts/klorofil-common.js"></script>
    
   
    <!-- Modal -->
        
    <div id="add_project" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header login-header">
                        <button type="button" class="close"  data-dismiss="modal">×</button>
                        <h4 class="modal-title">Adicionar Postagem</h4>
                    </div>
                    <form method="POST" id="form_post" enctype="multipart/form-data">
                    <div class="modal-body">

                    
<div class="row">
<div class="col-md-1" style="margin-right: 5px;">
<img class="img-circle" width="50" height="50" 

    <?php
    require_once('controller/usuariosController.php');
    $id_usuario = $_SESSION['id_usuario'];
    if (verificaImagemPerfil($id_usuario)) {
        $img = retornaImagemPerfil($id_usuario);
        echo 'src="imagens/users/'.$id_usuario.'/'.$img.'"';
    } else {
        echo 'src="imagens/users/user_img.jpg"';
    }
?>

>
</div >
<div class="col-md-10" style="width:90%;">
<input  style="margin-top: 0px;width: 100%;" id="titulo_post" type="text" placeholder="Titulo" id="titulo_post" name="titulo_post">
</div>
</div>
                    
                        

                        <textarea required id="texto_post" id="texto_post" name="texto_post" style="resize: none;" placeholder="Descrição"></textarea>
                        <label class="btn btn-danger btn-block btn-file" style="margin-top:10px;">Adicionar Imagem&nbsp;&nbsp;<i class="fa fa-file-image-o"></i>
                        <input type="file" id="imagem" style="display:none;" name="imagem" multiple accept='image/*'/>
                        </label>
                    </div>
                    <div class="modal-footer">                  
                        
                        <button type="button" class="cancel" data-dismiss="modal">Fechar</button>
                        <button type="submit" id="btn_post" class="add-project" data-dismiss="modal">Postar</button>

                    </div>
                    </form>
                </div>

            </div>
        </div>
</body>

<script src="lib/bootstrap2/js/jquery.min.js" type="text/javascript"></script>
    <script src="lib/bootstrap2/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="lib/pesquisar_script.js" type="text/javascript"></script>
    <script src="lib/post_script.js" type="text/javascript"></script>
    <script src="lib/notificao_script.js" type="text/javascript"></script>
    <script src="lib/img_perfil.js" type="text/javascript"></script>
    <script src="lib/amigos_script.js" type="text/javascript"></script>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</html>