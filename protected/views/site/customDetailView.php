<?php
## custom detail view : Mitesh 
		//App::pr($paramArr,9);
		$html = '';
		$html .='<div class="row lable_right my_style_thumb">';
		if(!empty($paramArr) && !empty($model))
		{
                        // maintain array for column field for col-md-12 class
                        $custArr = array('Description','artist_bio','tnc','description','event_description','offer_tc','outlet_tc','question');
			foreach($paramArr as $k=>$v)
			{
                            $classTemp = "col-md-6";
                            //if($v["name"] == "Description" || $v["column"] == "description"){
                            if(in_array($v["name"],$custArr) || in_array($v["column"],$custArr)){
                                    $classTemp = "col-md-12 description";	
                            }
                            ## if custom , than it belongs to anyother model(table)
                            if(isset($v['column']) && $v['column'] != '' || (isset($v['custom']) && $v['custom'] != ''))
                            {
                                $html .='<div class="'.$classTemp.'"><div class="form-group">';
                                ## set label value
                                $html .='<label class="col-sm-3 control-label">';
                                if(isset($v['name']) && $v['name'] != '')
                                        $label = $v['name'];
                                else
                                        $label = 'Label Not Found';
                                $html .=$label;
                                $html .= '</label>';

                                ## value of field
                                $html .='<div class="col-md-9">';
                                if(isset($v['value']) && $v['value'] != '')
                                        $value = $v['value'];
                                else
                                {
                                    if(isset($v['column']))
                                        $value = $model->$v['column'];
                                }
                                $html .=$value;
                                $html .='</div>';
                                $html .='</div></div>';
                            }
			}
		}else
		{
			## if no data found , display message
			$html .='No Record Found';
			
		}
		$html .='</div>';
		echo $html;
?>