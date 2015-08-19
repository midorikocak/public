<?php
namespace App\Model\Table;

use App\Model\Entity\Media;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Media Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Articles
 */
class MediaTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('media');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsToMany('Articles', [
            'foreignKey' => 'media_id',
            'targetForeignKey' => 'article_id',
            'joinTable' => 'articles_media'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('filename', 'create')
            ->notEmpty('filename');

        $validator
            ->allowEmpty('description');

        return $validator;
    }
}
