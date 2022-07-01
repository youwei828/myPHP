<?php   if(!defined('DEDEINC')) exit('DedeCMS Error: Request Error!');
/**
 * 管理员后台基本函数
 *
 * @version        $Id:inc_fun_funAdmin.php 1 13:58 2010年7月5日 $
 * @package        DedeCMS.Libraries
 * @founder        IT柏拉图, https://weibo.com/itprato
 * @author         DedeCMS团队
 * @copyright      Copyright (c) 2007 - 2021, 上海卓卓网络科技有限公司 (DesDev, Inc.)
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */

/**
 *  获取拼音信息
 *
 * @access    public
 * @param     string  $str  字符串
 * @param     int  $ishead  是否为首字母
 * @param     int  $isclose  解析后是否释放资源
 * @return    string
 */
function SpGetPinyin($str, $ishead=0, $isclose=1)
{
    global $pinyins;
    $restr = '';
    $str = trim($str);
    $slen = strlen($str);
    if($slen < 2)
    {
        return $str;
    }
    if(count($pinyins) == 0)
    {
        $fp = fopen(DEDEINC.'/data/pinyin.dat', 'r');
        while(!feof($fp))
        {
            $line = trim(fgets($fp));
            $pinyins[$line[0].$line[1]] = substr($line, 3, strlen($line)-3);
        }
        fclose($fp);
    }
    for($i=0; $i<$slen; $i++)
    {
        if(ord($str[$i])>0x80)
        {
            $c = $str[$i].$str[$i+1];
            $i++;
            if(isset($pinyins[$c]))
            {
                if($ishead==0)
                {
                    $restr .= $pinyins[$c];
                }
                else
                {
                    $restr .= $pinyins[$c][0];
                }
            }else
            {
                $restr .= "_";
            }
        }else if( preg_match("/[a-z0-9]/i", $str[$i]) )
        {
            $restr .= $str[$i];
        }
        else
        {
            $restr .= "_";
        }
    }
    if($isclose==0)
    {
        unset($pinyins);
    }
    return $restr;
}


/**
 *  创建目录
 *
 * @access    public
 * @param     string  $spath 目录名称
 * @return    string
 */
function SpCreateDir($spath)
{
    global $cfg_dir_purview,$cfg_basedir,$cfg_ftp_mkdir,$isSafeMode;
    if($spath=='')
    {
        return true;
    }
    $flink = false;
    $truepath = $cfg_basedir;
    $truepath = str_replace("\\","/",$truepath);
    $spaths = explode("/",$spath);
    $spath = "";
    foreach($spaths as $spath)
    {
        if($spath=="")
        {
            continue;
        }
        $spath = trim($spath);
        $truepath .= "/".$spath;
        if(!is_dir($truepath) || !is_writeable($truepath))
        {
            if(!is_dir($truepath))
            {
                $isok = MkdirAll($truepath,$cfg_dir_purview);
            }
            else
            {
                $isok = ChmodAll($truepath,$cfg_dir_purview);
            }
            if(!$isok)
            {
                echo "创建或修改目录：".$truepath." 失败！<br>";
                CloseFtp();
                return false;
            }
        }
    }
    CloseFtp();
    return true;
}

function jsScript($js)
{
	$out = "<script type=\"text/javascript\">";
	$out .= "//<![CDATA[\n";
	$out .= $js;
	$out .= "\n//]]>";
	$out .= "</script>\n";

	return $out;
}

/**
 *  获取编辑器
 *
 * @access    public
 * @param     string  $fname 表单名称
 * @param     string  $fvalue 表单值
 * @param     string  $nheight 内容高度
 * @param     string  $etype 编辑器类型
 * @param     string  $gtype 获取值类型
 * @param     string  $isfullpage 是否全屏
 * @return    string
 */
