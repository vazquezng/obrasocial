<?php

namespace helper;

class DB {
	protected static $gdb;

	static public function getdb() {
		if (is_null(DB::$gdb)) {
			self::setdb();
		}
		return DB::$gdb;
	}

	static public function setdb() {
		DB::$gdb = new \PDO('mysql:host=localhost;dbname=obrasocial', 'root', '4dm1n');
	}
}
