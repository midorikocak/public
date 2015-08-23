<div class="media view large-9 medium-8 columns content">
  <?= $this->Html->image($media->filename,['url'=>'/img/'.$media->filename]) ?>
  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $media->id]) ?>
  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $media->id], ['confirm' => __('Are you sure you want to delete # {0}?', $media->id)]) ?>
  <?= $this->Text->autoParagraph(h($media->description)); ?>
</div>
