<?php
namespace Core;

use Core\Db;
use Core\Utils;

abstract class Model {

	public function __construct($data = array()) {
		foreach($data as $key => $value) {
			$setter = $this->_setter($key); // setId, setName,...etc
			if (method_exists($this, $setter)) {
				$this->$setter($value);
			}
		}
	}

	public function __set($key, $value) {
		$setter = $this->_setter($key); // setId, setName,...etc
		if (method_exists($this, $setter)) {
			$this->$setter($value);
		}
	}

	public function __get($key) {
		$getter = $this->_getter($key); // getId, getName,...etc
		if (method_exists($this, $getter)) {
			return $this->$getter();
		}
	}

	public function getProperties($get_privates = false) {
		$class = new \ReflectionClass($this);
		$properties = $class->getProperties();
		$vars = array();
		foreach ($properties as $property) {
			$property_name = $property->getName();
			if (!$property->isPrivate() || $get_privates === true) {
				$vars[$property_name] = $this->$property_name;
			}
		}
		return $vars;
	}

	public static function getList($sql, $bindings = array()) {
		return self::_getList(Db::select($sql, $bindings));
	}

	public static function get($sql, $bindings = array()) {
		$entity = self::getClass();
		return new $entity(Db::selectOne($sql, $bindings));
	}

	private static function _getList($result) {
		$entity = self::getClass();
		$items = array();
		foreach($result as $item) {
			$items[] = new $entity($item);
		}
		return $items;
	}

	public static function getClass() {
		return get_called_class();
	}

	public function __isset($key) {
		return property_exists($this, $key);
	}

	public function __toString() {
		return '<pre>'.var_export($this, true).'</pre>';
	}

	private function _getter($key) {
		return Utils::getCamelCase('get'.ucfirst($key));
	}

	private function _setter($key) {
		return Utils::getCamelCase('set'.ucfirst($key));
	}
}