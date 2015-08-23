<div class="articles index large-12 medium-12 columns content">

            <?php foreach ($articles as $article): ?>

              <article>
              <h3><a href="#"><?= h($article->title) ?></a></h3>
              <p class="silent">Written by <a href="#"><?= $article->has('user') ? $this->Html->link($article->user->email, ['controller' => 'Users', 'action' => 'view', $article->user->id]) : '' ?></a> on
              <time pubdate datetime="<?= h($article->created) ?>"><?= h($article->created) ?></time>
              </p>
              <?= strip_tags($article->body, '<ul><ol><li><p><i><a><img><b><br><div><br/>'); ?>
              <?= $this->Html->link(__('View'), ['action' => 'view', $article->id]) ?>
              <?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id]) ?>
              <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?>
              </article>
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
