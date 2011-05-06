<?php

/**
 * This class is the base of all classes used in the framework. The purpose of
 * using this class as parent is that you can use properties in classes that
 * extend from Object.
 *
 * The method is the following:
 * You have to create functions named like:
 * getProperty
 * setProperty
 * where Property is the capitalized name of your property.
 * For example:
 * <code>
 * <?php
 *
 * class MyClass extends \Object {
 *
 *     private $_name = '';
 *
 *     setName($value) {
 *         $this->_name = $value;
 *     }
 *
 *     getName() {
 *         return $_name;
 *     }
 * 
 * }
 *
 * $instance = new MyClass();
 *
 * $instance->name = 'Yoda';
 *
 * echo $instance->name;
 *
 * ?>
 * </code>
 *
 * The expected output of the example above is:
 * <code>
 * Yoda
 * </code>
 *
 */

class Object
{

	public function __isset( $name )
	{
		return (method_exists($this, 'get' . ucwords($name)) || method_exists($this, 'set' . ucwords($name)));
	}

	public function __get( $name )
	{
		if ($this->__isset($name)) {
			if (method_exists($this, 'get' . ucwords($name))) {
				$get = 'get' . ucwords($name);
				return $this->$get();
			} else {
				throw new System\ErrorHandling\PropertyOverloadingException("The property \"$name\" is read-only.", EXCODE_PROPERTY_READ_ONLY, null, USER_MESSAGE_NOT_DISCUSSED);
			}
		}
	}

	public function __set( $name, $value )
	{
		if ($this->__isset($name)) {
			if (method_exists($this, 'set' . ucwords($name))) {
				$set = 'set' . ucwords($name);
				$this->$set($value);
			} else {
				throw new System\ErrorHandling\PropertyOverloadingException("The property \"$name\" is write-only.", EXCODE_PROPERTY_WRITE_ONLY, null, USER_MESSAGE_NOT_DISCUSSED);
			}
		}
	}

}