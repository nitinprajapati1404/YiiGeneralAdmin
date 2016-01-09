<?php

/**
 * This is the model class for table "face_image_master".
 *
 * The followings are the available columns in table 'face_image_master':
 * @property integer $fim_id
 * @property integer $fm_id
 * @property integer $tracer_id
 * @property string $image
 * @property string $created_on
 */
class FaceImageMaster extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public $UseName;
    public $magazineImagePath = "/test/";
    public $imagePathTest;
    
    public function init() {
        $this->imagePathTest = App::param('siteurl','images/test');
    }

    public function tableName() {
        return 'face_image_master';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        $currentTime = App::GetDateTime();
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fm_id, tracer_id', 'numerical', 'integerOnly' => true),
//			array('image', 'length', 'max'=>100000000000000000000000000),
            array('created_on', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('fim_id, fm_id, tracer_id, image, created_on,UseName', 'safe', 'on' => 'search'),
            array('created_on', 'default', 'value' => $currentTime,
                'setOnEmpty' => false, 'on' => 'insert'),
//            array('modified_on', 'default', 'value' => $currentTime,)
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'FaceMaster' => array(self::BELONGS_TO, 'FaceMaster', 'fm_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'fim_id' => 'Fim',
            'fm_id' => 'Fm',
            'tracer_id' => 'Tracer ID',
            'image' => 'Image',
            'created_on' => 'Created On',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->with = array('FaceMaster');
        $criteria->compare('fim_id', $this->fim_id);
        $criteria->compare('fm_id', $this->fm_id);
        $criteria->compare('t.tracer_id', $this->tracer_id);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('t.created_on', $this->created_on, true);
        $criteria->compare('FaceMaster.user_name', $this->UseName, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return FaceImageMaster the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
