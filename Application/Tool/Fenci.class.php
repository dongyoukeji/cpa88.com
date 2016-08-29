<?php
namespace Tool;
/**
 * Fenci类是基于pscws进行二次封装的，本类提供了分词fenci方法和关键keyword方法，在使用本类fenci在获取词性的时候在原来的基础上增加了code词性代码和title的词性举例说明。
 * 如的到的结果如下：Array
 *       (
 *           [word] => 失
 *           [off] => 0         //所在位置
 *           [idf] => 0         //逆文本词频（词在文本中出现的频率）
 *           [len] => 3         //所占字节数
 *           [attr] => v        //词性标识
 *           [code] => 19		//词性代码
 *           [title] => 动词    //词性说明
 *       )
 * 同样在使用keyword进行去关键词的时候也会有code词性代码和title的词性，如得到的结果如下:
 *     Array
 *     (
*           [word] => 孩子					//关键词
*           [times] => 8  				    //出现次数
*           [weight] => 38.240001678467		//关键词权重
*           [attr] => n 					//词性标识
*           [code] => 2  					//词性代码
*           [title] => 名词 				//词性说明
*      )
*分词使用方法是：
*	1、import('Class.Fenci',APP_PATH);
* 	2、$fenci=new Fenci();
* 	3、$fenci->fenci('济南的冬天');
*关键词使用方法是：
*	1、import('Class.Fenci',APP_PATH);
* 	2、$fenci=new Fenci();
* 	3、$fenci->keyword('济南的冬天');
*在获取关键词的时候可以支持过来条件，默认的情况下不启用过滤，获取所有的关键词。如果需要过滤关键词的可以下上第二个参数，比如:
*  $fenci->keyword('济南的冬天','ns');     //获取词性为ns----地名的关键词
*   Array
*        (
*            [word] => 济南
*            [times] => 1
*            [weight] => 7.7399997711182
*            [attr] => ns
*            [code] => 8
*            [title] => 地名
*        )
*如果词性的标识很难记住的话也可以使用中文'地名'，也可以获取到相同的结果,比如：
*  $fenci->keyword('济南的冬天','地名');
*/
class Fenci{
	private $attr='n,名词|nr,人名|nr1,汉语姓氏|nr2,汉语名字|nrj,日语人名|nrf,音译人名|ns,地名|nsf,音译地名|nt,机构团体名|nz,其它专名|nl,名词性惯用语|ng,名词性语素|nx,字母专名|t,时间词|tg,时间词性语素|s,处所词|f,方位词|v,动词|vd,副动词|vn,名动词|vshi,动词“是”|vyou,动词“有”|vf,趋向动词|vx,形式动词|vi,不及物动词（内动词）|vl,动词性惯用语|vg,动词性语素|a,形容词|ad,副形词|an,名形词|ag,形容词性语素|al,形容词性惯用语|b,区别词|bl,区别词性惯用语|z,状态词|r,代词|rr,人称代词|rz,指示代词|rzt,时间指示代词|rzs,处所指示代词|rzv,谓词性指示代词|ry,疑问代词|ryt,时间疑问代词|rys,处所疑问代词|ryv,谓词性疑问代词|rg,代词性语素|m,数词|mq,数量词|q,量词|qv,动量词|qt,时量词|d,副词|p,介词|pba,介词“把”|pbei,介词“被”|c,连词|cc,并列连词|u,助词|uzhe,着|ule,了、喽|uguo,过|ude1,的、底|ude2,地|ude3,得|u,助词|uj,结构助词的|ud,结构助词|usuo,所|udeng,等、等等、云云|uyy,一样、一般、似的、般|udh,的话|uls,来讲、来说、而言、说来|uzhi,之|ulian,连（“连小学生都会”|e,叹词|y,语气词|o,拟声词|h,前缀、前接成分|k,后缀、后接成分|x,字符串|xx,非语素字|xu,网址URL|w,标点符号|wkz,左括号，全角：（、〔、［、｛、《、【、〖、〈、半角：(、[、{、<|wky,右括号，全角：）、〕、］、｝、》、】、〗、〉、半角：、)、]、{、>|wyz,左引号，全角：“、‘、『|wyy,右引号，全角：”、’、』|wj,句号，全角：。|ww,问号，全角：？、半角：?|wt,叹号，全角：！、半角：!|wd,逗号，全角：，、半角：,|wf,分号，全角：；、半角：、;|wn,顿号，全角：、|wm,冒号，全角：：、半角：、:|ws,省略号，全角：……、…|wp,破折号，全角：——、－－、——－、半角：---、----|wb,百分号千分号，全角：％、‰、半角：%|wh,单位符号，全角：￥、＄、￡、°、℃、半角：$|b,区别词|d,副词|dg,副语素|g,语素如dg或ag|z,状态词|un,未知';
	/**
	 * [fenci 获取分词属性]
	 * @param  [type] $text [description]
	 * @return [type]       [description]
	 */
	public function fenci($text){
		vendor('pscws4.class#pscws4');
		$pscws = new \PSCWS4();
		$pscws->set_charset('utf-8');
		$pscws->send_text($text);
		$pscws->set_ignore(true);
		$some = $pscws->get_result();
		return $this->makeAttr($some);
	}
	/**
	 * [keyword 获取关键词]
	 * @param  [type] $text   [文本]
	 * @param  string $filter [过滤条件]
	 * @return [type]         [description]
	 */
	public function keyword($text,$filter=''){
		$filter=$this->makeFilter($filter);
		
		vendor('pscws4.class#pscws4');
		$pscws = new \PSCWS4();
		$pscws->set_charset('utf-8');
		$pscws->send_text($text);
		$some = $pscws->get_tops(10,$filter);
		$_result = $this->makeAttr($some);
		$filter_reg=explode(',',str_replace('~','',$filter));
		
		if(!empty($filter)){
			if($filter!="~"){
				foreach ($_result as $k => $v) {
					if(in_array($v['attr'],$filter_reg)){
						$_res[]=$v;
					}
				}
			}else{
				$_res=$_result;
			}
		}else{
			$_res=$_result;
		}
		return $_res;
	}

