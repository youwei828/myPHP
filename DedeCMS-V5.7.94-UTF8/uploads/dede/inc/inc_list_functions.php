<?php
/**
 * 列表对应函数
 *
 * @version        $Id: inc_list_functions.php 1 10:32 2010年7月21日 $
 * @package        DedeCMS.Administrator
 * @founder        IT柏拉图, https://weibo.com/itprato
 * @author         DedeCMS团队
 * @copyright      Copyright (c) 2007 - 2021, 上海卓卓网络科技有限公司 (DesDev, Inc.)
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
if(!isset($registerGlobals))
{
    require_once(dirname(__FILE__)."/../../include/common.inc.php");
}

// 获取栏目名称
function GetTypename($tid)
{
    global $dsql;
    if (empty($tid)) return '';
    if (file_exists(DEDEDATA.'/cache/inc_catalog_base.inc'))
    {
        require_once(DEDEDATA.'/cache/inc_catalog_base.inc');
        global $cfg_Cs;
        if (isset($cfg_Cs[$tid]))
        {
            return base64_decode($cfg_Cs[$tid][3]);
        }
    } else { 
        $row = $dsql->GetOne("SELECT typename FROM #@__arctype WHERE id = '{$tid}'");
        unset($dsql);
        unset($cfg_Cs);
        return isset($row['typename'])? $row['typename'] : '';
    }
    return '';
}

//获得是否推荐的表述
$arcatts = array();
$dsql->Execute('n', 'SELECT * FROM `#@__arcatt` ');
while($arr = $dsql->GetArray('n'))
{
    $arcatts[$arr['att']] = $arr['attname'];
}

function IsCommendArchives($iscommend)
{
    global $arcatts;
    $sn = '';
    foreach($arcatts as $k=>$v)
    {
        $v = cn_substr($v, 2);
        $sn .= (preg_match("#".$k."#", $iscommend) ? ' '.$v : '');
    }
    $sn = trim($sn);
    if($sn=='') return '';
    else return "[<font color='red'>$sn</font>]";
}

//获得推荐的标题
function GetCommendTitle($title,$iscommend)
{
    /*if(preg_match('#c#i',$iscommend))
    {
        $title = "$title<font color='red'>(推荐)</font>";
    }*/
    return $title;
}

//更换颜色
$GLOBALS['RndTrunID'] = 1;
function GetColor($color1,$color2)
{
    $GLOBALS['RndTrunID']++;
    if($GLOBALS['RndTrunID']%2==0)
    {
        return $color1;
    }
    else
    {
        return $color2;
    }
}

//检查图片是否存在
function CheckPic($picname)
{
    if($picname!="")
    {
        return $picname;
    }
    else
    {
        return "images/dfpic.gif";
    }
}

//判断内容是否生成HTML
function IsHtmlArchives($ismake)
{
    if($ismake==1)
    {
        return "已生成";
    }
    else if($ismake==-1)
    {
        return "仅动态";
    }
    else
    {
        return "<font color='red'>未生成</font>";
    }
}

//获得内容的限定级别名称
function GetRankName($arcrank)
{
    global $arcArray,$dsql;
    if(!is_array($arcArray))
    {
        $dsql->SetQuery("SELECT * FROM `#@__arcrank`");
        $dsql->Execute();
        while($row = $dsql->GetObject())
        {
            $arcArray[$row->rank]=$row->membername;
        }
    }
    if(isset($arcArray[$arcrank]))
    {
        return $arcArray[$arcrank];
    }
    else
    {
        if ($arcrank == "-2") {
            return "已删除";
        }
        return "不限";
    }
}

// 获得审核名称
function GetReviewName($id)
{
    global $dsql;
    $row = $dsql->GetOne("SELECT * FROM `#@__arctiny` WHERE `id` = '{$id}'");
    // 开放浏览
    if ($row['arcrank'] == "0") {
        return "审核通过";
    } else {
        // 请审核、请修改
        $row = $dsql->GetOne("SELECT * FROM `#@__archives_log_detail` WHERE `archives_id` = '{$id}' ORDER BY `id` DESC");
        $type = $row['type'];
        if ($type == "添加文档") {
            $type = "待审核";
        }
        if ($type == "修改文档") {
            $type = "待审核";
        }
        if ($type == "快速编辑") {
            $type = "待审核";
        }
        if ($type == "还原文档") {
            $type = "待审核";
        }
        if ($type == "审核文档") {
            $type = "待修改";
        }
        return $type;
    }
}

//判断内容是否为图片文章
function IsPicArchives($picname)
{
    if($picname != '')
    {
        return '<font color=\'red\'>(图)</font>';
    }
    else
    {
        return '';
    }
}