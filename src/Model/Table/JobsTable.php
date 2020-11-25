<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\Job;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Database\Schema\TableSchema;
use Cake\Database\Schema\TableSchemaInterface;

/**
 * Jobs Model
 *
 * @method \App\Model\Entity\Job newEmptyEntity()
 * @method \App\Model\Entity\Job newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Job[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Job get($primaryKey, $options = [])
 * @method \App\Model\Entity\Job findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Job patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Job[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Job|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Job saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Job[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Job[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Job[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Job[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class JobsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('jobs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * @param TableSchemaInterface $schema
     * @return TableSchemaInterface
     */
    protected function _initializeSchema(TableSchemaInterface $schema): TableSchemaInterface
    {
        parent::_initializeSchema($schema);
        $schema->setColumnType('parameters', 'json');
        return $schema;
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('command')
            ->maxLength('command', 255)
            ->requirePresence('command', 'create')
            ->notEmptyString('command');

        $validator
            ->isArray('parameters')
            ->allowEmptyArray('parameters');

        $validator
            ->scalar('status')
            ->maxLength('status', 255)
            ->notEmptyString('status');

        $validator
            ->dateTime('executed')
            ->allowEmptyDateTime('executed');

        return $validator;
    }

    /**
     * Enqueue.
     *
     * @param string $command_name Command name
     * @param array $parameters Command options and arguments.
     * @return boolean
     */
    public function enqueue(string $command_name, array $parameters): bool
    {
        $job = $this->newEntity([
            'command' => $command_name,
            'parameters' => $parameters,
        ]);
        if ($job->hasErrors()) {
            return false;
        }
        return !($this->save($job) === false);
    }

    /**
     * Dequeue.
     *
     * @return Job|null
     */
    public function dequeue(): ?Job
    {
        $job = $this->find('all')->where(['status' => 'waiting'])->orderAsc('created')->limit(1)->first();
        if (empty($job)) {
            return null;
        }
        $job->dequeue();
        $this->save($job);


        return $this->get($job->id);
    }

    public function beforeMarshal(Event $event, \ArrayObject $data, \ArrayObject $options)
    {
        if (!isset($data['status'])) {
            $data['status'] = 'waiting';
        }
    }
}
