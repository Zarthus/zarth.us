<?php

class Utilities
{
	/**
	 *	Sanitize Table Name
	 *
	 *	Attempt to sanitize the table name, tables only allow underscores, dashes, dollar signs, and a-z
	 *
	 *	@access public
	 *	@static
	 *	@param string $table name of the table to verify.
	 *	@return string $table if the name is fine, an attempted sane table name if not.
	 */
	public static function sanitizeTableName($table)
	{
		if (preg_match("/^[a-z\_\-\$]{0,30}$/i", $table))
			return $table;
		else
			return preg_replace('/[^ a-z\_\-\$]+/i', '', $table);		
	}	
	 
}