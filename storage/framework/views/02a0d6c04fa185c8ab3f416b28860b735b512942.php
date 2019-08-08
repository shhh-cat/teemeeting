<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo e(config('app.name')); ?></title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Scripts -->
        <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

        <!-- Styles -->
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
        <style>
            html, body {
                background: #1cefff;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to right bottom, #1cefff, #FFFFFF);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to right bottom, #1cefff, #FFFFFF); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 20px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .links > a:hover {
                color: #000000;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <?php if(Route::has('login')): ?>
                <div class="top-right links">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('app')); ?>"><?php echo app('translator')->getFromJson('item.start'); ?></a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>"><?php echo app('translator')->getFromJson('item.login_button'); ?></a>

                        <?php if(Route::has('register')): ?>
                            <a href="<?php echo e(route('register')); ?>"><?php echo app('translator')->getFromJson('item.register'); ?></a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <a id="changeLanguage" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <?php echo app('translator')->getFromJson('item.language'); ?>: <span class="text-uppercase"><?php echo e(Session::has('web_language') ? Session::get('web_language') : 'EN'); ?></span> <span class="caret"></span>
                    </a>
                    <form class="p-2 dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" action="<?php echo e(route('changeLanguage')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <button class="dropdown-item" type="submit" name="locale" value="en"><span class="flag-icon flag-icon-gb mr-1"></span>English</button>
                            <button class="dropdown-item" type="submit" name="locale" value="vi"><span class="flag-icon flag-icon-vn mr-1"></span>Vietnamese</button>
                    </form>
                </div>
            <?php endif; ?>

            <div class="content">
                <div class="title m-b-md">
                    <?php echo e(config('app.name')); ?>

                </div>

                <div class="links">
                <a class="badge badge-pill badge-primary p-3 text-light" href="<?php echo e(route('login')); ?> "><?php echo app('translator')->getFromJson('item.start'); ?></a>
                    <a href="#"><?php echo app('translator')->getFromJson('item.download'); ?></a>
                    <a href="#"><?php echo app('translator')->getFromJson('item.social'); ?></a>
                    <a href="#"><?php echo app('translator')->getFromJson('item.about'); ?></a>
                </div>
            </div>
        </div>
    </body>
</html>
<?php /**PATH /home/thien-nguyen/Public/teemeeting/resources/views/welcome.blade.php ENDPATH**/ ?>