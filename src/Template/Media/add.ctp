<div class="media form large-12 medium-12 columns content">
    <?= $this->Form->create($media, ['type'=>'file']) ?>
    <fieldset>
        <legend><?= __('Add Media') ?></legend>
        <?php
            echo $this->Form->input('filename',['type'=>'file']);
            echo $this->Form->input('description');
            echo $this->Form->input('articles._ids', ['options' => $articles]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
