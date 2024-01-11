<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');
$url = 'http://api.'.config('site', 'url').'/';
if (!empty($_POST['path']))
{
	$_url    = $url.$_POST['path'];
	$get     = parse_params($_POST['GET'], false);
	$post    = parse_params($_POST['POST'], true);
	$user_id = intval($_POST['user_id']);
	$option  = array();
	if ($user_id)
	{
		$token  = time();
		$token .= '|'.$user_id;
		$token .= '|'.intval($db->getOne("SELECT `id` FROM `school_teacher` WHERE `user_id`={$user_id}"));
		// $token .= '|'.intval($db->getOne("SELECT `id` FROM `shop_merchant` WHERE `user_id`={$user_id}"));
		$token .= '|'.'GET:what';
		$option = array(
			'CURLOPT_HTTPHEADER' => array(
				'Content-Type: application/x-www-form-urlencoded',
				'token: '._class('crypt')->encode($token),
				)
			);
	}
	
	if (!empty($get))
	{
		$_url .= '?'.$get;
	}

	if ($_POST['path'] == 'user_login')
	{
		if (!empty($post['username'])) $post['username'] = _class('crypt')->encode($post['username']);
	  if (!empty($post['password'])) $post['password'] = _class('crypt')->encode($post['password']);
	  if (!empty($post['email'])) $post['email']       = _class('crypt')->encode($post['email']);
	}

	$debug = !empty($_POST['is_debug']) ? true : false;
	$json  = curl($_url, $post, $option, $debug);
	$out   = @json_decode($json, 1);
	if (!empty($out))
	{
		$out = htmlentities_r($out);
		if (!empty($out['debug']) && is_url($out['debug']))
		{
			$out['debug'] = '<a href="'.$out['debug'].'" target="_blank">'.$out['debug'].'</a>';
		}
	}else{
		$out = htmlentities($json);
	}

	if (@$_POST['open_new_tab'])
	{
		output_json($out);
	}
	pr($out);
	die();
}
$sys->stop(false);
$sys->set_layout('blank.php');
$file  = _ROOT.'modules/api/_switch.php';
_func('file');
$text  = file_read($file);
// pr($text, $return = false);
$cases = array();
$tags  = array();
if (preg_match_all('~case\s+\'(.*?)\'(?:[^a-z]+//(?:\s+)?([^\n]+)?)?~', $text, $match))
{
	foreach ($match[1] as $i => $case)
	{
		if (preg_match('~^@~s', $case))
		{
			$tag         = substr($case, 1);
			$tags[]      = $tag;
			$cases[$tag] = @$match[2][$i];
		}else{
			$cases[$case] = @$match[2][$i];
		}
	}
}
ksort($cases);
foreach ($cases as $case => $info)
{
	$title = in_array($case, $tags) ? '@'.$case : $case;
	$cases[$case] = '<li><a href="#'.$title.'" title="'.htmlentities($info).'">'.$title.'</a></li>';
}
meta_title("API Tester",2);
link_js(_URL.'includes/lib/pea/includes/FormTags.js');
$token = array(
	'table'  => 'bbc_user',
	'field'  => 'username',
	'id'     => 'id',
	'sql'    => '',
	'expire' => strtotime('+2 DAYS'),
	);
$user_id = $db->getOne("SELECT `id` FROM `bbc_user` ORDER BY `id` ASC LIMIT 1");
?>

