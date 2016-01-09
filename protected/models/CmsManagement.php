<?php

/**
 * This is the model class for table "cms_management".
 *
 * The followings are the available columns in table 'cms_management':
 * @property integer $cms_id
 * @property string $cms_page_alias
 * @property string $cms_page_title
 * @property string $cms_page_content
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property integer $is_active
 * @property integer $is_delete
 */
class CmsManagement extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'cms_management';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        $currentTime = App::GetDateTime();
          $loggedUser = 1;
//          app::pr($loggedUser,2);
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('created_by, modified_by, is_active, is_delete', 'numerical', 'integerOnly' => true),
            array('cms_page_alias, cms_page_title', 'length', 'max' => 255),
            array('cms_page_content, created_on, modified_on', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('cms_id, cms_page_alias, cms_page_title, cms_page_content, created_on, created_by, modified_on, modified_by, is_active, is_delete', 'safe', 'on' => 'search'),
           array('cms_page_alias', 'application.extensions.uniqueMultiColumnValidator','message' => 'CMS Page Title already Taken.'),
            array('created_on', 'default', 'value' => $currentTime,
                'setOnEmpty' => false, 'on' => 'insert'),
            array('modified_on', 'default', 'value' => $currentTime,),
             array('modified_by', 'default', 'value' => $loggedUser,
                'setOnEmpty' => false, 'on' => 'insert,update'),
            array('created_by', 'default', 'value' => $loggedUser,
                'setOnEmpty' => false, 'on' => 'insert'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'cms_id' => 'Cms',
            'cms_page_alias' => 'Cms Page Alias',
            'cms_page_title' => 'Cms Page Title',
            'cms_page_content' => 'Cms Page Content',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'modified_on' => 'Modified On',
            'modified_by' => 'Modified By',
            'is_active' => 'Is Active',
            'is_delete' => 'Is Delete',
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

        $criteria->compare('cms_id', $this->cms_id);
        $criteria->compare('cms_page_alias', $this->cms_page_alias, true);
        $criteria->compare('cms_page_title', $this->cms_page_title, true);
        $criteria->compare('cms_page_content', $this->cms_page_content, true);
        $criteria->compare('created_on', $this->created_on, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('modified_on', $this->modified_on, true);
        $criteria->compare('modified_by', $this->modified_by);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('is_delete', $this->is_delete);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CmsManagement the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
