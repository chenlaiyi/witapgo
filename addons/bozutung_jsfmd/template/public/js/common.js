/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

/**
 * 删除数据
 * url = 请求url
 * ids = {"ids": ['1', '2']}
 * return bool
*/
function funDelete(url, ids, cb) {
	layer.confirm('确定要删除么', {
		offset: '20%',
		btn: ['再想想', '删除'],
		scrollbar: false,
		closeBtn: 0,
	}, function (i) {
		layer.close(i);
	}, function (i) {
		$.ajax({
			type: "POST",
			url: url,
			dataType: 'json',
			data: JSON.stringify({'ids': ids}),
			success: function (rs) {
				if (rs && rs.code.toString() === '0') {
					cb({code: '0', msg: 'ok'});
				} else {
					let data_return = {code: '1', msg: rs.msg};
					cb({code: '1', msg: rs.msg});
				}
			},
			error: function () {
				cb({code: '1', msg: '提交过程发生错误，请与管理员联系'});
			}
		});
	});
}

/** 执行后台方法
	* burl     = 请求url
	* bdata    = {"ids": ['1', '2']}
	* cb       = 处理方法
	* bconfirm = confirmTitle
	* bbtn0    = 再想想
	* bbtn1    = 执行按钮
*/
function funExec(burl, bdata, cb, bconfirm, bbtn0, bbtn1)
{
	layer.confirm(bconfirm, {
		offset: '20%',
		btn: [bbtn0, bbtn1],
		scrollbar: false,
		closeBtn: 0,
	}, function (i) {
		layer.close(i);
	}, function (i) {

		layer.msg("拼命加载中,请耐心等待...", {
			icon: 16,
			time: 0,
			offset: '20%',
			shade: 0.1,
		});

		$.ajax({
			type: "POST",
			url: burl,
			dataType: 'json',
			data: JSON.stringify(bdata),
			success: function (rs) {
				var type_of = typeof rs;
				if (type_of == 'string') {
					cb({code: '1', msg: "未知错误:" + rs});
				} else {
					if (rs && rs.code.toString() === '0') {
						cb({code: '0', msg: 'ok'});
					} else {
						cb({code: '1', msg: rs.msg});
					}
				}
			},
			error: function () {
				cb({code: '1', msg: "提交过程发生错误，请与管理员联系"});
			},
			complete: function () {
				layer.close(i);
			}
		});
	});
}
