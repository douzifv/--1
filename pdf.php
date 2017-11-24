<?php

require_once('./TCPDF-master/tcpdf.php'); 
include('E:/wamp64/www/lx/pdffile/pictext.php');

//定义页眉页脚
class MYPDF extends TCPDF {

	//页眉
	public function Header() {
		$this->SetTextColorArray(array(66,66,66) , false);
		// Logo
		$this->Image('E:/wamp64/www/lx/pdffile/logo.png', 20, 10, '16', '18', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// 字体
		$this->SetFont('stsongstdlight', '', 12);
		// 标题 坐标
		$this->Text(54,15,'英才网联个人履历认证报告07061944444444111');
		$this->Text(150,15,'委托人 ：阿萨德');
	}
	//页尾
	public function Footer() {
		 // 坐标
		 $this->SetY(-13);
		 $this->SetX(310);
		 // 字体
		 $this->SetFont('stsongstdlight', '', 10);
		if($this->getGroupPageNo() != 1){
		 	//$this->Cell(0, 10, $this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		 	$this->Cell(0, 10, '第'.$this->getAliasNumPage().'页', 0, false, 'C', 0, '', 0, false, 'T', 'M');
		}else if($this->PageNoFormatted() == 2){
			//$this->Cell(0, 10, $this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
			$this->Cell(0, 10, '第'.$this->getAliasNumPage().'页', 0, false, 'C', 0, '', 0, false, 'T', 'M');
		}
		//$this->Cell(0, 10, $this->PageNoFormatted().'/'.$this->getGroupPageNo().'/'.$this->getAliasNumPage().'/'.$this->getPageGroupAlias().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}


//实例化 
$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false); 
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//YCWL_LLRZ_800auth.com@800HR.COM  修改密码   加密
$pdf->SetProtection(array('copy' , 'modify' , 'annot-forms' , 'fill-forms' , 'extract' , 'assemble' , 'print-high'), '', 'YCWL_LLRZ_800auth.com@800HR.COM', 3, null);
//开始页数
$pdf->setStartingPageNumber(-1);

// 设置文档信息 
$pdf->SetCreator('英才网联'); 
$pdf->SetAuthor('zzk'); 
$pdf->SetTitle('履历认证报告'); 
$pdf->SetSubject('履历认证报告'); 
$pdf->SetKeywords('TCPDF, PDF, PHP'); 

//$pdf->setPrintHeader(false); //去掉头图横线
//$pdf->setPrintFooter(false); //页面底部更显取消
// 页边距
$pdf->SetMargins(20, 35, 20);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// 自动分页
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//开头
//重新设置页数
$pdf->startPageGroup();
$pdf->AddPage(); 
$bMargin = $pdf->getBreakMargin();
$auto_page_break = $pdf->getAutoPageBreak();
$pdf->SetAutoPageBreak(false, 0);
// 首页水印图片
$pdf->Image($imgPath, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
$pdf->setPageMark();
unlink($imgPath);

//内容
//重新设置页数
$pdf->startPageGroup();
$pdf->AddPage();
$pdf->SetFont('stsongstdlight');
//书签
$pdf->Bookmark('阅读说明', 0, 0, '', '', array(0,64,128));
//内容
$html = '<h1 style="color:#0bc0e8;background-color:#f6f7fb;text-align:center;line-height:30px;">阅读说明</h1>';
$pdf->writeHTML($html);
$pdf->SetFont('stsongstdlight', '', 12);
//$pdf->setCellPaddings(10, 10, 10, 10);
//$html_con = '       委托人_______已承诺提供的履历信息与相关材料均真实可靠，英才网联仅对其个人履历的认证结果及其真实性负责，若因履历信息的真实性问题导致的可能后果及责任，均由委托人自行承担。';
// $pdf->MultiCell(0, 0, $html_con, 0, 'J',false, 1, '', '',  true, 20,false, true, 1000, 'T', false);
//$pdf->MultiCell(0,0,$html_con);
//阅读说明！！！！！！！！！！！！！
//字体颜色
$pdf->SetTextColorArray(array(66,66,66) , false);
//$pdf->Text(42,62,'阿萨德');
/*$html_con = '委托人阿萨德已承诺提供的履历信息与相关材料均真实可靠，英才网联仅对其个人履历的认证结果及其真实性负责，若因履历信息的真实性问题导致的可能后果及责任，均由委托人自行承担。';*/
/*$html = "
<style>
	.content {
		line-height:30pt;
		letter-spacing: 1pt;
	}
</style>
";*/
$html = file_get_contents('./style.css', false);
/*$a = "
<span class=\"content\">&nbsp;&nbsp;</sapn><span class=\"content\">委托人</span><u>阿萨德</u><span class=\"content\">已承诺提供的履历信息与相关材料均真实可靠，
英才网联仅对其个人履历的认证结果及其真实性负责，若因履历信息的真实性问题导致的可能后果及责任，均由委托人自行承担。</span>
<br>
<span class='content'>&nbsp;&nbsp;</sapn><span class='content'>认证项目表中的“真实性”是指各项履历信息的鉴定结果。 “√”说明该项信息与实际一致；空白则是由于种种因素，导致现有的认证渠道未确切证实该项信息与实际相符，但不代表该项信息不真实。带有“已认证”标识，表示该认证项目下的内容全部属实。如用人单位需进一步验证，可由委托人自行提供更多信息加以证明。</span>
";*/
//$pdf->writeHTML($a.$html, true, false, true, false, '');

$b = '阿萨德';
$html_1 = "
<span class=\"content\">&nbsp;&nbsp;</sapn><span class=\"content\">委托人$b</span><u>阿萨德</u><span class=\"content\">已承诺提供的履历信息与相关材料均真实可靠，
英才网联仅对其个人履历的认证结果及其真实性负责，若因履历信息的真实性问题导致的可能后果及责任，均由委托人自行承担。</span>
<br>
<span class='content'>&nbsp;&nbsp;</sapn><span class='content'>认证项目表中的“真实性”是指各项履历信息的鉴定结果。 “√”说明该项信息与实际一致；空白则是由于种种因素，导致现有的认证渠道未确切证实该项信息与实际相符，但不代表该项信息不真实。带有“已认证”标识，表示该认证项目下的内容全部属实。如用人单位需进一步验证，可由委托人自行提供更多信息加以证明。</span>
";
$pdf->writeHTML($html.$html_1, true, false, true, false, '');


//履历认证报告
$pdf->AddPage();
$pdf->SetFont('stsongstdlight', '', 14);
//内容
$html = '<h1 style="color:#0bc0e8;background-color:#f6f7fb;text-align:center;line-height:30px;">履历认证报告</h1>';
$pdf->writeHTML($html);
$html_1 = '<h1 style="color:black;font-family:stsongstdlight;font-size:16pt;">报告声明</h1>';
$pdf->writeHTML($html_1);
$pdf->SetFont('stsongstdlight', '', 13);
$pdf->Text(34,72,'阿萨德');
$pdf->Text(29,72,'受_______委托，仅按照委托人自主提供的信息，通过专业规范的调查流程，提');
$pdf->Text(20,81,'供以下真实有效的认证报告，旨在保证委托人简历的真实性、提高其在应聘过程中的');
$pdf->Text(20,90,'可信度与竞争力。截至本认证报告出具之日前（2017-08-23），以下信息均通过正规');
$pdf->Text(20,99,'合法途径获得，由英才网联（北京）咨询有限公司（以下简称:英才网联）整理记录而');
$pdf->Text(20,108,'成，不代表英才网联及其任何员工的主观意见。本认证报告仅限个人应聘求职所用，');
$pdf->Text(20,117,'英才网联不会传播用户的个人信息或将其泄露给第三方，凡非英才网联原因导致的个');
$pdf->Text(20,126,'人信息泄露，英才网联不承担任何责任。');
/*$html_con = '       受_______委托，仅按照委托人自主提供的信息，通过专业规范的调查流程，提供以下真实有效的认证报告，旨在保证委托人简历的真实性、提高其在应聘过程中的可信度与竞争力。截至本认证报告出具之日前（2017-08-23），以下信息均通过正规合法途径获得，由英才网联（北京）咨询有限公司（以下简称:英才网联）整理记录而成，不代表英才网联及其任何员工的主观意见。本认证报告仅限个人应聘求职所用，英才网联不会传播用户的个人信息或将其泄露给第三方，凡非英才网联原因导致的个人信息泄露，英才网联不承担任何责任。';
$pdf->MultiCell(0,0,$html_con,0);*/
$pdf->LN(14);
$html_2 = '<table border="0" cellpadding="0" bgcolor="#0BC1E9" cellspacing="0"><tr><td width="5mm" height="10mm">&nbsp;</td><td width="170mm" height="10mm"><span style="font-family:stsongstdlight;font-size:16pt;color:#ffffff;line-height:11mm;font-weight:bold;">个人基本信息</span></td></tr></table>';
$pdf->writeHTML($html_2);
$pdf->LN(-6);//#FBFBFD
$html_cont = '<table border="0" cellpadding="0" bgcolor="#FBFBFD" cellspacing="0"><tr><td width="5mm" height="10mm">&nbsp;&nbsp;</td><td width="49.8mm" height="10mm"><span style="font-family:stsongstdlight;font-size:14pt;color:#666666;line-height:15mm;font-weight:bold;">姓名</span></td><td width="120mm" style="line-height:15mm;">阿萨德</td></tr><tr><td width="5mm" height="10mm">&nbsp;&nbsp;</td><td width="49.8mm" height="10mm"><span style="font-family:stsongstdlight;font-size:14pt;color:#666666;font-weight:bold;">性别</span></td><td width="120mm">男</td></tr><tr><td width="5mm" height="10mm">&nbsp;&nbsp;</td><td width="49.8mm" height="10mm"><span style="font-family:stsongstdlight;font-size:14pt;color:#666666;font-weight:bold;">学历</span></td><td width="120mm">本科</td></tr><tr><td width="5mm" height="10mm">&nbsp;&nbsp;</td><td width="49.8mm" height="10mm"><span style="font-family:stsongstdlight;font-size:14pt;color:#666666;font-weight:bold;">专业</span></td><td width="120mm">表演</td></tr><tr><td width="5mm" height="10mm">&nbsp;&nbsp;</td><td width="49.8mm" height="10mm"><span style="font-family:stsongstdlight;font-size:14pt;color:#666666;font-weight:bold;">身份证</span></td><td width="120mm">21212121212121212121</td></tr><tr><td width="5mm" height="10mm">&nbsp;&nbsp;</td><td width="49.8mm" height="10mm"><span style="font-family:stsongstdlight;font-size:14pt;color:#666666;font-weight:bold;">户籍所在地</span></td><td width="120mm">中国北京</td></tr><tr><td width="5mm" height="10mm">&nbsp;&nbsp;</td><td width="49.8mm" height="10mm"><span style="font-family:stsongstdlight;font-size:14pt;color:#666666;font-weight:bold;">工作经历</span></td><td width="120mm"></td></tr><tr><td width="5mm" height="10mm">&nbsp;&nbsp;</td><td width="169.8mm" height="10mm"><span style="font-family:stsongstdlight;font-size:13pt;color:#666666;font-weight:bold;">2009.01——2012.04&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;XXX公司&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;XXX（岗位）</span></td></tr><tr><td width="5mm" height="10mm">&nbsp;&nbsp;</td><td width="169.8mm" height="10mm"><span style="font-family:stsongstdlight;font-size:13pt;color:#666666;font-weight:bold;">2009.01——2012.04&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;XXX公司&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;XXX（岗位）</span></td></tr></table>';
$pdf->writeHTML($html_cont);
//个人头像
$pdf->Image('E:/wamp64/www/lx/pdffile/003.jpg', 155, 157, '27', '36', 'jpg', '', 'T', false, 300, '', false, false, 0, false, false, false);

//认证报告概述
$pdf->AddPage();
//$pdf->SetFont('stsongstdlight', '', 12);
//书签
$pdf->Bookmark('一、认证报告概述', 0, '-1', '', '', array(66,66,66));
//内容
$html_1 = '<h1 style="color:black;font-family:stsongstdlight;font-size:20pt;">一、认证报告概述</h1>';
$pdf->writeHTML($html_1);
$pdf->LN(4);
$html_2 = '<table border="0" cellpadding="0" bgcolor="#0BC1E9" cellspacing="0"><tr><td width="5mm" height="11mm">&nbsp;</td><td width="81mm" height="11mm"><span style="font-family:stsongstdlight;font-size:16pt;color:#ffffff;line-height:11mm;font-weight:bold;">认证项目</span></td><td width="89mm" style="font-family:stsongstdlight;font-size:16pt;color:#ffffff;line-height:11mm;font-weight:bold;">鉴定结果</td></tr></table>';
$pdf->writeHTML($html_2);
$pdf->LN(-6);//#FBFBFD
$html_cont = '<table border="0" cellpadding="0" bgcolor="#FBFBFD" cellspacing="0"><tr><td width="5mm" height="10mm">&nbsp;&nbsp;</td><td width="81mm" height="10mm"><span style="font-family:stsongstdlight;font-size:12pt;color:#666666;line-height:15mm;font-weight:bold;">身份证信息</span></td><td width="90mm" style="line-height:15mm;font-weight:bold;">已认证，共鉴定7项内容</td></tr><tr><td width="5mm" height="10mm">&nbsp;&nbsp;</td><td width="81mm" height="10mm"><span style="font-family:stsongstdlight;font-size:12pt;color:#666666;font-weight:bold;">教育背景</span></td><td width="90mm" style="font-weight:bold;">已鉴定6项内容</td></tr><tr><td width="5mm" height="10mm">&nbsp;&nbsp;</td><td width="81mm" height="10mm"><span style="font-family:stsongstdlight;font-size:12pt;color:#666666;font-weight:bold;">资格证书</span></td><td width="90mm" style="font-weight:bold;">已认证，共鉴定5项内容</td></tr><tr><td width="5mm" height="10mm">&nbsp;&nbsp;</td><td width="81mm" height="10mm"><span style="font-family:stsongstdlight;font-size:12pt;color:#666666;font-weight:bold;">工作经历</span></td><td width="90mm" style="font-weight:bold;">已鉴定16项内容</td></tr></table>';
$pdf->writeHTML($html_cont);
$pdf->LN(14);
$pdf->Bookmark('二、身份信息认证', 0, 0, '', '', array(66,66,66));
//认证图片
$pdf->Image('E:/wamp64/www/lx/pdffile/004_1.png', 162.5, 128, '32', '12.5', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
$html_1 = '<h1 style="color:black;font-family:stsongstdlight;font-size:20pt;">二、身份信息认证</h1>';
$pdf->writeHTML($html_1);
$pdf->LN(4);
$html_2 = '<table border="0" cellpadding="0" bgcolor="#0BC1E9" cellspacing="0"><tr><td width="5mm" height="11mm">&nbsp;</td><td width="145mm" height="11mm"><span style="font-family:stsongstdlight;font-size:16pt;color:#ffffff;line-height:11mm;font-weight:bold;">委托人提供信息</span></td><td width="25mm" height="11mm" style="font-family:stsongstdlight;font-size:16pt;color:#ffffff;line-height:11mm;font-weight:bold;">真实性</td></tr></table>';
$pdf->writeHTML($html_2);
$pdf->LN(-5);//#FBFBFD bgcolor="#FBFBFD"
$html_cont = '<table border="0" cellpadding="0" cellspacing="0"><tr style="background-color:#ffffff"><td width="5mm" height="11mm">&nbsp;&nbsp;</td><td width="39.8mm" height="11mm"><span style="font-family:stsongstdlight;font-size:12pt;color:#666666;line-height:11mm;vertical-align:middle;">姓名</span></td><td width="130mm" style="line-height:11mm;font-weight:bold;font-size:12pt;vertical-align:middle;">阿萨德</td></tr><tr style="background-color:#FBFBFD"><td width="5mm" height="13mm">&nbsp;&nbsp;</td><td width="39.8mm" height="11mm"><span style="font-family:stsongstdlight;font-size:12pt;color:#666666;line-height:11mm;vertical-align:middle;">性别</span></td><td width="130mm" style="font-weight:bold;line-height:11mm;font-size:12pt;vertical-align:middle;">男</td></tr><tr style="background-color:#ffffff"><td width="5mm" height="11mm">&nbsp;&nbsp;</td><td width="39.8mm" height="13mm"><span style="font-family:stsongstdlight;font-size:12pt;color:#666666;line-height:11mm;">民族</span></td><td width="130mm" style="font-weight:bold;line-height:11mm;">本科</td></tr><tr style="background-color:#FBFBFD"><td width="5mm" height="13mm">&nbsp;&nbsp;</td><td width="39.8mm" height="11mm"><span style="font-family:stsongstdlight;font-size:12pt;color:#666666;line-height:11mm;">出生日期</span></td><td width="130mm" style="font-weight:bold;line-height:11mm;">男</td></tr><tr style="background-color:#ffffff"><td width="5mm" height="11mm">&nbsp;&nbsp;</td><td width="39.8mm" height="13mm"><span style="font-family:stsongstdlight;font-size:12pt;color:#666666;line-height:11mm;">国家/地区</span></td><td width="130mm" style="font-weight:bold;line-height:11mm;">本科</td></tr><tr style="background-color:#FBFBFD"><td width="5mm" height="13mm">&nbsp;&nbsp;</td><td width="39.8mm" height="11mm"><span style="font-family:stsongstdlight;font-size:12pt;color:#666666;line-height:11mm;">户籍所在地</span></td><td width="130mm" style="font-weight:bold;line-height:11mm;">男</td></tr><tr style="background-color:#ffffff"><td width="5mm" height="11mm">&nbsp;&nbsp;</td><td width="39.8mm" height="13mm"><span style="font-family:stsongstdlight;font-size:12pt;color:#666666;line-height:11mm;">身份证号码</span></td><td width="130mm" style="font-weight:bold;line-height:11mm;">本科</td></tr><tr style="background-color:#FBFBFD"><td width="5mm" height="13mm">&nbsp;&nbsp;</td><td width="169.8mm" height="11mm"><span style="font-family:stsongstdlight;font-size:12pt;color:#0bc0e8;line-height:11mm;">认证渠道：全国公民身份证号码查询服务中心</span></td></tr></table>';
$pdf->writeHTML($html_cont);
//姓名认证
$pdf->Image('E:/wamp64/www/lx/pdffile/005.png', 175, 155, '6', '6', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
//性别认证
$pdf->Image('E:/wamp64/www/lx/pdffile/005.png', 175, 168, '6', '6', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
//民族认证
$pdf->Image('E:/wamp64/www/lx/pdffile/005.png', 175, 181, '6', '6', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
//出生日期认证
$pdf->Image('E:/wamp64/www/lx/pdffile/005.png', 175, 194, '6', '6', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
//国家地区认证
$pdf->Image('E:/wamp64/www/lx/pdffile/005.png', 175, 207, '6', '6', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
//户籍认证
$pdf->Image('E:/wamp64/www/lx/pdffile/005.png', 175, 220, '6', '6', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
//身份证认证
$pdf->Image('E:/wamp64/www/lx/pdffile/005.png', 175, 233, '6', '6', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);

//身份证照片A

//身份证照片B

//身份证照片C


//身份信息认证
/*$pdf->AddPage();
$pdf->SetFont('stsongstdlight', '', 12);
//书签
$pdf->Bookmark('二、身份信息认证', 0, 0, '', '', array(66,66,66));
//内容
$pdf->Cell(10, 10, '身份信息认证', 0, 1, 'L');*/

//教育背景认证
$pdf->AddPage();
$pdf->SetFont('stsongstdlight', '', 12);
//书签
$pdf->Bookmark('三、教育背景认证', 0, 0, '', '', array(66,66,66));
//内容
$pdf->Cell(0, 50, '教育背景认证', 0, 1, 'L');

//资格证书认证
$pdf->AddPage();
$pdf->SetFont('stsongstdlight', '', 12);
//书签
$pdf->Bookmark('四、资格证书认证', 0, 0, '', '', array(66,66,66));
//内容
$pdf->Cell(0, 50, '资格证书认证', 0, 1, 'L');

//工作经历认证
$pdf->AddPage();
$pdf->SetFont('stsongstdlight', '', 12);
//书签
$pdf->Bookmark('五、工作经历认证', 0, 0, '', '', array(66,66,66));
//内容
$pdf->Cell(0, 50, '工作经历认证', 0, 1, 'L');

//履历认证介绍
$pdf->AddPage();
$pdf->SetFont('stsongstdlight', '', 12);
//书签
$pdf->Bookmark('六、履历认证介绍', 0, 0, '', '', array(66,66,66));
//内容
$pdf->Cell(0, 10, '履历认证介绍', 0, 1, 'L');

//版权声明
$pdf->AddPage();
$pdf->SetFont('stsongstdlight', '', 12);
//书签
$pdf->Bookmark('版权声明', 0, 0, '', '', array(66,66,66));
//内容
$pdf->Cell(0, 10, '版权声明', 0, 1, 'L');

$pdf->AddPage();
$pdf->Bookmark('(一) 含义', 1, 0, '', '', array(66,66,66));
$pdf->Cell(0, 10, '含义', 0, 1, 'L');

$pdf->Bookmark('(二) 价值', 1, 0, '', '', array(66,66,66));
$pdf->Cell(0, 10, '价值', 0, 1, 'L');

$pdf->Bookmark('(一) 鉴定流程', 1, 0, '', '', array(66,66,66));
$pdf->Cell(0, 10, '鉴定流程', 0, 1, 'L');

//版权声明
$pdf->AddPage();
$pdf->Bookmark('版权声明', 0, 0, '', '', array(66,66,66));
$html = '<h1 style="color:#0bc0e8;background-color:#f6f7fb;text-align:center;line-height:30px;">版权声明</h1>';
$pdf->writeHTML($html);

//目录
$pdf->startPageGroup();
$pdf->addTOCPage();
//$pdf->SetFont('stsongstdlight', 'B');
//$pdf->SetFontSize(20);
//目录标题
$html = '<h1 style="color:#0bc0e8;background-color:#f6f7fb;text-align:center;line-height:30px;">目录</h1>';
$pdf->writeHTML($html);
// 索引样式
$bookmark_templates = array();
$bookmark_templates[0] = '<table border="0" cellpadding="0" cellspacing="0"><tr><td width="145mm" height="10mm"><span style="font-family:stsongstdlight;font-size:15pt;">#TOC_DESCRIPTION#</span></td><td width="25mm" height="10mm"><span style="font-family:courier;font-size:15pt;" align="right">#TOC_PAGE_NUMBER#</span></td></tr></table>';
$bookmark_templates[1] = '<table border="0" cellpadding="0" cellspacing="0"><tr><td width="5mm" height="10mm">&nbsp;</td><td width="149mm" height="10mm"><span style="font-family:stsongstdlight;font-size:15pt;">#TOC_DESCRIPTION#</span></td><td width="16mm" height="10mm"><span style="font-family:courier;font-size:15pt;" align="right">#TOC_PAGE_NUMBER#</span></td></tr></table>';
//展示页数
$pdf->addHTMLTOC(2, '目录', $bookmark_templates);
$pdf->endTOCPage();


////结尾
$pdf->startPageGroup();
$pdf->AddPage(); 
$pdf->SetAutoPageBreak(false, 0);
$pdf->Image('E:/wamp64/www/lx/pdffile/002.png', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
$pdf->setPageMark();

$pdf->Output('t.pdf', 'I');
