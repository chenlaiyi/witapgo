var a = getApp();

Page({
    data: {
        orderId: {},
        cose: {},
        dos: {},
        userid: {},
        op: {},
        schoolid: {},
        nowweid: {},
        ismember: !1,
        ismb: !1,
        showModal: !1
    },
    onLoad: function(a) {
        var t = this, o = a.orderid, e = a.cose, d = a.do, i = a.op, s = a.userid, n = a.nowweid, r = a.schoolid;
        t.setData({
            orderId: o,
            cose: e,
            dos: d,
            userid: s,
            op: i,
            nowweid: n,
            schoolid: r
        });
    },
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
        a.util.request({
            url: "entry/wxapp/getclor",
            data: {
                m: "fm_jiaoyuwxapp"
            },
            cachetime: "0",
            success: function(a) {
                if (a.data && a.data.data) {
                    that.setData({
                        bgcolor: a.data.data.bgcolor
                    }), wx.setNavigationBarColor({
                        frontColor: a.data.data.headfont,
                        backgroundColor: a.data.data.headcolor
                    }), wx.setNavigationBarTitle({
                        title: a.data.data.title
                    });
                    var t = a.data.data.ismember;
                    console.log(t), 0 == t && that.setData({
                        ismb: !0,
                        showModal: !0
                    });
                }
            }
        });
    },
    requestPayment: function() {
        var t = this;
        t.setData({
            loading: !0
        }), a.util.request({
            url: "entry/wxapp/pay",
            data: {
                m: "fm_jiaoyuwxapp",
                sum: t.data.cose,
                orderid: t.data.orderId,
                dos: t.data.dos,
                userid: t.data.userid,
                op: t.data.op,
                nowweid: t.data.nowweid,
                schoolid: t.data.schoolid
            },
            cachetime: "0",
            success: function(a) {
                a.data && a.data.data && wx.requestPayment({
                    timeStamp: a.data.data.timeStamp,
                    nonceStr: a.data.data.nonceStr,
                    package: a.data.data.package,
                    signType: "MD5",
                    paySign: a.data.data.paySign,
                    success: function(a) {
                        wx.redirectTo({
                            url: "../order/order"
                        });
                    },
                    fail: function(a) {
                        wx.redirectTo({
                            url: "../order/order"
                        });
                    }
                });
            }
        });
    },
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