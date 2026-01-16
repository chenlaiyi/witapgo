var t = getApp();

Page({
    data: {
        schoolid: "",
        banners: [],
        msgList: [ "公告：多地首套房贷利率上浮 热点城市渐迎零折扣时代", "公告：多地首套房贷利率上浮 热点城市渐迎零折扣时代" ],
        centericon: [],
        kecheng: [],
        tuijian: [],
        xygg: [],
        xyxw: [],
        xywz: [],
        morekc: "",
        xxgglist: "",
        xxxwlist: "",
        xxwzlist: "",
        centerheight: "",
        itemwiht: "",
        footleft: [],
        footright: [],
        center: [],
        footercenter: [],
        indicatorDots: !1,
        vertical: !0,
        autoplay: !0,
        interval: 2e3,
        duration: 500,
        isPopping: !0,
        animPlus: {},
        animCollect: {},
        animCollect1: {},
        animTranspond: {},
        animTranspond1: {},
        animInput: {},
        animInput1: {},
        ismb: !1
    },
    formSubmit: function(t) {
        var a = this, e = t.detail.formId, n = t.detail.target.dataset.name, i = t.detail.target.dataset.btnid;
        a.submintFromId(e, n, i);
    },
    submintFromId: function(a, e, n) {
        t.util.request({
            url: "entry/wxapp/addformId",
            data: {
                m: "fm_jiaoyuwxapp",
                formId: a,
                btnid: n,
                content: e
            },
            cachetime: "0",
            success: function(t) {}
        });
    },
    onLoad: function(t) {
        var a = this, e = t.schoolid;
        a.setData({
            schoolid: e
        });
    },
    onReady: function() {
        var a = this;
        t.util.getUserInfo(function(t) {
            a.setData({
                userInfo: t
            });
        });
        var e = this;
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
        }), t.util.request({
            url: "entry/wxapp/getschoolhome",
            data: {
                m: "fm_jiaoyuwxapp",
                schoolid: e.data.schoolid
            },
            cachetime: "0",
            success: function(t) {
                t.data && t.data.data && (wx.hideLoading(), e.setData({
                    banners: t.data.data.banners,
                    centericon: t.data.data.centericon,
                    centerheight: t.data.data.centerheight,
                    kecheng: t.data.data.kecheng,
                    tuijian: t.data.data.tuijian,
                    xygg: t.data.data.xygg,
                    xyxw: t.data.data.xyxw,
                    xywz: t.data.data.xywz,
                    morekc: t.data.data.morekc,
                    xxgglist: t.data.data.xxgglist,
                    xxxwlist: t.data.data.xxxwlist,
                    xxwzlist: t.data.data.xxwzlist
                }));
            }
        }), t.util.request({
            url: "entry/wxapp/getfooterstu",
            data: {
                m: "fm_jiaoyuwxapp",
                schoolid: e.data.schoolid
            },
            cachetime: "0",
            success: function(t) {
                t.data && t.data.data && (wx.hideLoading(), e.setData({
                    footleft: t.data.data.footleft,
                    footright: t.data.data.footright,
                    footercenter: t.data.data.footercenter,
                    center: t.data.data.center,
                    itemwiht: t.data.data.itemwiht
                }));
            }
        });
    },
    plus: function() {
        this.data.isPopping ? (this.popp(), this.setData({
            isPopping: !1
        })) : this.data.isPopping || (this.takeback(), this.setData({
            isPopping: !0
        }));
    },
    input: function() {
        console.log("input");
    },
    input1: function() {
        console.log("input1");
    },
    transpond: function() {
        console.log("transpond");
    },
    transpond1: function() {
        console.log("transpond1");
    },
    collect: function() {
        console.log("collect");
    },
    collect1: function() {
        console.log("collect1");
    },
    popp: function() {
        var t = wx.createAnimation({
            duration: 300,
            timingFunction: "ease-out"
        }), a = wx.createAnimation({
            duration: 300,
            timingFunction: "ease-out"
        }), e = wx.createAnimation({
            duration: 300,
            timingFunction: "ease-out"
        }), n = wx.createAnimation({
            duration: 300,
            timingFunction: "ease-out"
        }), i = wx.createAnimation({
            duration: 300,
            timingFunction: "ease-out"
        }), o = wx.createAnimation({
            duration: 300,
            timingFunction: "ease-out"
        }), r = wx.createAnimation({
            duration: 300,
            timingFunction: "ease-out"
        });
        t.rotateZ(180).step(), a.translate(90, -130).rotateZ(180).opacity(1).step(), e.translate(120, -70).rotateZ(360).opacity(1).step(), 
        n.translate(-6, -160).rotateZ(180).opacity(1).step(), i.translate(25, -117).rotateZ(360).opacity(1).step(), 
        o.translate(-100, -130).rotateZ(180).opacity(1).step(), r.translate(-75, -105).rotateZ(360).opacity(1).step(), 
        this.setData({
            animPlus: t.export(),
            animCollect: a.export(),
            animCollect1: e.export(),
            animTranspond: n.export(),
            animTranspond1: i.export(),
            animInput: o.export(),
            animInput1: r.export(),
            ismb: !0
        });
    },
    takeback: function() {
        var t = wx.createAnimation({
            duration: 200,
            timingFunction: "ease-out"
        }), a = wx.createAnimation({
            duration: 200,
            timingFunction: "ease-out"
        }), e = wx.createAnimation({
            duration: 200,
            timingFunction: "ease-out"
        }), n = wx.createAnimation({
            duration: 200,
            timingFunction: "ease-out"
        }), i = wx.createAnimation({
            duration: 200,
            timingFunction: "ease-out"
        }), o = wx.createAnimation({
            duration: 200,
            timingFunction: "ease-out"
        }), r = wx.createAnimation({
            duration: 200,
            timingFunction: "ease-out"
        });
        t.rotateZ(0).step(), a.translate(0, 0).rotateZ(0).opacity(0).step(), e.translate(0, 0).rotateZ(0).opacity(0).step(), 
        n.translate(0, 0).rotateZ(0).opacity(0).step(), i.translate(0, 0).rotateZ(0).opacity(0).step(), 
        o.translate(0, 0).rotateZ(0).opacity(0).step(), r.translate(0, 0).rotateZ(0).opacity(0).step(), 
        this.setData({
            animPlus: t.export(),
            animCollect: a.export(),
            animCollect1: e.export(),
            animTranspond: n.export(),
            animTranspond1: i.export(),
            animInput: o.export(),
            animInput1: r.export(),
            ismb: !1
        });
    },
    onPullDownRefresh: function() {
        var a = this;
        t.util.request({
            url: "entry/wxapp/getschoolhome",
            data: {
                m: "fm_jiaoyuwxapp",
                schoolid: a.data.schoolid
            },
            cachetime: "0",
            success: function(t) {
                t.data && t.data.data && (wx.hideLoading(), a.setData({
                    banners: t.data.data.banners,
                    centericon: t.data.data.centericon,
                    centerheight: t.data.data.centerheight,
                    kecheng: t.data.data.kecheng,
                    tuijian: t.data.data.tuijian,
                    xygg: t.data.data.xygg,
                    xyxw: t.data.data.xyxw,
                    xywz: t.data.data.xywz,
                    morekc: t.data.data.morekc,
                    xxgglist: t.data.data.xxgglist,
                    xxxwlist: t.data.data.xxxwlist,
                    xxwzlist: t.data.data.xxwzlist
                }));
            }
        }), wx.stopPullDownRefresh();
    }
});