<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

Trait Slugify
{
	public static function generateSlug($table, $column, $value, $delimiter = '-') 
	{		
		$result = DB::table($table)->where($column, 'LIKE', "$value%")->get();

		if (count($result) === 0) {
			//slug case
			$return = $value;
		} else {			
			
			$slugs = [];
			$suffixes = [];

			foreach ($result as $item) {
				$slugs[] = $item->slug;
				$suffix = str_replace($value . $delimiter, '', $item->slug);		

				if(is_numeric($suffix) && $suffix !== $value) {
					$suffixes[] = $suffix;
				}				
			}

			if (empty($suffixes)) {
				// slug-1 case
				$return = $value . $delimiter . '1';
			} else {
				//slug-n case
				$suffix = max($suffixes) + 1;
				$return = $value . $delimiter . $suffix;
			}			
		}
	
		return $return;			
	}
}