function SpGetEditor($fname,$fvalue,$nheight="350",$etype="Basic",$gtype="print",$isfullpage="false",$bbcode=false)
{
    global $cfg_ckeditor_initialized;
    if(!isset($GLOBALS['cfg_html_editor']))
    {
        $GLOBALS['cfg_html_editor']='fck';
    }
    if($gtype=="")
    {
        $gtype = "print";
    }
    if($GLOBALS['cfg_html_editor']=='fck')
    {
        require_once(DEDEINC.'/FCKeditor/fckeditor.php');
        $fck = new FCKeditor($fname);
        $fck->BasePath        = $GLOBALS['cfg_cmspath'].'/include/FCKeditor/' ;
        $fck->Width        = '100%' ;
        $fck->Height        = $nheight ;
        $fck->ToolbarSet    = $etype ;
        $fck->Config['FullPage'] = $isfullpage;
        if($GLOBALS['cfg_fck_xhtml']=='Y')
        {
            $fck->Config['EnableXHTML'] = 'true';
            $fck->Config['EnableSourceXHTML'] = 'true';
        }
        $fck->Value = $fvalue ;
        if($gtype=="print")
        {
            $fck->Create();
        }
        else
        {
            return $fck->CreateHtml();
        }
    }
    else if($GLOBALS['cfg_html_editor']=='ckeditor')
    {
        require_once(DEDEINC.'/ckeditor/ckeditor.php');
        $CKEditor = new CKEditor();
        $CKEditor->basePath = $GLOBALS['cfg_cmspath'].'/include/ckeditor/' ;
        $config = $events = array();
        $config['extraPlugins'] = 'dedepage,multipic,addon';
		if($bbcode)
		{
			$CKEditor->initialized = true;
			$config['extraPlugins'] .= ',bbcode';
			$config['fontSize_sizes'] = '30/30%;50/50%;100/100%;120/120%;150/150%;200/200%;300/300%';
			$config['disableObjectResizing'] = 'true';
			$config['smiley_path'] = $GLOBALS['cfg_cmspath'].'/images/smiley/';
			// 获取表情信息
			require_once(DEDEDATA.'/smiley.data.php');
			$jsscript = array();
			foreach($GLOBALS['cfg_smileys'] as $key=>$val)
			{
				$config['smiley_images'][] = $val[0];
				$config['smiley_descriptions'][] = $val[3];
				$jsscript[] = '"'.$val[3].'":"'.$key.'"';
			}
			$jsscript = implode(',', $jsscript);
			echo jsScript('CKEDITOR.config.ubb_smiley = {'.$jsscript.'}');
		}

        $GLOBALS['tools'] = empty($toolbar[$etype])? $GLOBALS['tools'] : $toolbar[$etype] ;
        $config['toolbar'] = $GLOBALS['tools'];
        $config['height'] = $nheight;
        $config['skin'] = 'kama';
        $CKEditor->returnOutput = TRUE;
        $code = $CKEditor->editor($fname, $fvalue, $config, $events);
        if($gtype=="print")
        {
            echo $code;
        }
        else
        {
            return $code;
        }
    }
    else if($GLOBALS['cfg_html_editor']=='wangEditor')
    {
        $link = $GLOBALS["cfg_cmspath"]."/include/wangEditor/style.css";
        $script = $GLOBALS["cfg_cmspath"]."/include/wangEditor/index.min.js";
        $uploadImage = $GLOBALS["cfg_cmspath"]."/include/dialog/select_images_post_wangEditor.php";
        $uploadVideo = $GLOBALS["cfg_cmspath"]."/include/dialog/select_media_post_wangEditor.php";

        $code = '
            <link href="'.$link.'" rel="stylesheet">
            <style>
                #editor-toolbar {
                    border: 1px solid #ccc;
                }
                #editor-text-area {
                    border: 1px solid #ccc;
                    border-top: none;
                    font-size: 16px;
                    height: '.$nheight.'px;
                }
                #status {
                    margin-top: 10px;
                    margin-bottom: 20px;
                    color: #999;
                }

                #editor-text-area ul li {
                    list-style-type: disc;
                }
                #editor-text-area ol li {
                    list-style-type: decimal;
                }
                #editor-text-area a {
                    color: rgb(0, 0, 238) !important;
                }
            </style>
            <div>
            <div id="editor-toolbar"></div>
            <div id="editor-text-area"></div>
            <textarea id="'.$fname.'" name="'.$fname.'" style="display:none;"></textarea>
            </div>
            <div id="status"></div>
            <script src="'.$script.'"></script>
            <script>
                const E = window.wangEditor

                const editorConfig = { MENU_CONF: {} }
                editorConfig.placeholder = "请输入内容"
                editorConfig.MENU_CONF["uploadImage"] = {
                    server: "'.$uploadImage.'",
                    fieldName: "imgfile",
                    maxFileSize: 1 * 1024 * 1024,
                    onFailed(file, res) {
                        alert(res.message)
                    },
                    onError(file, err, res) {
                        alert(err)
                    }
                }
                editorConfig.MENU_CONF["uploadVideo"] = {
                    server: "'.$uploadVideo.'",
                    fieldName: "upfile",
                    maxFileSize: 10 * 1024 * 1024,
                    onFailed(file, res) {
                        alert(res.message)
                    },
                    onError(file, err, res) {
                        alert(err)
                    }
                }
                editorConfig.onChange = (editor) => {
                    const selectionText = editor.getSelectionText()
                    const text = editor.getText()
                    const html = editor.getHtml()
                    document.getElementById("status").innerHTML = `当前文字数量：${text.length}，选中文字：${selectionText}`
                    document.getElementById("'.$fname.'").value = html
                }
                const editor = E.createEditor({
                    selector: "#editor-text-area",
                    content: [],
                    html: `'.$fvalue.'`,
                    config: editorConfig
                })

                const toolbarConfig = {
                    excludeKeys: [
                        "emotion"
                    ]
                }
                const toolbar = E.createToolbar({
                    editor,
                    selector: "#editor-toolbar",
                    config: toolbarConfig,
                    mode: "default"
                })
            </script>
        ';

        if($gtype=="print")
        {
            echo $code;
        }
        else
        {
            return $code;
        }
    }
}

/**
 *  获取更新信息
 *
 * @return    void
 */
function SpGetNewInfo()
{
    global $cfg_version;
    $nurl = $_SERVER['HTTP_HOST'];
    if( preg_match("#[a-z\-]{1,}\.[a-z]{2,}#i",$nurl) ) {
        $nurl = urlencode($nurl);
    }
    else {
        $nurl = "test";
    }
    $offUrl = "http://newver.api.dedecms.com/index.php?c=info57&version={$cfg_version}&formurl={$nurl}";
    return $offUrl;
}

?>