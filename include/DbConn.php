<?php

function _connect() {
	//global 表示全局变量的意思，意图是将此变量在函数外部也能访问
	global $_conn;
	if (!$_conn = @mysql_connect(DB_HOST,DB_USER,DB_PWD)) {
		exit('数据库连接失败');
	}
}

/**
 * _select_db选择一款数据库
 * @return void
 */

function _select_db() {
	if (!mysql_select_db(DB_NAME)) {
		exit('找不到指定的数据库');
	}
}


function _set_names() {
	if (!mysql_query('SET NAMES UTF8')) {
		exit('字符集错误');
	}
}



function _query($_sql) {
	if (!$_result = mysql_query($_sql)) {
		exit('SQL执行失败'.mysql_error());
	}
	return $_result;
}

/**
 * _fetch_array只能获取指定数据集一条数据组
 * @param $_sql
 */

function _fetch_array($_sql) {
	return mysql_fetch_array(_query($_sql),MYSQL_ASSOC);
}

/**
 * _fetch_array_list可以返回指定数据集的所有数据
 * @param $_result
 */

function _fetch_array_list($_result) {
	return mysql_fetch_array($_result,MYSQL_ASSOC);
}


function _close() {
	if (!mysql_close()) {
		exit('关闭异常');
	}
}









