App({
    onLaunch: function() {
        wx.getLocation({
            success: function(n) {
                wx.setStorageSync("wxb_lat", n.latitude), wx.setStorageSync("wxb_lng", n.longitude);
            }
        });
    },
    onShow: function() {},
    onHide: function() {},
    onError: function(n) {
        console.log(n);
    },
    util: require("we7/resource/js/util.js"),
    globalData: {
        userInfo: null,
        openid: null
    },
    siteInfo: require("siteinfo.js")
});