/*上拉到底部 加载更多
limit 当前 查询条目的下标 默认从0开始
pageSize 每次查询的增加条目数
ajax_switch 表示 ajax 锁，防止多次提交
ul_box 包含条目的容器的 class
li_item 单位条目的 标签的 class
ajax_url ajax的url
调用方法如下：
new Scroll_load({
    'limit': '0',
    'pageSize': 10,
    'ajax_switch': true,
    'ul_box': '.baby_diary_list',
    'li_item': '.baby_diary_list .li_content_box',
    "param": ["ctype"], //需要额外传递的限制数据
    'ajax_url': '@Url.Action("NotifyList")',
    'page_name': 'parent_notify', //  页面名称,仅当启用缓存时有用
    'after_ajax': function () {
    }
}).load_init();
*/

var index_type_item = "";

function scroll_list_to_detail() {
    sessionStorage.setItem(
        "cache_html_switch_" + scroll_load_obj.page_name,
        true
    );
}

function Scroll_load(param, ScrollDiv) {
    this.ScrollDiv = ScrollDiv || document;
    this.viewWindow = ScrollDiv || window;
    this.limit = $(ScrollDiv)
        .find(self.ul_box)
        .find(param.li_item)
        .eq($(ScrollDiv).find(self.ul_box).find(param.li_item).length - 1)
        .attr("time");
    this.pageSize = param.pageSize || 10;
    this.param = param.param;
    this.range = param.range || [];
    this.ajax_switch = param.ajax_switch || true;
    this.ul_box = param.ul_box || ".listContent";
    this.noticeytpe = param.noticeytpe || "";
    this.li_item = param.li_item || ".listContent .leave_main";
    this.ajax_url = param.ajax_url || "";
    this.bj_id = param.bj_id || "";
    this.after_ajax = param.after_ajax || null;
    this.page_name = param.page_name || "";
}

Scroll_load.prototype.load_init = function () {
    let self = this;
    let TrueUl = self.ul_box;
    if ($(self.ScrollDiv).find(".scroll-tips").length == 0) {
        $(self.ScrollDiv)
            .find(TrueUl)
            .after(
                ' <div class="scroll-tips" style="width: 100%;height: 50px;display:none;overflow:hidden" > <div style="color:gray;margin:0 auto;width: 150px;text-align: center;line-height:50px" class="scroll-tips-word"> 更多数据加载中... </div> </div>'
            );
    }

    //判断时候有缓存的hmtl，有的话加到列表容器
    //if (sessionStorage.getItem('cache_html_switch_' + self.page_name) && sessionStorage.getItem('cache_html' + self.page_name)) {
    //    $(self.ul_box).html(sessionStorage.getItem('cache_html' + self.page_name));
    //    if (typeof (self.after_ajax) != 'undefined') { self.after_ajax(); }
    //    //判断时候有 缓存的 scroll_top，有的话滚动到相应的高度
    //    if (sessionStorage.getItem('scroll_top' + self.page_name)) {
    //        $(window).scrollTop(sessionStorage.getItem('scroll_top' + self.page_name));
    //    }
    //}
    //else {
    //    clear_page_session(this.page_name);
    //}
    //sessionStorage.removeItem('cache_html_switch_' + self.page_name);
    if (
        $(self.ScrollDiv).find(self.ul_box).find(self.li_item).length %
        self.pageSize !=
        0 ||
        $(self.ScrollDiv).find(self.ul_box).find(self.li_item).length == 0
    ) {
        $(".jzz_text").text(""); //数据已加载完毕
    }
    $(this.viewWindow).on("scroll", {
        obj: self
    }, scroll_fun);
};

Scroll_load.prototype.reset_ajax = function () {
    this.ajax_switch = true;
    /*          if (sessionStorage.getItem('scroll_top' + self.page_name)) {
             $(self.viewWindow).scrollTop(sessionStorage.getItem('scroll_top' + self.page_name));
         } */
};

