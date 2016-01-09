<?php

/**
 * This is the model class for table "contact_us".
 *
 * The followings are the available columns in table 'contact_us':
 * @property integer $contact_id
 * @property string $contact_name
 * @property string $contact_email
 * @property string $contact_phone
 * @property string $contact_message
 */
class ContactUs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contact_us';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contact_name, contact_email, contact_phone', 'length', 'max'=>255),
			array('contact_message,created_on,created_by,is_active', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('contact_id, contact_name, contact_email, contact_phone, contact_message,created_on,created_by,is_active', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'contact_id' => 'Contcact',
			'contact_name' => 'Contact Name',
			'contact_email' => 'Contact Email',
			'contact_phone' => 'Contact Phone',
			'contact_message' => 'Contact Message',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('contact_id',$this->contact_id);
		$criteria->compare('contact_name',$this->contact_name,true);
		$criteria->compare('contact_email',$this->contact_email,true);
		$criteria->compare('contact_phone',$this->contact_phone,true);
		$criteria->compare('contact_message',$this->contact_message,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('is_active',$this->is_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ContactUs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