<div class="container-fluid">
	<form action="" method="POST" role="form" id="formku" enctype="multipart/form-data">
		<div class="form-group">
			<label>URL / PATH / Member</label>
			<div class="form-inline">
				<div class="input-group"><?php echo $url; ?></div>
				<div class="input-group">
		      <input type="text" class="form-control" name="path" id="path" value="main" />
		      <div class="input-group-btn" title="API <?php echo config('site', 'url'); ?>">
		        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo icon('fa-angle-double-down', 'API Tester'); ?></button>
		        <ul class="dropdown-menu dropdown-menu-right" style="overflow-y: auto; max-width: 330px;">
		        	<?php echo implode('', $cases); ?>
		        </ul>
		      </div>
		    </div>
				<input class="form-control" name="user_id" value="<?php echo $user_id; ?>" type="text" rel="ac" size="8" placeholder="Pilih Member" data-token="<?php echo encode(json_encode($token)); ?>" />
				<div class="checkbox">
					<label>
						<input type="checkbox" class="open_new_tab" name="open_new_tab" value="1">
						Result in New Tab
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="is_debug" value="1">
						Show Debugger
					</label>
				</div>
			</div>
			<div class="help-block" id="path_info"></div>
		</div>

		<div class="form-group">
			<label><a data-toggle="modal" href='#modal-id'>Parameter GET <?php echo icon('fa-info-circle'); ?></a></label>
			<textarea name="GET" class="form-control" placeholder="Masukkan parameter GET"></textarea>
		</div>
		<div class="form-group">
			<label><a data-toggle="modal" href='#modal-id'>Parameter POST <?php echo icon('fa-info-circle'); ?></a></label>
			<textarea name="POST" class="form-control" placeholder="Masukkan parameter POST"></textarea>
			<div class="help-block"></div>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>


		<div class="form-group">
			<div class="panel-group" id="accordion_image">
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h4 class="panel-title" data-toggle="collapse" data-parent="#accordion_image" href="#collapsible_image" style="cursor: pointer;">
				    	Klik Di Sini Untuk Mengupload File
				    </h4>
				  </div>
				  <div id="collapsible_image" class="panel-collapse collapse on">
				    <div class="panel-body">
							<div class="form-group">
								<label><a data-toggle="modal" href='#'>Parameter FILE <?php echo icon('fa-file'); ?></a></label>
								<input type="text" class="form-control input_file_name" placeholder="Index POST" />
								<input type="file" name="FILE" class="form-control" />
								<small>This Parameter Will Auto Submit On Change Event</small>
								<div class="help-block"></div>
							</div>
						</div>
				  </div>
				</div>
			</div>
		</div>


	</form>
	<div id="output"></div>
</div>
<div class="modal fade" id="modal-id" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h3>Sample 1</h3>
				<pre>var1=value1&var2=value 2&var3=value+3</pre>
				<h3>Sample 2</h3>
				<pre>var1=value1
var2=value 2
var3=value+3</pre>
				"Value" secara otomatis akan di-urlencode jika kondisi belum diencode<br />
				Jika menggunakan "Sample 2" maka input yang diawali dengan # tidak akan di proses
			</div>
		</div>
	</div>