function scroll_fun(_event) {
    let _obj = _event.data.obj;
    let winHeight = $(_obj.viewWindow).innerHeight(),
        scrollTop = $(_obj.ScrollDiv).scrollTop(),
        documentHeight =
        $(_obj.ScrollDiv)[0].scrollHeight || $(_obj.ScrollDiv).height();
    // var bottom = $(".has_show_over");
    // var winHeight = window.innerHeight || document.documentElement.clientHeight,
    //     scrollTop = document.body.scrollTop || document.documentElement.scrollTop,
    //     documentHeight = $(document).height();

    /*  // 将当前的浏览器滚动的高度存在浏览器缓存变量scroll_top
      sessionStorage.setItem("scroll_top" + _obj.page_name, scrollTop); */
    //判断是否滚到差不多浏览器底部
    if (
        parseInt(winHeight) + parseInt(scrollTop) + 5 >
        parseInt(documentHeight)
    ) {
        let self = _obj;

        $(self.viewWindow).off("scroll", scroll_fun);

        if (self.ajax_switch) {
            self.ajax_switch = false; //把ajax锁关了防止不断ajax

            let TrueUl = self.ul_box;
            let datanumb = $(self.ScrollDiv).find(TrueUl).children(self.li_item)
                .length;
            if (datanumb >= 1) {
                $(self.ScrollDiv).find(".scroll-tips").css("height", "50px");
                $(self.ScrollDiv).find(".scroll-tips").show();
                $(self.ScrollDiv).find(".scroll-tips-word").text("更多数据加载中...");
            }
            let search_type = ""; //搜索条件
            let search_content = "";
            if ($("#search_input").length > 0) {
                search_content = $.trim($("#search_input").val());
                $(".type_item.checked").each(function () {
                    if (search_type != "") {
                        search_type += "," + $(this).attr("type");
                    } else {
                        search_type += $(this).attr("type");
                    }
                });
            }
            if (index_type_item != "") {
                search_type = index_type_item;
            }

            var GetLiData = {},
                RangeData = {};

            for (let item of self.param) {
                GetLiData[item] =
                    $(self.ScrollDiv)
                    .find(TrueUl)
                    .children(`${self.li_item}`)
                    .eq(
                        $(self.ScrollDiv).find(TrueUl).children(`${self.li_item}`)
                        .length - 1
                    )
                    .attr(`${item}`) || -1;
            }
            for (let itemR of self.range) {
                RangeData[itemR] = $(itemR).val();
            }
            // this.LiData = GetLiData;
            var post_data = {
                limit: $(self.ScrollDiv)
                    .find(TrueUl)
                    .children(self.li_item)
                    .eq($(self.ScrollDiv).find(TrueUl).children(self.li_item).length - 1)
                    .attr("time"),
                type: search_type,
                ExtraData: GetLiData,
                rangeData: RangeData,
                content: search_content,
            };

            $.ajax({
                type: "POST",
                url: self.ajax_url,
                data: post_data,
                dataType: "html",
                success: function (data) {
                    //载入更多内容
                    if ($.trim(data)) {
                        $(self.ScrollDiv).find(TrueUl).append(data);
                        if (typeof self.after_ajax != "undefined") {
                            self.after_ajax();
                        }
                        $(self.viewWindow).on("scroll", {
                            obj: self
                        }, scroll_fun);
                        self.ajax_switch = true;
                    } else {
                        $(self.ScrollDiv).find(".scroll-tips").css("height", "50px");
                        $(self.ScrollDiv).find(".scroll-tips").show();
                        $(self.ScrollDiv).find(".scroll-tips-word").text("数据已加载完毕");
                        setTimeout(() => {
                            $(self.ScrollDiv).find(".scroll-tips").animate({
                                height: "0"
                            });
                        }, 500);
                    }
                },
                error: function () {
                    jTips("加载失败！");
                    $(self.viewWindow).on("scroll", {
                        obj: self
                    }, scroll_fun);
                    self.ajax_switch = true;
                },
            }); //ajax结束
        }
    }
}

// _InitThis();

