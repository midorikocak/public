<article>
<h3><a href="#"><?= h($article->title) ?></a></h3>
<p class="silent">Written by <a href="#"><?= $article->has('user') ? $this->Html->link($article->user->username, ['controller' => 'Users', 'action' => 'view', $article->user->id]) : '' ?></a> on
<time pubdate datetime="<?= h($article->created) ?>"><?= h($article->created) ?></time>
</p>
<?= strip_tags($article->body, '<ul><ol><li><p><i><a><img><b><br><div><br/>'); ?>
</article>
