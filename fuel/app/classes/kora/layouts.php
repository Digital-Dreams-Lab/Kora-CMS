<?php

namespace Kora;

class Layouts
{
	static $block_data;
	
	public static function get_blocks($file)
	{
		if (realpath($file))
		{
			$xml_data = file_get_contents(realpath($file));
			$xml = new \SimpleXMLElement($xml_data);
			//var_dump($xml);
			$i=0;		
			foreach($xml->block as $block) {
				static::$block_data[$i]['row-start'] = (string) $block->attributes()->{'data-row-start'};
				static::$block_data[$i]['row-end'] = (string) $block->attributes()->{'data-row-end'};
				static::$block_data[$i]['id'] = (string) $block->attributes()->{'data-id'};
				static::$block_data[$i]['title'] = (string) $block->attributes()->{'data-title'};
				static::$block_data[$i]['class'] = (string) $block->attributes()->{'data-class'};
				static::$block_data[$i]['position'] = (string) $block->attributes()->{'data-position'};
				static::$block_data[$i]['col'] = (string) $block->attributes()->{'data-col'};
				static::$block_data[$i]['order'] = (string) $block->attributes()->{'data-order'};
				static::$block_data[$i]['limit'] = (string) $block->attributes()->{'data-limit'};
				static::$block_data[$i]['html'] = (string) $block->attributes()->{'data-html'};
				static::$block_data[$i]['active'] = (string) $block->attributes()->{'data-active'};
				$i++;
			}
			//var_dump(static::$block_data);
			return static::$block_data;
			
			//die();
		} 
		else
		{		
			var_dump('Kora\Layouts::get_blocks() [error] path not valid: '.$file);
		}		
	}

	public static function print_blocks($obj=null, $switch=true)
	{
		$blocks_print	= static::$block_data;		
		$print 			= array();
				
		
		if ($switch==true)
		{
			$check_data = 'single';		
			$id 			= isset($obj->single_id)?$obj->single_id:'';
			$print[] = '<div class="panel">';
			$print[] = '<div class="panel-heading"><i class="fa fa-bars"></i> Theme layout using single page</div>';
		}
		
		else		
		{
			$check_data = 'blocks';
			$id 			= isset($obj->blocks_id)?$obj->blocks_id:'';
			$print[] = '<div class="panel">';
			$print[] = '<div class="panel-heading"><i class="fa fa-th-large"></i> Theme layout using blocks page</div>';
		}	
		$print[] = '<div class="panel-body">';

		foreach ($blocks_print as $item)
		{
			$print[] = ($item['row-start']=='yes'?'<div class="row"><div class="container">':'');
			$print[] = '<div class="well col-xs-'.$item['col'].' ">';
			$print[] = '<button
            				'.($item['active']=='disable'?'disabled':'').'
            				data-id="'.$item['id'].'"
            				data-title="'.$item['title'].'"
							data-class="'.$item['class'].'"
							data-html="'.$item['html'].'"
							class="btn btn-xs btn-default '.($id==$item['id']?'btn-success':'').' layout_'.$check_data.'_check" 
							type="button"
							name="page[single_id]">';
			$print[] = '<i class="fa fa-'.($id==$item['id']?'check-':'').'square-o"></i> '.$item['title'];
			$print[] = '</button>';
			$print[] = '</div>';
			$print[] = ($item['row-end']=='yes'?'</div></div>':'');
		}
		$print[] = '</div>';
		$print[] = '</div>';

		
		return implode('',$print);
	}



















}