</div>
<?php
function curl($url, $param=array(), $option=array(), $is_debug = false)
{
	if(!preg_match('~^(?:ht|f)tps?://~', $url) && file_exists($url))
	{
		return file_get_contents($url);
	}else{
		if(!preg_match('~^(?:ht|f)tps?://~', $url)) {
			$url = 'http://'.$url;
		}
	}
	$temp = '/tmp/curl';
	if(is_numeric($param))
	{
		$text			= unserialize(curl($temp.'_'.md5($url)));
		if(!empty($text[0]) && $text[0] > time())
		{
			return @$text[1];
		}
		$presists	= intval($param);
		$param		= array();
	}else $presists	= 0;
  $default = array(
  	'CURLOPT_REFERER'    => !empty($_SESSION['CURLOPT_REFERER']) ? $_SESSION['CURLOPT_REFERER'] : $url,
  	'CURLOPT_POST'       => empty($param) ? 0 : 1,
  	'CURLOPT_POSTFIELDS' => $param,
  	'CURLOPT_USERAGENT'  => @$_SERVER['HTTP_USER_AGENT'],
  	'CURLOPT_HEADER'     => 1,
  	'CURLOPT_HTTPHEADER' => array(
  		'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
  		'Accept-Language: en-US,en;q=0.5',
  		'Accept-Encoding: gzip, deflate',
  		'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7',
  		'Keep-Alive: 300',
  		'Connection: keep-alive',
  		'Content-Type: application/x-www-form-urlencoded'),
  	'CURLOPT_FOLLOWLOCATION' => 0,
  	'CURLOPT_RETURNTRANSFER' => 1,
  	'CURLOPT_COOKIEFILE'     => $temp,
  	'CURLOPT_COOKIEJAR'      => $temp
  	);
  foreach ($option as $key => $value)
  {
  	if (empty($value) && $value!='0')
  	{
  		unset($option[$key]);
  	}
  }
  $data = array_merge($default, $option);
  $data['CURLOPT_POST'] = empty($data['CURLOPT_POSTFIELDS']) ? 0 : 1;

  if($data['CURLOPT_POST'])
  {
  	$data['CURLOPT_POSTFIELDS'] = http_build_query($data['CURLOPT_POSTFIELDS']);
  }else unset($data['CURLOPT_POSTFIELDS']);

  if ($data['CURLOPT_HTTPHEADER'])
  {
  	$data['CURLINFO_HEADER_OUT'] = 1;
  }

  // $data['CURLOPT_HTTPHEADER'] = array_map('urlencode', $data['CURLOPT_HTTPHEADER']);
  $data['CURLOPT_HTTPHEADER'] = $data['CURLOPT_HTTPHEADER'];

  if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {
  }else unset($data['CURLOPT_FOLLOWLOCATION']);

  if(strtolower(substr($url, 0, 5)) == 'https')
  {
  	$data['CURLOPT_FOLLOWLOCATION'] = 0;
  	$data['CURLOPT_SSL_VERIFYHOST'] = 0;
  }

  $init = curl_init( $url );
  foreach ($data as $key => $value)
  {
  	curl_setopt($init, constant($key), $value);
  }
	$out  = curl_exec($init);
	$info = curl_getinfo($init);
	// pr($info, __FILE__.':'.__LINE__);
	if (!empty($info['header_size']))
	{
		$header = substr($out, 0, $info['header_size']);
		$output = substr($out, $info['header_size']);
	}else{
		$header = '';
		$output = $out;
	}
  if (!empty($info['redirect_url'])) {
  	$_SESSION['CURLOPT_REFERER'] = $info['redirect_url'];
  }else{
	  $_SESSION['CURLOPT_REFERER'] = $url;
  }
  if ( $is_debug )
  {
  	$debug = array('url' => $url);
  	if(!empty($data['CURLOPT_POSTFIELDS']))
  	{
  		$debug['params'] = htmlentities($data['CURLOPT_POSTFIELDS']);
  	}
    $a = curl_errno( $init );
    if(!empty($a))
    {
    	$debug['ErrNum'] = $a;
    }
    $a = curl_error( $init );
    if(!empty($a))
    {
    	$debug['ErrMsg'] = $a;
    }
    if(empty($debug))
    {
    	echo $output;
    }else{
    	$r = explode(',', 'url,content_type,http_code,header_size,request_size,filetime,ssl_verify_result,redirect_count,pretransfer_time,speed_download,speed_upload,download_content_length,upload_content_length,starttransfer_time,redirect_time,redirect_url,certinfo,local_ip,local_port,http_version,protocol,ssl_verifyresult,scheme,appconnect_time_us,connect_time_us,namelookup_time_us,pretransfer_time_us,redirect_time_us,starttransfer_time_us,total_time_us');

    	foreach ($r as $var)
    	{
    		// pr($var, __FILE__.':'.__LINE__);
    		unset($info[$var]);
    	}
	    $debug['info']   = $info;
	    $debug['header'] = $header;
	    $debug['output'] = $output;
	    if (!empty($_POST['is_plain'])) {
		    print_r($debug);
	    }else{
	    	echo '<pre>'.print_r($debug, 1).'</pre>';
	    }
    }
  }
  curl_close($init);
  if($presists > 0 && !empty($output))
  {
		if ( $fp = @fopen($temp.'_'.md5($url), 'w+'))
		{
			flock($fp, LOCK_EX);
			fwrite($fp, serialize(array(strtotime('+'.$presists.' SECOND'), $output)));
			flock($fp, LOCK_UN);
			fclose($fp);
		}
  }
  return $output;
}
function parse_varval($value)
{
	$output = '';
	if (preg_match('~=~', $value))
	{
		$j = strpos($value, '=');
		if ($j)
		{
			$val = substr($value, ($j+1));
			if (!empty($val))
			{
				if (!preg_match('~[+%]~', $val))
				{
					$val = urlencode($val);
				}
				$output = substr($value, 0, $j).'='.$val;
			}
		}
	}
	return $output;
}
function parse_params($value, $is_output_array = false)
{
	$output = array();
	if (!empty($value))
	{
		$r_value = array();
		if (preg_match('~\r\n~', $value))
		{
			$value   = preg_replace(array('~\r~s', '~\n+~s'), array("\n", "\n"), $value);
			$r_value = explode("\n", $value);
		}else{
			$r_value = explode("&", $value);
		}
		if (!empty($r_value))
		{
			foreach ($r_value as $value)
			{
				$value = trim($value);
				if (!empty($value) && substr($value,0,1)!='#')
				{
					$value = parse_varval($value);
					if (!empty($value))
					{
						$output[] = $value;
					}
				}
			}
		}
	}
	if ($is_output_array)
	{
		$out = array();
		foreach ($output as $values)
		{
			@list($key, $value) = explode('=', $values);
			if (!empty($key))
			{
				$value = urldecode($value);
				if (preg_match('~^(.*?)\[(.*?)\]$~s', $key, $m))
				{
					if (!isset($out[$m[1]]))
					{
						$out[$m[1]] = array();
					}
					if (!empty($m[2]))
					{
						$out[$m[1]][$m[2]] = $value;
					}else{
						$out[$m[1]][] = $value;
					}
				}else{
					$out[$key] = $value;
				}
			}
		}
	}else{
		$out = implode('&', $output);
	}
	return $out;
}
?>
<style type="text/css">
	#user_id {
		display: inline-block !important;
	}
