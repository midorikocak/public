<div class="articles index large-12 medium-12 columns content">
  <?php foreach ($articles as $article): ?>
    <?php
      echo $this->element('article',['article'=>$article]);
    ?>
  <?php endforeach; ?>

    <div class="paginator">
      <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
      </ul>
      <p><?= $this->Paginator->counter() ?></p>
    </div>
  </div>
