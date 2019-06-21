<?php

namespace common\models\filters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\tables\Tasks;
use Yii;

/**
 * TasksFilter represents the model behind the search form of `app\models\tables\Tasks`.
 * @property string createdMonthYear
 */
class TasksFilter extends Tasks
{
    /**
     * {@inheritdoc}
     */
    public $createdMonthYear;

    public function rules()
    {
        return [
            [['id', 'creator_id', 'responsible_id', 'status_id'], 'integer'],
            [['name', 'description', 'deadline', 'created', 'updated'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Tasks::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'creator_id' => $this->creator_id,
            'responsible_id' => $this->responsible_id,
            'deadline' => $this->deadline,
            'status_id' => $this->status_id,
        ]);


        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);




        if (isset($this->created)) {
            $createdMonth = (int)substr($this->created, -2);
            $createdYear = (int)substr($this->created, 0, 4);
            $query->andFilterCompare("MONTH(created)", $createdMonth)
                ->andFilterCompare("YEAR(created)", $createdYear);
        }


        return $dataProvider;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app', 'tasks_name'),
            'description' => Yii::t('app', 'tasks_description'),
            'creator_id' => Yii::t('app', 'tasks_creator_id'),
            'responsible_id' => Yii::t('app', 'tasks_responsible_id'),
            'deadline' => Yii::t('app', 'tasks_deadline'),
            'status_id' => Yii::t('app', 'tasks_status_id'),
            'created' => Yii::t('app', 'tasks_created'),
            'updated' => Yii::t('app', 'tasks_updated'),
        ];
    }

}
