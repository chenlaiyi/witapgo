function t(t, e) {
    var a = new Date();
    a.setDate(a.getDate() + t);
    var i = a.getFullYear(), o = a.getMonth() + 1, n = a.getDate();
    return o < 10 && (o = "0" + o), n < 10 && (n = "0" + n), 1 == e ? o + "月" + n + "日" : i + "-" + o + "-" + n;
}

function e(t, e, i) {
    module.exports.globalData.apiurl ? a(t, e, i) : wx.getExtConfig({
        success: function(o) {
            module.exports.globalData = o.extConfig, a(t, e, i);
        }
    });
}

function a(t, e, a) {
    var i = module.exports.globalData.apiurl + t + "?appid=" + module.exports.globalData.appid + "&appkey=" + module.exports.globalData.appkey;
    wx.request({
        url: i,
        data: e,
        method: "POST",
        dataType: "json",
        success: function(t) {
            switch (console.log(t), t.data.code) {
              case 100:
              case 101:
                break;

              case 200:
                a(t.data.data);
                break;

              default:
                console.log(t.data.msg), wx.showToast({
                    image: "/img/kulian.png",
                    title: t.data.msg
                });
            }
        },
        fail: function(t) {
            wx.hideLoading(), wx.showToast({
                title: "请求接口超时11"
            });
        }
    });
}

module.exports = {
    getOpenId: function() {
        var t = wx.getStorageSync("userinfo"), e = t ? JSON.parse(t) : {};
        return e.open_id ? e.open_id : 0;
    },
    dingWei: function(t, e) {
        var a = wx.getStorageSync("city"), i = a ? JSON.parse(a) : {};
        if (i.city_id) {
            var o = 0;
            for (var n in t) if (t[n].city_id == i.city_id) {
                i = {
                    city_id: t[n].city_id,
                    city_name: t[n].city_name
                }, o = 1;
                break;
            }
            0 == o && (i = {
                city_id: t[0].city_id,
                city_name: t[0].city_name
            }), module.exports.setCity(i.city_id, i.city_name), void 0 != e && e(i);
        } else {
            for (var n in t) if (1 == t[n].default) {
                i = {
                    city_id: t[n].city_id,
                    city_name: t[n].city_name
                };
                break;
            }
            i.city_id || (i = {
                city_id: t[0].city_id,
                city_name: t[0].city_name
            }), module.exports.setCity(i.city_id, i.city_name), void 0 != e && e(i);
        }
    },
    setCity: function(t, e) {
        var a = {
            city_id: t,
            city_name: e
        }, i = JSON.stringify(a);
        wx.setStorageSync("city", i);
    },
    getCityList: function(t) {
        e("/api/city/getCityList", {}, function(e) {
            t(e);
        });
    },
    getCity: function() {
        var t = wx.getStorageSync("city");
        return t ? JSON.parse(t) : {};
    },
    getBgEndDate: function() {
        var e = wx.getStorageSync("wxb_bg_end_date"), a = t(0);
        if (e) {
            var i = JSON.parse(e);
            if (console.log(i.bg_date), console.log(a), i.bg_date && i.bg_date >= a) return i;
        }
        return i = {
            day: 2,
            day2: 1,
            bg_date: t(0),
            end_date: t(1),
            bg_date1: t(0, 1),
            end_date1: t(1, 1)
        };
    },
    getStoreCode: function() {
        var t = wx.getStorageSync("storeinfo"), e = t ? JSON.parse(t) : {};
        return !!e.code && !(Date.parse(new Date()) / 1e3 - e.last_time > 86400) && e.code;
    },
    setStoreCode: function(t) {
        var e = {
            code: t,
            last_time: Date.parse(new Date()) / 1e3
        };
        return wx.setStorageSync("storeinfo", JSON.stringify(e)), !0;
    },
    fileupload: function() {
        var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "", e = arguments[1];
        wx.chooseImage({
            count: 1,
            sizeType: [ "compressed" ],
            sourceType: [ "album", "camera" ],
            success: function(a) {
                var i = a.tempFilePaths;
                wx.showLoading({
                    title: "图片上传中.."
                }), wx.uploadFile({
                    url: module.exports.globalData.apiurl + "/api/upload/upload",
                    filePath: i[0],
                    name: "file",
                    formData: {
                        mdl: t
                    },
                    success: function(t) {
                        wx.hideLoading(), wx.showToast({
                            title: "上传成功"
                        });
                        var a = JSON.parse(t.data);
                        e(a.data);
                    },
                    fail: function(t) {
                        wx.showToast({
                            title: "图片上传中"
                        });
                    }
                });
            }
        });
    },
    Post: e,
    globalData: [],
    that: null,
    lock: 0
};