</style>
<script type="text/javascript">
_Bbc(function($){
	$('input[type="file"]').on('change', function(event){
		event.preventDefault();
		$('#formku').attr('action', '<?php echo $url; ?>'+$('input[name="path"]').val()); // Form action nya dilempar ke halaman api langsung dengan memproses POST nya
		if ($('.open_new_tab:checked').length) 
		{
			$('#formku').attr('target', '_BLANK');
		}else{
			$("#output").html('<iframe name="my_iframe" style="width: 100%; height: 100vh; border: 0; "></iframe>');
			$('#formku').attr('target', 'my_iframe');
		}
		if ($('.input_file_name').val()) 
		{
			$(this).attr('name', $('.input_file_name').val());
		}else{
			$(this).attr('name', 'file');
		}
		$('#formku').submit();
	});

	$('button[type="submit"]').on("click", function(e){
		e.preventDefault();
		if ($('.open_new_tab:checked').length) 
		{
			$('#formku').attr('action', '');
			$('#formku').attr('target', '_BLANK');
			$('#formku').submit();
		}else{
			$.ajax({
				url: document.location.href,
				method:"POST",
				data:$('#formku').serialize(),
				global:false,
				beforeSend:function(xhr){
					$("#output").html('<center><i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i></center>');
				},
				success:function(data, status, xhr){
					$("#output").html(data);
				}
			});
		}
	});
	$(".dropdown-menu a").on("click", function(e){
		e.preventDefault();
		$("#path").val($(this).attr("href").substr(1));
		info($(this).attr("title"));
		$(".dropdown-menu li").removeClass("active");
		$(this).closest("li").addClass("active");
	});

	$('[name="GET"], [name="POST"]').on("focus", function(e){
		if (window.warn) {
			clearInterval(window.warn);
			$(this).closest(".form-group").removeClass("has-error");
		}
	});
});
window.colsp = [];
function info(a) {
	var b = "";
	var c = "";
	var d = "";
	var e = "";
	$('[name="GET"], [name="POST"]').removeAttr("rows");
	$(".has-error").removeClass("has-error");
	clearInterval(window.warn);

	if (a) {
	  var r = new RegExp(/^(.*?)(?:\s{0,}GET:(.*?\}))?(?:\s{0,}POST:(.*?\}))?(?:\s{0,}FILE:(.*?\}))?$/i);
	  var m = r.exec(a);
	  if (m==null) {
			b = a;
	  }else{
	  	b = m[1];
	  	if (m[2]) {
	  		r = JSON.parse(m[2]);
	  		for(a in r) {
	  			c += a+"="+r[a].replace(/[^a-z0-9\_\-|]+/ig, '_')+"\n";
	  		}
	  	}
	  	if (m[3]) {
	  		r = JSON.parse(m[3]);
	  		for(a in r) {
	  			d += a+"="+r[a].replace(/[^a-z0-9\_\-|]+/ig, '_')+"\n";
	  		}
	  	}
	  	if (m[4]) {
	  		e = m[4];
	  		e = e.replace('{"','');
	  		e = e.replace('"}','');
	  	}
	  }
	  if (c) {
	  	r = c.split("\n");
	  	$('[name="GET"]').attr("rows", r.length);
	  	warning($('[name="GET"]').closest(".form-group"));
	  }
	  if (d) {
	  	r = d.split("\n");
	  	$('[name="POST"]').attr("rows", r.length);
	  	warning($('[name="POST"]').closest(".form-group"));
	  }
	}
	$("#path_info").html(b);
	$('[name="GET"]').val(c);
	$('[name="POST"]').val(d);
	$('.input_file_name').val(e);
};
function warning(a) {
	window.warn = setInterval(function(){
		$(a).toggleClass("has-error");
	}, 200);
	setTimeout(function(){
		clearInterval(window.warn);
		$(a).removeClass("has-error");
	}, 5000);
}
</script>
