<?php
/**
 * Plugin Name: 修改默认头像
 * Plugin URI: http://www.wordpressKT.com
 * Description: 头像服务器在国内不稳定，所以修改头像服务器
 * Author: 凌风
 * Author URI: http://www.wordpressKT.com
 */
if (!function_exists('get_option')) {
  header('HTTP/1.0 403 Forbidden');
  die;  // 禁止直接访问
}

//替换成中国头像
function cn_avatar($avatar){
    $avatar = preg_replace('#http://[\d]+\.gravatar\.com/#', 'http://cn.gravatar.com/', $avatar); 
    return $avatar;
}
add_filter('get_avatar','cn_avatar',100,1);
