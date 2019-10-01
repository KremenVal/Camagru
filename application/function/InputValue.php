<?php
	function InputValue($value, $value2 = null)
	{
		if (isset($value))
		{
			return $value;
		}
		else if (isset($value2))
		{
			return $value2;
		}
		else
		{
			return '';
		}
	}