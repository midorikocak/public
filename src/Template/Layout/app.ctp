
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('foundation.css') ?>
    <?= $this->Html->css('foundation-icons.css') ?>
    <?= $this->Html->css('app.css') ?>

    <?= $this->Html->script('modernizr'); ?>
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>
        <div class="small-12">
            <nav class="top-bar" data-topbar role="navigation">


                <section class="top-bar-section">
                    <!-- Right Nav Section -->
                    <ul class="full-width">
                        <ul class="title-area">
                            <li class="name">
                                <h1><a href="<?= $this->Url->build('/')?>">GSXE</a></h1>
                            </li>
                            <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
                        </ul>


                        <li class="has-form large-5">
                            <?php
                            $this->Form->templates([
                                'label' => '<label class="inline right" {{attrs}}>{{text}}</label>',
                                'formGroup' => '<div class="small-12 columns">{{label}}{{input}}</div>',
                                'inputContainer' => '<div class="input {{type}}{{required}}">{{content}}</div>',
                                'formstart' => '<form{{attrs}}><div class="row"><div class="small-12">',
                                'formend' => '</div></div></form>'
                                    ]);
                                ?>
                                <?php echo $this->Form->create('Account', ['type' => 'post','controller'=>'accounts','action'=>'../accounts/search']);
                                echo $this->Form->input('keyword',['label'=>false,'placeholder'=>__('Search')]);
                                ?>
                                <?= $this->Form->end(); ?>


                            </li>

                            <ul class="right">
                                <li><a href="<?= $this->Url->build(['controller'=>'currencies','action'=>'toscreen'])?>"><i class="fi-monitor"></i></a></li>
                                <li> <a href="<?= $this->Url->build(['controller'=>'settings','action'=>'add'])?>"> <?= __('Settings');?></a>

                                </li>
                                <li class="has-dropdown">
                                    <a href="#"><?= $session->read('Auth.User.username')?></a>
                                    <ul class="dropdown">
                                        <li><a href="<?= $this->Url->build(['controller'=>'users','action'=>'view',$session->read('Auth.User.id')])?>"><?= __('Profile') ?></a></li>
                                        <li><a href="<?= $this->Url->build(['controller'=>'users','action'=>'edit',$session->read('Auth.User.id')])?>"><?= __('Edit') ?></a></li>
                                        <li><a href="<?= $this->Url->build(['controller'=>'users','action'=>'logout'])?>"><?= __('Logout') ?></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </ul>

                    </section>
                </nav>
            </div>

        </header>

            <div id="content">
                <?= $this->Flash->render() ?>
                <div class="row fullWidth">

                    <?= $this->fetch('content') ?>
                </div>
            </div>
            <footer>
            </footer>
        </div>
        <?= $this->Html->script('vendor/jquery'); ?>
        <?= $this->Html->script('foundation.min'); ?>
        <script>
        $(document).foundation();
        </script>
        <?= $this->fetch('scriptBottom') ?>
    </body>
    </html>
