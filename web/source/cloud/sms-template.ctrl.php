<?php
/**
 * [TapGo E-commerce System] Copyright (c) 2025 TapGo Team
 * Independent E-commerce Platform
 * @website https://w.itapgo.com
 */
defined('IN_IA') or exit('Access Denied');

$dos = array('display');
$do = in_array($do, $dos) ? $do : 'display';
template('cloud/sms-template');