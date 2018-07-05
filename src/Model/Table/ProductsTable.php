<?php
namespace Stock\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \Cake\ORM\Association\HasMany $Stock
 * @property \Cake\ORM\Association\HasMany $StockIn
 * @property \Cake\ORM\Association\HasMany $StockOut
 * @property \Cake\ORM\Association\BelongsToMany $Categories
 *
 * @method \Stock\Model\Entity\Product get($primaryKey, $options = [])
 * @method \Stock\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \Stock\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \Stock\Model\Entity\Product|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Stock\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Stock\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \Stock\Model\Entity\Product findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductsTable extends Table
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

        $this->setTable('products');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasOne('Stock.Stock', [
            'foreignKey' => 'product_id',
            'dependent' => true
        ]);
        $this->hasMany('Stock.StockIn', [
            'foreignKey' => 'product_id',
            'dependent' => true
        ]);
        $this->hasMany('Stock.StockOut', [
            'foreignKey' => 'product_id',
            'dependent' => true
        ]);
        $this->belongsToMany('Stock.Categories', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'category_id',
            'joinTable' => 'categories_products'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->decimal('cost')
            ->requirePresence('cost', 'create')
            ->notEmpty('cost');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->allowEmpty('description');

        $validator
            ->integer('alert_quantity')
            ->requirePresence('alert_quantity', 'create')
            ->notEmpty('alert_quantity');

        return $validator;
    }
}
