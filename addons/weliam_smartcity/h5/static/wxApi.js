import App from "@/common/js/app.js"
const wxApi = {
	configData: null,
	/**
	 * [wxRegister 微信Api初始化]
	 */
	wxRegister(callback) {
		let _this = this,
			signUrl = encodeURIComponent(location.href.split("#")[0]),
			jsApiList = ["hideAllNonBaseMenuItem", "onMenuShareTimeline", "onMenuShareAppMessage", "openBusinessView",
				"scanQRCode",
				"getLocation", "chooseImage", "uploadImage", "openAddress", "openLocation", "translateVoice", 'stopRecord',
				'startRecord'
			];
		App._post_form("&do=getJssdk", {
			sign_url: signUrl
		}, (res) => {
			let data = res.data;
			jWeixin.config({
				debug: false, // 开启调试模式
				appId: data.appId, // 必填，公众号的唯一标识
				timestamp: data.timestamp, // 必填，生成签名的时间戳
				nonceStr: data.nonceStr, // 必填，生成签名的随机串
				signature: data.signature, // 必填，签名
				jsApiList: jsApiList // 必填，需要使用的JS接口列表
			});
			jWeixin.ready(() => {
				// jWeixin.hideMenuItems({
				//     menuList: ["menuItem:copyUrl"] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮
				// });
				callback && callback();
			});
			_this.configData = {
				...data,
				url: signUrl
			}
			jWeixin.error((optinos) => {
				// config信息验证失败会执行error函数，
				//如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，
				//也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
				console.log(optinos, 'optinos')
				// App.showError(optinos.errMsg)
			});
			console.log('取消链接')
			// wx.ready(function() {
			//    wx.hideMenuItems({
			//        menuList: ["menuItem:copyUrl"] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮
			//    });
			// });
			// jWeixin.ready(function() {
			//    jWeixin.hideMenuItems({
			//        menuList: ["menuItem:copyUrl","menuItem:editTag","menuItem:delete","menuItem:originPage","menuItem:readMode", "menuItem:openWithQQBrowser", "menuItem:openWithSafari","menuItem:share:email","menuItem:share:brand","menuItem:share:qq","menuItem:share:QZone"] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮
			//    });
			// });
		});
	},
	wxShare(options) {
		jWeixin.onMenuShareAppMessage(options);
		jWeixin.onMenuShareTimeline(options);
		// jWeixin.onMenuShareTimeline({
		// 	title: options.title, // 分享标题
		// 	desc: options.desc, // 分享描述
		// 	link: options.link, // 分享链接
		// 	imgUrl: options.imgUrl, // 分享图标
		// 	success: function() {
		// 		// 用户点击了分享后执行的回调函数
		// 	},
		// })
	},
	WxopenLocation(lat, lng, storename, address) {
		jWeixin.openLocation({
			latitude: Number(lat), // 纬度，浮点数，范围为90 ~ -90
			longitude: Number(lng), // 经度，浮点数，范围为180 ~ -180。
			name: storename, // 位置名
			address: address, // 地址详情说明
			scale: 14, // 地图缩放级别,整形值,范围从1~28。默认为最大
			infoUrl: '' // 在查看位置界面底部显示的超链接,可点击跳转
		});
	},
	wxPay(options) {
		jWeixin.chooseWXPay({
			timestamp: options.timeStamp, // 支付签名时间戳，注意微信jssdk中的所有使用timestamp字段均为小写。但最新版的支付后台生成签名使用的timeStamp字段名需大写其中的S字符
			nonceStr: options.nonceStr, // 支付签名随机串，不长于 32 位
			package: options.package, // 统一支付接口返回的prepay_id参数值，提交格式如：prepay_id=\*\*\*）
			signType: options.signType, // 签名方式，默认为'SHA1'，使用新版支付需传入'MD5'
			paySign: options.paySign, // 支付签名
			success(res) {
				// 支付成功后的回调函数
				options.success && options.success(res)
			},
			cancel(res) {
				options.cancel && options.cancel(res)
			},
			fail(res) {
				options.fail && options.fail(res)
			}
		});
	},
	scanQRCode(callback) {
		jWeixin.scanQRCode({
			needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
			scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
			complete(res) {
				callback && callback(res);
			}
		});
	},
	hideMenuItem() {
		jWeixin.hideAllNonBaseMenuItem();
	},
	getLocation(optinos) {
		jWeixin.getLocation(optinos);
	},
	getLocation1() {
		jWeixin.getLocation({
			type: 'gcj02', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
			success: function(res) {
				jWeixin.openLocation({
					latitude: res.latitude, // 纬度，浮点数，范围为90 ~ -90
					longitude: res.longitude, // 经度，浮点数，范围为180 ~ -180。
					name: '', // 位置名
					address: '', // 地址详情说明
					scale: 14, // 地图缩放级别,整形值,范围从1~28。默认为最大
					infoUrl: '' // 在查看位置界面底部显示的超链接,可点击跳转
				});
			}
		});
	},
	// 选取图片
	choseImage(callback,num=1) {
		jWeixin.chooseImage({
			count: num, // 默认9
			sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
			sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
			complete: function(res) {
				callback && callback(res);
			}
		});
	},
	//上传图片
	uoloadIg(localId, callback) {
		jWeixin.uploadImage({
			localId: localId, // 需要上传的图片的本地ID，由chooseImage接口获得
			isShowProgressTips: 1, // 默认为1，显示进度提示
			complete: function(res) {
				callback && callback(res)
			}
		});
	},
	/**
	 * 微信好物圈
	 */
	wxGoodsCircle(queryString, success, fail) {
		jWeixin.openBusinessView({
			businessType: 'friendGoodsRecommend',
			queryString: queryString,
			success(res) {
				success && success(res);
			},
			fail(res) {
				fail && fail(res);
			}
		})
	},
	wxOpenAddress(callback) {
		console.info(jWeixin)
		jWeixin.openAddress({
			success(res) {
				callback && callback(res)
			},
			fail(errMsg) {
				callback && callback(errMsg)
				console.info('我失败了')
			}
		})
	},
	// 监听录音自动停止接口
	wxStartRecord() {
		console.info('startRecord')
		jWeixin.startRecord({})
	},
	// 停止录音接口
	wxStopRecord(callback) {
		console.info('wxStopRecord')
		jWeixin.stopRecord({
			success: function(res) {
				console.info('localId', res.localId)
				callback && callback(res.localId)

			}
		})
	},
	// 识别音频并返回识别结果接口
	wxTranslateVoice(localId, callback) {
		jWeixin.translateVoice({
			localId: localId, // 需要识别的音频的本地Id，由录音相关接口获得
			isShowProgressTips: 1, // 默认为1，显示进度提示
			success: function(res) {
				callback && callback(res.translateResult) // 语音识别的结果
			}
		})
	}
}
export default wxApi
