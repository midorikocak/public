<div class="articles form large-12 medium-12 columns content">
    <?= $this->Form->create($article) ?>
    <fieldset>
        <?php
            echo $this->Form->input('title',['label'=>false,'placeholder'=>__('Title')]);
            echo $this->Form->input('body',['label'=>false,'placeholder'=>__('Body')]);
            //echo $this->Form->input('category_id', ['options' => $categories, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
