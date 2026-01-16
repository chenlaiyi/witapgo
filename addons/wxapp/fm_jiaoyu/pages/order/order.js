var a = getApp();

Page({
    data: {
        url: {},
        flag: !1
    },
    onLoad: function(a) {},
    onReady: function() {
        var t = this;
        a.util.request({
            url: "entry/wxapp/getorderback",
            data: {
                m: "fm_jiaoyuwxapp"
            },
            cachetime: "0",
            success: function(a) {
                a.data && a.data.data && t.setData({
                    url: decodeURIComponent(a.data.data.backurl),
                    flag: !0
                });
            }
        }), a.util.request({
            url: "entry/wxapp/getclor",
            data: {
                m: "fm_jiaoyuwxapp"
            },
            cachetime: "0",
            success: function(a) {
                a.data && a.data.data && (t.setData({
                    bgcolor: a.data.data.bgcolor
                }), wx.setNavigationBarColor({
                    frontColor: a.data.data.headfont,
                    backgroundColor: a.data.data.headcolor
                }), wx.setNavigationBarTitle({
                    title: a.data.data.title
                }));
            }
        });
    },
    onShow: function() {},
    onHide: function() {},
    onUnload: function() {},
    onPullDownRefresh: function() {},
    onReachBottom: function() {},
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