<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-3">
  <?php foreach ($media as $media): ?>
    <li><?= $this->Html->image($media->filename,['url'=>'/img/'.$media->filename]) ?></li>
  <?php endforeach; ?>
</ul>
