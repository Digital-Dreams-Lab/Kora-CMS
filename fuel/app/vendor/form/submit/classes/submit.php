<?php

namespace Plugin\Form;

class Submit
{
	public static function process_get($get=null)
	{
		if ($get!=null)
		{
			// Process get
			$query = \DB::select()->from('forms')->where('id',$get['form_id'])->execute()->as_array();
			
			$script  = '$(".view_'.$get['type'].'").show();';
			$script .= '$(".view_'.$get['type'].'").find(".formsubmit_create_form").addClass("formsubmit_edit_form").removeClass("formsubmit_create_form");';
			$script .= '$(".view_'.$get['type'].'").find(".formsubmit_create_btn").addClass("formsubmit_edit_btn").removeClass("formsubmit_create_btn");';
			$script .= '$("button[value='."'".$get['type']."'".']").addClass("active btn-primary");';
			$script .= "$('<input>').attr({type: 'hidden',  name: 'form_id', value: '".$query[0]['id']."' }).appendTo('form.formsubmit_edit_form');";
			$script .= '$(".view_'.$get['type'].'").find("input[value='."'Add input'".']").val("Update input").removeClass("btn-primary").addClass("btn-warning");';
			$script .= '$(".view_'.$get['type'].'").find(".form-group").addClass("has-warning has-feedback");';
			
			return array('script'=>$script,'get'=>$query[0]);
		}
		else 
		{
			return array('script'=>'','get'=>array());
		}
	}	

}