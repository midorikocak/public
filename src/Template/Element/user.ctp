<ul class="right">
  <li class="has-dropdown">
    <a href="#"><?= $session->read('Auth.User.username')?></a>
    <ul class="dropdown">
      <li><a href="<?= $this->Url->build(['controller'=>'users','action'=>'view',$session->read('Auth.User.id')])?>"><?= __('Profile') ?></a></li>
      <li><a href="<?= $this->Url->build(['controller'=>'users','action'=>'edit',$session->read('Auth.User.id')])?>"><?= __('Edit') ?></a></li>
      <li><a href="<?= $this->Url->build(['controller'=>'users','action'=>'logout'])?>"><?= __('Logout') ?></a></li>
    </ul>
  </li>
</ul>