	/**
	 * [makeAttr 重组分词属性]
	 * @param  [type] $text [description]
	 * @return [type]       [description]
	 */
	private function makeAttr($text){	
		$temp=explode('|', $this->attr);
		$i=1;
		foreach ($temp as $v) {
			$ex1=explode(',', $v);
			$temp1[$ex1[0]]=array(
					$ex1[0]=>$ex1[1],
					'code'=>++$i
				);

		}
		foreach ($text as $t) {
			$t['code']=$temp1[$t['attr']]['code'];
			$t['title']=$temp1[$t['attr']][$t['attr']];
			$text1[]=$t;
		}
		
		return $text1;
	}
	/**
	 * [makeFilter 解析过滤条件，支持中文]
	 * @param  [type] $filter [description]
	 * @return [type]         [description]
	 */
	private function makeFilter($filter){
		$f=explode(',', $filter);
		
		foreach ($f as $key => $value) {
			if ($this->IsChiness($value)){
			    $filter1.=','.$this->makeTip($value);
			}else{
				$filter1.=$value;
			}
		}
		return '~'.$filter1;
		//return '~'.substr($filter1,0,-1);
	}
	/**
	 * [makeTip 获取条件]
	 * @param  [type] $value [description]
	 * @return [type]        [description]
	 */
	private function makeTip($value){
		$temp=explode('|', $this->attr);
		
		foreach ($temp as $v1) {
			$ex1=explode(',', $v1);
			$temp2[$ex1[0]]=$ex1[1];
		}
		foreach ($temp2 as $k => $v) {
			if($value==$v){
				$filter=$k;
			}
		}

		return $filter;
	}
	/**
	 * 是否为汉字
	 */
	private  function IsChiness($str){
		$flag=false;
		$if = preg_match("/^[\x7f-\xff]+$/",$str);
		if($if){
			$flag=true; 
		}
		return $flag;
	}
	
}