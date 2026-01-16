function a(a, t, e) {
    return t in a ? Object.defineProperty(a, t, {
        value: e,
        enumerable: !0,
        configurable: !0,
        writable: !0
    }) : a[t] = e, a;
}

var t, e = getApp(), i = require("../../../utils/wxb.js");

Page((t = {
    data: {
        area_id: 0,
        star_id: 0,
        stars: [],
        city_id: 0,
        city: [],
        search: [],
        more: 1,
        datas: [],
        page: 1,
        lat: 0,
        lng: 0,
        order: 1,
        paixu: 1,
        price: 1,
        weizhi: 1,
        qita: 1,
        dwbg: !0,
        binding: {},
        user: {},
        myschool: {},
        ismb: !1
    },
    onLoad: function(a) {},
    onReady: function() {
        var a = this;
        e.util.request({
            url: "entry/wxapp/getareaandtype",
            data: {
                m: "fm_jiaoyuwxapp"
            },
            cachetime: "0",
            success: function(t) {
                t.data && t.data.data && a.setData({
                    stars: t.data.data.type,
                    city: t.data.data.city,
                    binding: t.data.data.binding,
                    user: t.data.data.user,
                    myschool: t.data.data.myschool
                });
            }
        }), e.util.request({
            url: "entry/wxapp/getclor",
            data: {
                m: "fm_jiaoyuwxapp"
            },
            cachetime: "0",
            success: function(a) {
                a.data && a.data.data && (wx.setNavigationBarColor({
                    frontColor: a.data.data.headfont,
                    backgroundColor: a.data.data.headcolor
                }), wx.setNavigationBarTitle({
                    title: a.data.data.title
                }));
            }
        });
    },
    more: function() {
        i.that.ajax();
    },
    ajax: function() {
        var a = [], t = i.that.data.service;
        for (var s in t) 1 == t[s].select && a.push(t[s].id);
        var r = JSON.stringify(a);
        wx.showLoading({
            title: "正在加载中.."
        }), e.util.request({
            url: "entry/wxapp/getschool",
            data: {
                m: "fm_jiaoyuwxapp",
                service: r,
                search: JSON.stringify(i.that.data.search),
                area_id: i.that.data.area_id,
                city_id: i.that.data.city_id,
                star_id: i.that.data.star_id,
                order: i.that.data.order,
                page: i.that.data.page,
                lat: wx.getStorageSync("wxb_lat"),
                lng: wx.getStorageSync("wxb_lng")
            },
            cachetime: "0",
            success: function(a) {
                if (a.data && a.data.data) {
                    wx.hideLoading();
                    var t = a.data.data.datas;
                    i.that.setData({
                        datas: t,
                        more: a.data.data.more
                    });
                }
            }
        });
    },
    serviceclick: function(a) {
        var t = a.target.dataset.id, e = i.that.data.service;
        for (var s in e) if (e[s].id == t) {
            e[s].select = 1 == e[s].select ? 0 : 1;
            break;
        }
        i.that.setData({
            service: e
        });
    },
    stationclick: function(a) {
        i.that.setData({
            station_id: a.target.dataset.id
        });
    },
    scenicclick: function(a) {
        i.that.setData({
            scenic_spot_id: a.target.dataset.id
        });
    },
    collegesclick: function(a) {
        i.that.setData({
            colleges_id: a.target.dataset.id
        });
    },
    hospitalclick: function(a) {
        i.that.setData({
            hospital_id: a.target.dataset.id
        });
    },
    qitaclear: function() {
        var a = i.that.data.service;
        for (var t in a) a[t].select = 0;
        i.that.setData({
            brand_id: 0,
            special_id: 0,
            service: a
        });
    },
    qitayes: function() {
        i.that.setData({
            qita: 1,
            dwbg: !0,
            page: 1,
            datas: [],
            more: 0
        }), i.that.ajax();
    },
    wzclear: function() {
        var t;
        i.that.setData((t = {
            station_id: 0,
            area_id: 0,
            colleges_id: 0,
            hospital_id: 0,
            administration_id: 0,
            scenic_spot_id: 0
        }, a(t, "area_id", "0"), a(t, "city_id", "0"), a(t, "wzselect", "0"), t));
    },
    wzyes: function() {
        i.that.setData({
            weizhi: 1,
            dwbg: !0,
            page: 1,
            datas: [],
            more: 0
        }), i.that.ajax();
    },
    areaclick: function(a) {
        i.that.setData({
            area_id: a.target.dataset.area,
            city_id: a.target.dataset.city_a
        });
    },
    star: function(a) {
        i.that.setData({
            star_id: a.target.dataset.id
        });
    },
    setprice: function(a) {
        if (0 == a.target.dataset.id) i.that.setData({
            price_id: 0,
            bg_price: 0,
            end_price: 0
        }); else {
            var t = i.that.data.prices;
            for (var e in t) if (t[e].id == a.target.dataset.id) {
                i.that.setData({
                    price_id: t[e].id,
                    bg_price: t[e].bgprice,
                    end_price: t[e].endprice
                });
                break;
            }
        }
    },
    priceclear: function() {
        i.that.setData({
            price_id: 0,
            bg_price: 0,
            end_price: 0,
            star_id: 0
        });
    },
    priceyes: function() {
        i.that.setData({
            price: 1,
            dwbg: !0,
            page: 1,
            datas: [],
            more: 0
        }), i.that.ajax();
    },
    wzselect: function(a) {
        i.that.setData({
            wzselect: a.target.dataset.select,
            city_id: a.target.dataset.select,
            area_id: "0"
        });
    },
    dwbg: function(a) {
        this.setData({
            paixu: 1,
            price: 1,
            weizhi: 1,
            qita: 1,
            dwbg: !0
        });
    },
    paixu: function(a) {
        this.setData({
            paixu: 0,
            price: 1,
            weizhi: 1,
            qita: 1,
            dwbg: !1
        });
    },
    price: function(a) {
        this.setData({
            price: 0,
            paixu: 1,
            weizhi: 1,
            qita: 1,
            dwbg: !1
        });
    },
    weizhi: function(a) {
        this.setData({
            weizhi: 0,
            paixu: 1,
            price: 1,
            qita: 1,
            dwbg: !1,
            wzselect: 0
        });
    },
    totoclick: function(a) {
        wx.navigateToMiniProgram({
            appId: "wxe7ba48052f8e85f3",
            path: "page/index",
            extraData: {
                foo: "bar"
            },
            envVersion: "release",
            success: function(a) {}
        });
    },
    orderclick: function(a) {
        i.that.setData({
            paixu: 1,
            dwbg: !0,
            order: a.target.dataset.order,
            page: 1,
            datas: [],
            more: 0
        }), i.that.ajax();
    },
    clearsearch: function() {
        try {
            wx.removeStorageSync("search"), i.that.setData({
                search: [],
                page: 1,
                datas: [],
                more: 0
            }), i.that.ajax();
        } catch (a) {
            wx.showToast({
                image: "/img/kulian.png",
                title: "清除失败"
            });
        }
    }
}, a(t, "more", function() {
    var a = i.that.data.page + 1;
    i.that.setData({
        page: a
    }), i.that.ajax();
}), a(t, "onLoad", function(a) {
    i.that = this;
    i.that.ajax();
}), a(t, "onShow", function() {
    i.that = this, i.globalData = e.globalData;
    var a = i.getBgEndDate();
    a && i.that.setData({
        date: a
    });
    i.getCity();
    var t = wx.getStorageSync("search");
    if (t) {
        var s = JSON.parse(t);
        s != i.that.data.search && (i.that.setData({
            search: s,
            page: 1,
            datas: [ {
                id: "is_wifi",
                name: "免费wifi1111111111",
                select: 0
            }, {
                id: "is_water",
                name: "全天热水",
                select: 0
            }, {
                id: "is_hairdrier",
                name: "吹风机",
                select: 0
            }, {
                id: "is_airconditioner",
                name: "空调",
                select: 0
            }, {
                id: "is_elevator",
                name: "电梯",
                select: 0
            }, {
                id: "is_fitnessroom",
                name: "健身房",
                select: 0
            }, {
                id: "is_swimmingpool",
                name: "游泳池",
                select: 0
            }, {
                id: "is_sauna",
                name: "桑拿",
                select: 0
            }, {
                id: "is_westernfood",
                name: "西餐厅",
                select: 0
            }, {
                id: "is_chinesefood",
                name: "中餐厅",
                select: 0
            }, {
                id: "is_stop",
                name: "免费停车",
                select: 0
            } ],
            more: 0
        }), i.that.ajax());
    }
}), a(t, "onPullDownRefresh", function() {
    i.that = this, i.that.ajax(), wx.stopPullDownRefresh();
}), a(t, "onShareAppMessage", function(a) {
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
}), t));