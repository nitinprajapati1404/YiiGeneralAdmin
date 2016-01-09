<?php

/**
 * This is the model class for table "face_master".
 *
 * The followings are the available columns in table 'face_master':
 * @property integer $fm_id
 * @property string $user_name
 * @property integer $tracer_id
 * @property string $result
 * @property string $created_on
 */
class FaceMaster extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public $image;
    public $imgPath;
        public function __construct() {
            $this->imgPath  = Yii::app()->request->baseUrl.'/images/user/';
        }
    public function tableName() {
        return 'face_master';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tracer_id', 'numerical', 'integerOnly' => true),
            array('user_name', 'length', 'max' => 255),
            array('result', 'length', 'max' => 5),
            array('created_on', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('fm_id, user_name, tracer_id, result, created_on,lat,lng,member_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'FaceImageMaster' => array(self::HAS_MANY, 'FaceImageMaster', 'fm_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'fm_id' => 'Fm',
            'user_name' => 'User Name',
            'tracer_id' => 'Trader ID',
            'result' => 'Result',
            'created_on' => 'Created On',
            'member_id'=>'Member ID'
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
        $criteria->with = array('FaceImageMaster');
        $criteria->compare('fm_id', $this->fm_id);
        $criteria->compare('user_name', $this->user_name, true);
        $criteria->compare('tracer_id', $this->tracer_id);
        $criteria->compare('result', $this->result, true);
        $criteria->compare('created_on', $this->created_on, true);
        $criteria->compare('lat', $this->lat,true);
        $criteria->compare('lng', $this->lng, true);
        $criteria->compare('member_id', $this->member_id, true);
        $criteria->compare('FaceImageMaster.image', $this->image, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'created_on DESC',
            ),
            'pagination' => array('pageSize' => 50),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return FaceMaster the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getImages($fm_id) {
        $images = FaceImageMaster::model()->findAllByAttributes(array('fm_id' => $fm_id));
        $image = array();
        $count = 0;
        foreach ($images as $img) {
//            $i.='http://' . $_SERVER['HTTP_HOST'] . $this->imgPath;
//            $i.= $img->image;
            
           $image[$count] = '<a class="popup-img" href="'.self::model()->imgPath.$img->image.'" ><img src="'.self::model()->imgPath.$img->image.'" height="60"  width="80"/></a>';
//           $i.= "<br>";
           $count++;
        }
        $i = implode('<br><br>', $image);
//        echo '<pre>';print_r($i);die;
        return $i;
    }
    /*
     * function for get address from google API 
     * with lat long
     */
    public function getAddress($lat,$lng){
//        print_r($lat.$lng);die;
        if(!empty($lat) && $lat!="" && !empty($lng) && $lng!=""){
             $address_url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lng."&sensor=true";
//             print_r($address_url);die;
             $addres_value = "";
             $address = file_get_contents($address_url);
             $address = json_decode($address,true);
             if(strtolower($address['status'])=="ok"){
//                  echo '<pre>';print_r($address);die;
                if(!empty($address['results'])){
                    $addres_value = $address['results'][0]['formatted_address'];
                    return $addres_value;
                }else{
                    return $addres_value;
                }
             }else{
                 return $addres_value;
             }
             
        }
       
    }

}
