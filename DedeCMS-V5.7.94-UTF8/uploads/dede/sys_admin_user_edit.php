<?php
/**
 * 编辑系统管理员
 *
 * @version        $Id: sys_admin_user_edit.php 1 16:22 2010年7月20日 $
 * @package        DedeCMS.Administrator
 * @founder        IT柏拉图, https://weibo.com/itprato
 * @author         DedeCMS团队
 * @copyright      Copyright (c) 2007 - 2021, 上海卓卓网络科技有限公司 (DesDev, Inc.)
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__).'/config.php');
CheckPurview('sys_User');
require_once(DEDEINC.'/typelink.class.php');
if(empty($dopost)) $dopost = '';
$id = preg_replace("#[^0-9]#", '', $id);

if($dopost=='saveedit')
{
    csrf_check();
    $pwd = trim($pwd);
    if($pwd!='' && preg_match("#[^0-9a-zA-Z_@!\.-]#", $pwd))
    {
        ShowMsg('密码不合法，请使用[0-9a-zA-Z_@!.-]内的字符！', '-1', 0, 3000);
        exit();
    }
    if($pwd!='' && !preg_match("#^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$#", $pwd))
    {
        ShowMsg('密码必须包含1个数字，1个小写字母，1个大写字母！', '-1', 0, 3000);
        exit();
    }
    if($pwd!='' && !preg_match("#^.{8,128}$#", $pwd))
    {
        ShowMsg('密码必须大于8位小于128位！', '-1', 0, 3000);
        exit();
    }
    $safecodeok = substr(md5($cfg_cookie_encode.$randcode), 0, 24);
    if($safecodeok != $safecode)
    {
        ShowMsg('请填写正确的安全验证串！', '-1', 0, 3000);
        exit();
    }
    $pwdm = '';
    if($pwd != '')
    {
        $pwdm = ",pwd='".md5($pwd)."'";
        $pwd = ",pwd='".substr(md5($pwd), 5, 20)."'";
    }
    if(empty($typeids))
    {
        $typeid = '';
    } else {
        $typeid = join(',', $typeids);
        if($typeid=='0') $typeid = '';
    }
    if($id!=1){
        $query = "UPDATE `#@__admin` SET uname='$uname',usertype='$usertype',tname='$tname',email='$email',typeid='$typeid' $pwd WHERE id='$id'";
    }else{
        $query = "UPDATE `#@__admin` SET uname='$uname',tname='$tname',email='$email',typeid='$typeid' $pwd WHERE id='$id'";
    }
    $dsql->ExecuteNoneQuery($query);
    $query = "UPDATE `#@__member` SET uname='$uname',email='$email'$pwdm WHERE mid='$id'";
    $dsql->ExecuteNoneQuery($query);

    // 定期更换密码提醒
    $arr_password = array();
    $filename = DEDEDATA.'/password.data.php';
    if (file_exists($filename)) {
        require_once(DEDEDATA . '/password.data.php');
        $arr_password = json_decode($str_password, true);
    }

    $timestamp = time();
    $arr_password[$id] = "{$timestamp}";
    $content = "<?php\r\n\$str_password='".json_encode($arr_password)."';";

    $fp = fopen($filename, 'w') or die("写入文件 $filename 失败，请检查权限！");
    fwrite($fp, $content);
    fclose($fp);

    ShowMsg("成功更改一个帐户！", "sys_admin_user.php");
    exit();
}
else if($dopost=='delete')
{
    if(empty($userok)) $userok="";
    if($userok!="yes")
    {
        $randcode = mt_rand(10000, 99999);
        $safecode = substr(md5($cfg_cookie_encode.$randcode),0,24);
        require_once(DEDEINC."/oxwindow.class.php");
        $wintitle = "删除用户";
        $wecome_info = "<a href='sys_admin_user.php'>系统帐号管理</a>::删除用户";
        $win = new OxWindow();
        $win->Init("sys_admin_user_edit.php","js/blank.js","POST");
        $win->AddHidden("dopost", $dopost);
        $win->AddHidden("userok", "yes");
        $win->AddHidden("randcode", $randcode);
        $win->AddHidden("safecode", $safecode);
        $win->AddHidden("id", $id);
        $win->AddTitle("系统警告！");
        $win->AddMsgItem("你确信要删除用户：$userid 吗？","50");
        $win->AddMsgItem("安全验证串：<input name='safecode' type='text' id='safecode' size='16' style='width:200px' />&nbsp;(复制本代码： <font color='red'>$safecode</font> )","30");
        $winform = $win->GetWindow("ok");
        $win->Display();
        exit();
    }
    $safecodeok = substr(md5($cfg_cookie_encode.$randcode),0,24);
    if($safecodeok!=$safecode)
    {
        ShowMsg("请填写正确的安全验证串！", "sys_admin_user.php");
        exit();
    }

    //不能删除id为1的创建人帐号，不能删除自己
    $rs = $dsql->ExecuteNoneQuery2("DELETE FROM `#@__admin` WHERE id='$id' AND id<>1 AND id<>'".$cuserLogin->getUserID()."' ");
    if($rs>0)
    {
        //更新前台用户信息
        $dsql->ExecuteNoneQuery("UPDATE `#@__member` SET matt='0' WHERE mid='$id' LIMIT 1");
        ShowMsg("成功删除一个帐户！","sys_admin_user.php");
    }
    else
    {
        ShowMsg("不能删除id为1的创建人帐号，不能删除自己！","sys_admin_user.php",0,3000);
    }
    exit();
}

//显示用户信息
$randcode = mt_rand(10000,99999);
$safecode = substr(md5($cfg_cookie_encode.$randcode),0,24);
$typeOptions = '';
$row = $dsql->GetOne("SELECT * FROM `#@__admin` WHERE id='$id'");
$typeids = explode(',', $row['typeid']);
$dsql->SetQuery("SELECT id,typename FROM `#@__arctype` WHERE reid=0 AND (ispart=0 OR ispart=1)");
$dsql->Execute('op');

while($nrow = $dsql->GetObject('op'))
{
    $typeOptions .= "<option value='{$nrow->id}' class='btype'".(in_array($nrow->id, $typeids) ? ' selected' : '').">{$nrow->typename}</option>\r\n";
    $dsql->SetQuery("SELECT id,typename FROM #@__arctype WHERE reid={$nrow->id} AND (ispart=0 OR ispart=1)");
    $dsql->Execute('s');
    
    while($nrow = $dsql->GetObject('s'))
    {
        $typeOptions .= "<option value='{$nrow->id}' class='stype'".(in_array($nrow->id, $typeids) ? ' selected' : '').">—{$nrow->typename}</option>\r\n";
    }
}
make_hash();
include DedeInclude('templets/sys_admin_user_edit.htm');