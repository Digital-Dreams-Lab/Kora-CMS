<?php
namespace Vendor;

class Tree
{
    public static $tree;
	
	public static function parse($data, $tree, $root='0', $i=0)
	{
		$return = array();
		# Traverse the tree and search for direct children of the root
		foreach($tree as $child => $parent)
		{
			# A direct child is found
			if($parent == $root)
			{
				# Remove item from tree (we don't need to traverse this again)
				unset($tree[$child]);
				# Append the child into result array and parse its children
				$return[] = array(
					'id' => $child,
					'parent_id' => $parent,
					'depth' => $i++,
					'data' => $data[$child],
					'children' => static::parse($data, $tree, $child, $i)
				);
				$i=0;
			}
		}
		return empty($return) ? null : $return;    
	}
		
	public static function flatten($elements, $depth)
	{
		$result = array();
	
		foreach ($elements as $element)
		{
			$element['depth'] = $depth;
	
			if (isset($element['children']))
			{
				$children = $element['children'];
				unset($element['children']);
			}
			else
			{
				$children = null;
				unset($element['children']);
			}
	
			$result[] = $element;
	
			if (isset($children)) {
				$result = array_merge($result, static::flatten($children, $depth + 1));
			}
		}
		$return = array();
		foreach ($result as $key => $val)
		{
			$return[$val['id']] = $val; 
		}
		return $return;
	}

}