// function _InitThis() {
//     const css = `#rewrite-animation-loading-box.loading-spinner-box{width: 200px;height: 200px;background-color: rgba(31,31,31,.46);position: fixed;z-index:2;top:calc(50% - 100px);left: calc(50% - 100px);border-radius: 20px;--spinDockSize:120px;transform: scale(.7);} #rewrite-animation-loading-box .spinner-dock{width: 100%;height: calc(100% - 50px);position: relative;padding-top: 20px;display: flex;text-align: center;} #rewrite-animation-loading-box .spinner-circle{width: var(--spinDockSize);height: var(--spinDockSize);position: absolute;left: 40px;} #rewrite-animation-loading-box .spinner-action{width: var(--spinDockSize);height: var(--spinDockSize);position: absolute;} #rewrite-animation-loading-box .spinner-action.f1st{z-index: 5;} #rewrite-animation-loading-box .spinner-action.f2nd{z-index: 4;} #rewrite-animation-loading-box .spinner-action.f2nd .spinner-spot{width: 17px;height: 17px;background-color:rgba(241, 241, 241, 0.8)} #rewrite-animation-loading-box .spinner-action.f3rd{z-index: 3;} #rewrite-animation-loading-box .spinner-action.f3rd .spinner-spot{width: 16px;height: 16px;background-color:rgba(241, 241, 241, 0.7)} #rewrite-animation-loading-box .spinner-action.f4th{z-index: 2;} #rewrite-animation-loading-box .spinner-action.f4th .spinner-spot{width: 15px;height: 15px;background-color:rgba(241, 241, 241, 0.6)} #rewrite-animation-loading-box .spinner-action.f5th{z-index: 1;} #rewrite-animation-loading-box .spinner-action.f5th .spinner-spot{width: 14px;height: 14px;background-color:rgba(241, 241, 241, 0.5)} #rewrite-animation-loading-box .spinner-item{width: 120px;height: 120px;position: absolute;border-radius: 50%; animation:roundmoveReWriteAnimationLoading 4s cubic-bezier(0.89, 0.23, 0.19, 0.79) infinite} #rewrite-animation-loading-box .spinner-spot{width: 20px;height: 20px;background-color: white;border-radius: 50%;position: absolute;transform: translate(-50%,-50%);top:10px;left:50%} @keyframes roundmoveReWriteAnimationLoading { 0%{transform: rotate(0);} 20%{transform: rotate(0);} 75%{transform: rotate(360deg);} 100%{transform: rotate(360deg);} }`,
//         style = document.createElement("style"),
//         head = document.head || document.getElementsByTagName("head")[0];
//     head.appendChild(style);
//     style.appendChild(document.createTextNode(css));

//     const LoadingDiv = document.createElement("div");
//     LoadingDiv.id = "rewrite-animation-loading-box";
//     LoadingDiv.className = "loading-spinner-box";
//     LoadingDiv.innerHTML = ` <div class="spinner-dock"> <div class="spinner-circle"> <div class="spinner-action f1st" > <div class="spinner-item" style="animation-delay: .2s;"> <div class="spinner-spot"> </div> </div> </div> <div class="spinner-action f2nd"> <div class="spinner-item" style="animation-delay: .5s;"> <div class="spinner-spot"> </div> </div> </div> <div class="spinner-action f3rd"> <div class="spinner-item" style="animation-delay: .8s;"> <div class="spinner-spot"> </div> </div> </div> <div class="spinner-action f4th"> <div class="spinner-item" style="animation-delay: 1.1s;"> <div class="spinner-spot"> </div> </div> </div> <div class="spinner-action f5th"> <div class="spinner-item" style="animation-delay: 1.4s;"> <div class="spinner-spot"> </div> </div> </div> </div> </div> <div style="text-align: center;color:white;font-size: 20px;"> 数据加载中 </div> `;
//     document.body.appendChild(LoadingDiv);
// }


 

 



