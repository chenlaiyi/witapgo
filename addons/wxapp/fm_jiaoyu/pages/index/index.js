var a = getApp();

Page({
    data: {
        url: {},
        openid: {},
        ismember: !1,
        ismb: !1,
        showModal: !1
    },
    onLoad: function(a) {},
    getUserInfo: function(t) {
        console.log(5);
        var o = this;
        console.log(t), "getUserInfo:fail auth deny" == t.detail.errMsg ? o.openSetting() : a.util.getUserInfo(function(t) {
            t.wxInfo && (a.globalData.userInfo = t, o.setData({
                ismb: !1,
                showModal: !1,
                ismember: !0
            }));
        });
    },
    openSetting: function() {
        console.log(10), wx.showModal({
            title: "授权提示",
            content: "小程序需要您的微信授权才能使用哦~ 错过授权页面的处理方法：删除小程序->重新搜索进入->点击授权按钮"
        });
    },
    onReady: function() {
        var t = this;
        a.util.request({
            url: "entry/wxapp/getloginpage",
            data: {
                m: "fm_jiaoyuwxapp"
            },
            cachetime: "0",
            success: function(o) {
                if (o.data && o.data.data) {
                    a.globalData.openid = o.data.data.openid, t.setData({
                        btnname: o.data.data.btnname,
                        btncolor: o.data.data.btncolor,
                        btnfontcolor: o.data.data.btnfontcolor,
                        imgname: o.data.data.imgname,
                        imgfontcolor: o.data.data.imgfontcolor,
                        loginimg: o.data.data.loginimg,
                        copyright: o.data.data.copyright,
                        copyrightfontcolor: o.data.data.copyrightfontcolor,
                        bgcolor: o.data.data.loginbgcolor,
                        bgimg: o.data.data.bgimg,
                        url: o.data.data.url,
                        openid: a.globalData.openid
                    }), wx.setNavigationBarColor({
                        frontColor: o.data.data.headfont,
                        backgroundColor: o.data.data.headcolor
                    }), wx.setNavigationBarTitle({
                        title: o.data.data.title
                    });
                    var n = o.data.data.ismember;
                    console.log(n), 0 == n && t.setData({});
                }
            }
        });
    },
    onPullDownRefresh: function() {
        var t = this;
        a.util.request({
            url: "entry/wxapp/getloginpage",
            data: {
                m: "fm_jiaoyuwxapp"
            },
            cachetime: "0",
            success: function(a) {
                a.data && a.data.data && (t.setData({
                    btnname: a.data.data.btnname,
                    btncolor: a.data.data.btncolor,
                    btnfontcolor: a.data.data.btnfontcolor,
                    imgname: a.data.data.imgname,
                    imgfontcolor: a.data.data.imgfontcolor,
                    loginimg: a.data.data.loginimg,
                    copyright: a.data.data.copyright,
                    copyrightfontcolor: a.data.data.copyrightfontcolor,
                    bgcolor: a.data.data.loginbgcolor,
                    bgimg: a.data.data.bgimg,
                    url: a.data.data.url
                }), wx.setNavigationBarColor({
                    frontColor: a.data.data.headfont,
                    backgroundColor: a.data.data.headcolor
                }), wx.setNavigationBarTitle({
                    title: a.data.data.title
                })), wx.stopPullDownRefresh();
            }
        });
    },
    formSubmit: function(a) {
        var t = this, o = a.detail.formId, n = a.detail.target.dataset.name;
        t.submintFromId(o, n);
    },
    submintFromId: function(t, o) {
        a.util.request({
            url: "entry/wxapp/addformId",
            data: {
                m: "fm_jiaoyuwxapp",
                formId: t,
                content: o
            },
            cachetime: "0",
            success: function(a) {}
        });
    },
    onShow: function() {},
    onHide: function() {},
    onUnload: function() {},
    onShareAppMessage: function(a) {
        return a.from, {
            title: "我发现一款不错的小程序",
            path: "/fm_jiaoyu/pages/index/index",
            success: function(a) {
                wx.showToast({
                    title: "分享成功"
                });
            },
            fail: function(a) {}
        };
    }
});