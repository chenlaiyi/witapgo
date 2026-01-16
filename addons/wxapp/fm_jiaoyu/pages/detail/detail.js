var t = getApp();

Page({
    data: {
        url: {},
        flag: !1
    },
    onLoad: function(t) {
        this.setData({
            url: decodeURIComponent(t.url),
            flag: !0
        });
    },
    onReady: function() {
        t.util.request({
            url: "entry/wxapp/getclor",
            data: {
                m: "fm_jiaoyuwxapp"
            },
            cachetime: "0",
            success: function(t) {
                t.data && t.data.data && (wx.setNavigationBarColor({
                    frontColor: t.data.data.headfont,
                    backgroundColor: t.data.data.headcolor
                }), wx.setNavigationBarTitle({
                    title: t.data.data.title
                }));
            }
        });
    },
    onShow: function() {},
    onHide: function() {},
    onUnload: function() {},
    onPullDownRefresh: function() {},
    onReachBottom: function() {},
    onShareAppMessage: function(t) {
        return t.from, {
            title: "我发现一款不错的小程序",
            path: "/fm_jiaoyu/pages/index/index",
            success: function(t) {
                wx.showToast({
                    title: "分享成功"
                });
            },
            fail: function(t) {}
        };
    }
});