<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  if($do == 'post') { ?>
<ul class="nav nav-tabs">
	<li><a href="<?php  echo url('site/multi/display');?>">微站管理</a></li>
	<?php  if($do == 'post' && !$id) { ?><li class="active"><a href="<?php  echo url('multi/post');?>">添加微站</a></li><?php  } ?>
	<?php  if($do == 'post' && $id) { ?><li class="active"><a href="<?php  echo url('multi/post', array('id' => $id));?>">编辑微站</a></li><?php  } ?>
</ul>

<style>
	.template .item{position:relative;display:block;float:left;border:1px #ddd solid;border-radius:5px;background-color:#fff;padding:5px;width:190px;margin:0 20px 20px 0; overflow:hidden;}
	.template .title{margin:5px auto;line-height:2em;}
	.template .title a{text-decoration:none;}
	.template .item img{width:178px;height:270px; cursor:pointer;}
	.template .active.item-style img, .template .item-style:hover img{width:178px;height:270px;border:3px #009cd6 solid;padding:1px; }
	.template .title .fa{display:none}
	.template .active .fa.fa-check{display:inline-block;position:absolute;bottom:33px;right:6px;color:#FFF;background:#009CD6;padding:5px;font-size:14px;border-radius:0 0 6px 0;}
	.template .fa.fa-times{cursor:pointer;display:inline-block;position:absolute;top:10px;right:6px;color:#D9534F;background:#ffffff;padding:5px;font-size:14px;text-decoration:none;}
	.template .fa.fa-times:hover{color:red;}
	.template .item-bg{width:100%; height:342px; background:#000; position:absolute; z-index:1; opacity:0.5; margin:-5px 0 0 -5px;}
	.template .item-build-div1{position:absolute; z-index:2; margin:-5px 10px 0 5px; width:168px;}
	.template .item-build-div2{text-align:center; line-height:30px; padding-top:150px;}
	/*@media screen and (min-width:992px){#ListStyle{width:890px; margin:100px auto;}}*/
</style>

<form class="form-horizontal form" action="" method="post">
	<div class="clearfix">
		<div class="panel panel-default">
			<div class="panel-heading">
				站点信息
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">微站名称</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="title" class="form-control" value="<?php  echo $multi['title'];?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否启用</label>
					<div class="col-sm-9 col-xs-12">
						<label class="radio-inline"><input type="radio" name="status" value="1" <?php  if(!$multi['id'] || $multi['status'] == 1) { ?>checked<?php  } ?>>是</label>
						<label class="radio-inline"><input type="radio" name="status" value="0" <?php  if($multi['status'] == 0 && $multi['id']) { ?>checked<?php  } ?>>否</label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">选择微站风格</label>
					<div class="col-sm-8 col-xs-12">
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ListStyle">选择风格</button>
						<input type="hidden" name="styleid" id="styleid" value="<?php  echo $multi['styleid'];?>" />
					</div>
				</div>
				<div class="form-group" id="preview-style" <?php  if(empty($multi['style']['tname'])) { ?>style="display:none;"<?php  } ?>>
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">当前微站风格</label>
					<div class="col-sm-8 col-xs-12">
						<div class="template">
							<div class="item item-style">
								<div class="title">
									<div style="overflow:hidden; height:28px;" id="current-title"><?php  echo $multi['style']['name'];?></div>
									<a href="javascript:;">
										<img src="<?php  echo $_W['siteroot'];?>app/themes/<?php  echo $multi['style']['tname'];?>/preview.jpg" id="current-preview" class="img-rounded">
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- 风格列表 -->
				<div class="modal fade bs-example-modal-lg" id="ListStyle" aria-hidden="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title">微站模板风格列表</h4>
							</div>
							<div class="modal-body template clearfix">
								<?php  if(is_array($styles)) { foreach($styles as $style) { ?>
								<div class="item item-style <?php  if($multi['styleid'] == $style['id']) { ?> active <?php  } ?>">
									<div class="title">
										<div class="title-<?php  echo $style['id'];?>" style="overflow:hidden; height:28px;"><?php  echo $style['name'];?></div>
										<a href="javascript:;" class="change-style" data-styleid="<?php  echo $style['id'];?>">
											<img src="<?php  echo $_W['siteroot'];?>app/themes/<?php  echo $style['tname'];?>/preview.jpg" class="img-rounded preview-<?php  echo $style['id'];?>">
										</a>
										<span class="fa fa-check"></span>
									</div>
									<div class="btn-group  btn-group-justified">
										<a href="javascript:;" class="btn btn-default btn-xs change-style" data-styleid="<?php  echo $style['id'];?>">选择风格</a>
									</div>
								</div>
								<?php  } } ?>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">触发关键字</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="keyword" class="form-control" value="<?php  echo $multi['site_info']['keyword'];?>" />
						<div class="help-block">用户触发关键字，系统回复此页面的图文链接</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">封面</label>
					<div class="col-sm-9 col-xs-12">
						<?php  echo tpl_form_field_image('thumb', $multi['site_info']['thumb'])?>
						<div class="help-block">用于用户触发关键字后，系统回复时的封面图片</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">页面描述</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="description" class="form-control" value="<?php  echo $multi['site_info']['description'];?>" />
						<div class="help-block">用户通过微信分享给朋友时,会自动显示页面描述</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">绑定域名</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="bindhost" class="form-control" value="<?php  echo $multi['bindhost'];?>" />
						<span class="help-block">绑定时请先将域名解析指向到本服务器，请只填写host部分，不允许为当前系统域名。例如：www.baidu.com</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">底部自定义</label>
					<div class="col-sm-9 col-xs-12">
						<textarea style="height:150px;" class="form-control" cols="70" name="footer" autocomplete="off"><?php  echo $multi['site_info']['footer'];?></textarea>
						<span class="help-block">自定义底部信息，支持HTML</span>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1" />
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	$('.change-style').click(function() {
		var styleId = parseInt($(this).data('styleid'));
		var title = $('.title-' + styleId).text();
		var preview = $('.preview-' + styleId).attr('src');
		$('.item-style').removeClass('active');
		$('#styleid').val(styleId);
		$('#current-title').text(title);
		$('#current-preview').attr('src', preview);
		$(this).parent().parent().addClass('active');
		$('#preview-style').show();
		$('#ListStyle').modal('hide');
	});
</script>
<?php  } else if($do == 'display') { ?>
<ul class="nav nav-tabs">
	<li class="active"><a href="<?php  echo url('site/multi/display');?>">微站管理</a></li>
	<li><a href="<?php  echo url('site/multi/post')?>">添加微站</a></li>
</ul>
<div class="clearfix template">
	<div class="panel panel-default">
		<div class="panel-heading">
			可用的微站
		</div>
		<div class="table-responsive panel-body">
			<table class="table table-hover">
				<thead class="navbar-inner">
					<tr>
						<th>微站名称</th>
						<th style="width:100px;">关键字</th>
						<th style="width:200px;">风格</th>
						<th style="width:200px;">模板</th>
						<th class="manage-menu" style="width:420px">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($multis)) { foreach($multis as $item) { ?>
					<tr>
						<td style="vertical-align:middle;"><?php  echo $item['title'];?><?php  if($default_site == $item['id']) { ?><span class="label label-success">默认微站</span><?php  } ?></td>
						<td><?php  echo $item['site_info']['keyword'];?></td>
						<td style="vertical-align:middle;">
							<?php  if($item['styleid']) { ?><?php  echo $item['style']['name'];?><?php  } else { ?><span class="label label-danger">未设置</span><?php  } ?>
						</td>
						<td>app/themes/<?php  echo $item['template']['name'];?></td>
						<td class="manage-menu" style="position:relative;">
							<a href="<?php  echo url('site/multi/post', array('multiid' => $item['id']))?>">编辑</a>
							<a href="<?php  echo url('site/slide/display', array('multiid' => $item['id']))?>">幻灯片</a>
							<a href="<?php  echo url('site/nav/home', array('multiid' => $item['id'], 'f' => 'multi'))?>">导航菜单</a>
							<a href="<?php  echo url('site/editor/quickmenu', array('multiid' => $item['id'], 'type' => '2'))?>">快捷菜单</a>
							<span><a class="js-clip" href="javascript:;" data-url="<?php  echo murl('home', array('t' => $item['id']), true, true)?>">复制链接</a></span>
							<a href="<?php  echo url('site/multi/copy', array('multiid' => $item['id']))?>">复制站点</a>
							<a href="javascript:;" onclick="preview('<?php  echo $item['styleid'];?>', '<?php  echo $item['id'];?>');return false;">预览</a>
							<?php  if($default_site != $item['id']) { ?><a href="<?php  echo url('site/multi/del', array('id' => $item['id']))?>" onclick="if(!confirm('删除后将不可恢复,确定删除吗?')) return false;">删除</a><?php  } ?>
						</td>
					</tr>
					<?php  } } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<style>
	.template .dropdown{display:inline-block; cursor:pointer;}
	.template i{display:inline-block; width:15px; height:15px; font-size:15px; }
	.template .js-dropdown-menu span{display:inline-block; height:34px; line-height:34px; width:60px; text-align:center;}
	.template .dropdown-menu{margin:0;}
	.template .dropdown-menu i{width:20px; margin-right:10px; text-align:center;}
</style>
<script type="text/javascript">
	$(function(){
		$('.js-dropdown-menu').unbind('click');
		$('.js-dropdown-menu span').hover(function(){
			$(this).parent().addClass('open').find('.dropdown-menu').show();
			$(this).parent().find('.dropdown-menu').hover(function(){$(this).show();$(this).parent().addClass('open')},function(){$(this).hide();$(this).parent().removeClass('open');});
		},function(){
			$(this).parent().removeClass('open').find('.dropdown-menu').hide();
		});
	});
	function preview(styleid, $multiid) {
		var content = '<iframe width="320" scrolling="yes" height="480" frameborder="0" src="about:blank"></iframe>';
		var footer =
				'<a href="<?php  echo url('site/style/designer');?>styleid=' + styleid + '" class="btn btn-primary">设计风格</a>' +
				'<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>';
		var dialog = util.dialog('预览模板', content, footer);
		dialog.find('iframe').on('load', function(){
			$('a', this.contentWindow.document.body).each(function(){
				var href = $(this).attr('href');
				if(href && href[0] != '#') {
					var arr = href.split(/#/g);
					var url = arr[0];
					if (url.substr(0, 3) == 'www') {
						url = 'http://' + url;
					}
					if(arr[1]) {
						url += ('#' + arr[1]);
					}
					if (url.substr(0, 10) == 'javascript') {
						url = url.substr(0, url.lastIndexOf('&'));
					}
					$(this).attr('href', url);
				}
			});
		});
		var url = '../app/<?php  echo murl('home')?>&s=' + styleid + '&t=' + $multiid;
		dialog.find('iframe').attr('src', url);
		dialog.find('.modal-dialog').css({'width': '322px'});
		dialog.find('.modal-body').css({'padding': '0', 'height': '480px'});
		dialog.modal('show');
	}
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>