function vue_scroll_load() {
  this.VueScrollAjaxLock = false;
    this.VueScrollLoadFunc = async function (target, funcName, params = {}) {
    const sTop = target.scrollTop,
      cHeight = target.clientHeight,
      sHeight = target.scrollHeight;
    if (sHeight > cHeight) {
      if (document.body.querySelector("#rewrite-loading-box") === null) {
        const css = ` #rewrite-loading-box{--spinDockSize:20px;width: 100%;text-align: center;color: gray;font-size:
                14px;display: flex;justify-content: center;align-items: center;transition: height .3s;overflow: hidden;height: 0;}
                #rewrite-loading-box.inshow{height: 40px;} #rewrite-loading-box .spinner-dock{width: var(--spinDockSize);height:
                var(--spinDockSize);position: relative;} #rewrite-loading-box .spinner-circle{width: var(--spinDockSize);height:
                var(--spinDockSize);position: absolute;} #rewrite-loading-box .spinner-action{width: var(--spinDockSize);height:
                var(--spinDockSize);position: absolute;} #rewrite-loading-box .spinner-action.f1st{z-index: 5;} #rewrite-loading-box
                .spinner-action.f2nd{z-index: 4;} #rewrite-loading-box .spinner-action.f3rd{z-index: 3;} #rewrite-loading-box
                .spinner-action.f4th{z-index: 2;} #rewrite-loading-box .spinner-action.f5th{z-index: 1;} #rewrite-loading-box
                .spinner-item{width: var(--spinDockSize);height: var(--spinDockSize);position: absolute;border-radius: 50%;
                animation:roundmoveReWriteAnimationLoading 4s cubic-bezier(0.89, 0.23, 0.19, 0.79) infinite} #rewrite-loading-box
                .spinner-spot{width: 4px;height: 4px;background-color: gray;border-radius: 50%;position: absolute;transform:
                translate(-50%,-50%);top:3px;left:50%} @keyframes roundmoveReWriteAnimationLoading { 0% {transform: rotate(0);}
                100%{transform: rotate(360deg);} } #rewrite-loading-box.finish .loading-text{display:none} #rewrite-loading-box.finish
                .finish-text{display:inline-block} #rewrite-loading-box .loading-text{display:inline-block} #rewrite-loading-box
                .finish-text{display:none}`,
          style = document.createElement("style"),
          head = document.head || document.getElementsByTagName("head")[0];
        head.appendChild(style);
        style.appendChild(document.createTextNode(css));

        const LoadingDiv = document.createElement("div");
        LoadingDiv.id = "rewrite-animation-loading-box";
        LoadingDiv.className = "loading-spinner-box";
        LoadingDiv.innerHTML = ` <div id="rewrite-loading-box"> <div class="loading-text"> <div style="display:flex"> <div class="spinner-dock "> <div class="spinner-circle "> <div class="spinner-action f1st"> <div class="spinner-item" style="animation-delay: .2s;"> <div class="spinner-spot"> </div> </div> </div> <div class="spinner-action f2nd"> <div class="spinner-item" style="animation-delay: .5s;"> <div class="spinner-spot"> </div> </div> </div> <div class="spinner-action f3rd"> <div class="spinner-item" style="animation-delay: .8s;"> <div class="spinner-spot"> </div> </div> </div> <div class="spinner-action f4th"> <div class="spinner-item" style="animation-delay: 1.1s;"> <div class="spinner-spot"> </div> </div> </div> <div class="spinner-action f5th"> <div class="spinner-item" style="animation-delay: 1.4s;"> <div class="spinner-spot"> </div> </div> </div> </div> </div> <div> <i class="fas fa"></i> <span class="spinner-text">加载数据中</span> </div> </div> </div> <div class="finish-text">数据加载完毕</div> </div> `;
        target.appendChild(LoadingDiv);
        document.getElementById("rewrite-loading-box").className = "inshow";
      }
    }
    if (this.VueScrollAjaxLock === false) {
        if (target.scrollTop + target.clientHeight > target.scrollHeight - 10) {
        this.VueScrollAjaxLock = true;
        document.getElementById("rewrite-loading-box").className = "inshow";
        const result = await funcName(params);
        // 异步获取数据后，应该把提示框给隐藏掉
        if (result.hasData) {
          document.getElementById("rewrite-loading-box").className = "";
          this.VueScrollAjaxLock = false;
        } else {
          document.getElementById("rewrite-loading-box").className =
            "finish inshow";
          setTimeout(() => {
            document.getElementById("rewrite-loading-box").className = "finish";
          }, 1000);
        }
      }
    }
  };
}